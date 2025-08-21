<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Progress;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        if (!Auth::check()) {
            return response()->json(['error' => 'Anda harus masuk untuk melanjutkan pembayaran.'], 401);
        }

        $user     = Auth::user();
        $product  = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'];

        if ($product->stock < $quantity) {
            return response()->json(['error' => 'Stok produk tidak mencukupi.'], 400);
        }

        $pendingProgressId = Progress::where('name', 'Pending')->value('id');

        $order = Order::create([
            'user_id'     => $user->id,
            'product_id'  => $product->id,
            'quantity'    => $quantity,
            'total_price' => $product->price * $quantity,
            'status'      => 'pending', // Status untuk Midtrans
            'progress_id' => $pendingProgressId, // Status progres untuk user
            'order_id'    => 'KIDSZ-' . Str::uuid(),
        ]);

        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_id,
                'gross_amount' => (int) $order->total_price,
            ],
            'item_details' => [[
                'id'       => $product->id,
                'price'    => (int) $product->price,
                'quantity' => $quantity,
                'name'     => $product->title,
            ]],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            $order->update(['snap_token' => $snapToken]);

            $rawAdminPhone = config('services.whatsapp.admin_phone');

            $normalizedAdminPhone = preg_replace('/\D/', '', $rawAdminPhone);
            if (str_starts_with($normalizedAdminPhone, '0')) {
                $normalizedAdminPhone = '62' . substr($normalizedAdminPhone, 1);
            }

            $waMessage = "Halo Admin KIDSZSTORE,\n\n"
                . "Saya ingin konfirmasi pembayaran untuk pesanan berikut:\n\n"
                . "ID Pesanan: *{$order->order_id}*\n"
                . "Produk: *{$product->title}*\n"
                . "Total Bayar: *Rp " . number_format($order->total_price, 0, ',', '.') . "*\n\n";

            $categoryName = strtolower($product->category->name ?? '');

            if (str_contains($categoryName, 'gamepass')) {
                $waMessage .= "------------------------------------\n"
                    . "Mohon lengkapi data berikut untuk pesanan *Gamepass* Anda:\n\n"
                    . "Username Roblox: \n\n";

            } elseif (str_contains($categoryName, 'joki')) {
                $waMessage .= "------------------------------------\n"
                    . "Mohon lengkapi data berikut untuk pesanan *Joki* Anda:\n\n"
                    . "Username Roblox: \n"
                    . "Password Roblox: \n\n";
            }

            $waMessage .= "Mohon segera diproses. Terima kasih!";

            return response()->json([
                'snap_token' => $snapToken,
                'order' => [
                    'order_id'      => $order->order_id,
                    'product_title' => $product->title,
                    'total_price'   => $order->total_price,
                ],
                'whatsapp' => [
                    'phone'   => $normalizedAdminPhone,
                    'message' => $waMessage,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal memproses pembayaran, coba lagi.'], 500);
        }
    }

    /**
     * Handler notifikasi dari Midtrans
     */
    public function notificationHandler(Request $request)
    {
        $notification = json_decode($request->getContent(), false);

        if (
            !isset($notification->order_id, $notification->status_code, $notification->gross_amount, $notification->signature_key)
        ) {
            Log::warning('Midtrans notification invalid structure', ['payload' => $request->all()]);
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $expectedSignature = hash(
            'sha512',
            $notification->order_id .
                $notification->status_code .
                $notification->gross_amount .
                config('services.midtrans.server_key')
        );

        if (!hash_equals($expectedSignature, $notification->signature_key)) {
            Log::warning('Midtrans signature mismatch', ['order_id' => $notification->order_id]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_id', $notification->order_id)->first();

        if (!$order) {
            Log::error('Order not found', ['order_id' => $notification->order_id]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transactionStatus = $notification->transaction_status;

        $onProgressId = Progress::where('name', 'On Progress')->value('id');
        $failedId = Progress::where('name', 'Failed')->value('id');

        DB::transaction(function () use ($transactionStatus, $order, $onProgressId, $failedId) {
            if ($transactionStatus === 'settlement') {
                if ($order->status === 'pending') {
                    $order->update([
                        'status' => 'success',
                        'progress_id' => $onProgressId, // Pembayaran berhasil, pesanan masuk ke 'On Progress'
                    ]);

                    if ($order->product) {
                        $order->product->decrement('stock', $order->quantity);
                        $order->product->increment('sold_count', $order->quantity);
                    }
                }
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $order->update([
                    'status' => 'failed',
                    'progress_id' => $failedId, // Pembayaran gagal, pesanan masuk ke 'Failed'
                ]);
            }
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Notification handled successfully'
        ]);
    }
}
