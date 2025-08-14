<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TransactionController extends Controller
{
    /**
     * Menampilkan halaman form untuk cek transaksi.
     */
    public function index()
    {
        // Mengirimkan data transaksi jika ada di query string
        $transactionCode = request('transaction_code');
        $transaction = null;
        if ($transactionCode) {
            $transaction = Order::with(['product', 'user'])->where('order_id', $transactionCode)->first();
        }
        return view('check', compact('transaction', 'transactionCode'));
    }

    /**
     * Memproses pencarian kode transaksi.
     */
    public function check(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'transaction_code' => 'required|string|max:255',
        ]);

        // Redirect ke halaman index dengan membawa kode transaksi di query string
        return redirect()->route('transaction.index', ['transaction_code' => $validated['transaction_code']]);
    }
}
