<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan detail spesifik dari sebuah pesanan.
     */
    public function show(Order $order)
    {
        // Ambil semua kemungkinan status/progres untuk dropdown
        $progresses = Progress::all();
        $users = User::all();

        // Mengembalikan view detail dengan data pesanan dan daftar progres
        return view('admin.orders.show', compact('order', 'progresses', 'users'));
    }

    public function edit(Order $order)
    {
        // Ambil semua kemungkinan status/progres untuk dropdown
        $progresses = Progress::all();
        return view('admin.orders.edit', compact('order', 'progresses'));
    }


    /**
     * Memperbarui status/progres dari sebuah pesanan.
     */
    public function update(Request $request, Order $order)
    {
        // Validasi input dari form
        $request->validate([
            'progress_id' => 'required|exists:progresses,id',
        ]);

        // Update kolom progress_id pada pesanan
        $order->progress_id = $request->progress_id;
        $order->save();

        // Redirect kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Status pesanan #' . $order->order_id . ' berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        // Hapus pengguna dari database
        $order->delete();

        // Redirect kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dihapus!');
    }
}
