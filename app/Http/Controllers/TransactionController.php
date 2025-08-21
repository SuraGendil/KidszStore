<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TransactionController extends Controller
{

    public function index()
    {
        $transactionCode = request('transaction_code');
        $transaction = null;
        if ($transactionCode) {
            $transaction = Order::with(['product', 'user'])->where('order_id', $transactionCode)->first();
        }
        return view('check', compact('transaction', 'transactionCode'));
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'transaction_code' => 'required|string|max:255',
        ]);

        return redirect()->route('transaction.index', ['transaction_code' => $validated['transaction_code']]);
    }
}
