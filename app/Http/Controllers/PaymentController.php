<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans dari config/services.php
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        
        // Gunakan Auth Facade dan lakukan pengecekan untuk memastikan user telah login.
        // Ini adalah praktik yang baik meskipun sudah ada middleware.
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus masuk untuk melanjutkan pembayaran.');
        }
        $user = Auth::user();

        // Cek stok produk
        if ($product->stock < $quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Buat order baru di database dengan status 'pending'
        $order = Order::create([
            'user_id' => $user->id, // User yang sedang login
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
            'status' => 'pending',
            'order_id' => 'KIDSZ-' . Str::uuid(), // Generate a more robust unique Order ID
        ]);

        // Siapkan parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => (int) $order->total_price, // Midtrans memerlukan integer
            ],
            'item_details' => [[
                'id' => $product->id,
                'price' => (int) $product->price, // Midtrans memerlukan integer
                'quantity' => $quantity,
                'name' => $product->title,
            ]],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        try {
            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Simpan snap token ke order
            $order->snap_token = $snapToken;
            $order->save();

            // Redirect ke halaman checkout
            return view('payment.checkout', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            // Log error untuk mempermudah debugging di server
            Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
            // Beri pesan error yang lebih umum ke pengguna
            return back()->with('error', 'Gagal memulai sesi pembayaran. Silakan coba lagi nanti.');
        }
    }

    /**
     * Handle notifikasi dari Midtrans (Webhook).
     */
    public function notificationHandler(Request $request)
    {
        $notification = json_decode($request->getContent());

        // Verifikasi signature key
        $signatureKey = hash('sha512', $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.server_key'));

        if ($notification->signature_key != $signatureKey) {
            Log::warning('Midtrans notification signature mismatch.', ['order_id' => $notification->order_id]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Temukan order berdasarkan order_id
        $order = Order::where('order_id', $notification->order_id)->first();

        if (!$order) {
            Log::error('Order not found for Midtrans notification.', ['order_id' => $notification->order_id]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Gunakan transaction status dari notifikasi
        $transactionStatus = $notification->transaction_status;

        // Gunakan DB Transaction untuk memastikan integritas data
        DB::transaction(function () use ($transactionStatus, $order) {
            if ($transactionStatus == 'settlement') {
                // Status pembayaran berhasil
                if ($order->status == 'pending') {
                    $order->status = 'success';
                    $order->save();

                    // Kurangi stok produk
                    $product = $order->product;
                    if ($product) {
                        $product->stock -= $order->quantity;
                        $product->sold_count += $order->quantity;
                        $product->save();
                    }
                }
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                // Status pembayaran gagal, dibatalkan, atau kedaluwarsa
                $order->status = 'failed';
                $order->save();
            }
        });

        // Beri respons OK ke Midtrans
        return response()->json([
            'status' => 'success',
            'message' => 'Notification handled successfully.'
        ]);
    }
}
