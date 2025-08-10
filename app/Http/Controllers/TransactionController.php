<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Gunakan ini untuk contoh sederhana

class TransactionController extends Controller
{
    /**
     * Menampilkan halaman form untuk cek transaksi.
     */
    public function index()
    {
        // Panggil langsung 'check' karena file check.blade.php berada di root folder views
        return view('check');
    }

    /**
     * Memproses pencarian kode transaksi.
     */
    public function check(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|string|min:8|max:20', // Sesuaikan validasi
        ]);

        $transactionCode = $request->input('transaction_code');

        // Contoh sederhana untuk mengecek di database
        // Asumsi kamu punya tabel 'transactions'
        $transaction = DB::table('transactions')
            ->where('code', $transactionCode)
            ->first();

        // Redirect kembali ke halaman yang sama dengan membawa hasil
        return view('check', [
            'transaction' => $transaction,
            'transactionCode' => $transactionCode,
        ]);
    }
}
