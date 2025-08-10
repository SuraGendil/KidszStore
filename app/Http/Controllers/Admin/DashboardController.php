<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Anda bisa menambahkan logika untuk mengambil data khusus admin di sini
        return view('admin.dashboard');
    }
}
