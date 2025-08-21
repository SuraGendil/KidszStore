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
        $progresses = Progress::all();
        $users = User::all();

        return view('admin.orders.show', compact('order', 'progresses', 'users'));
    }

    public function edit(Order $order)
    {
        $progresses = Progress::all();
        return view('admin.orders.edit', compact('order', 'progresses'));
    }


    /**
     * Memperbarui status/progres dari sebuah pesanan.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'progress_id' => 'required|exists:progresses,id',
        ]);

        $order->progress_id = $request->progress_id;
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status pesanan #' . $order->order_id . ' berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dihapus!');
    }
}
