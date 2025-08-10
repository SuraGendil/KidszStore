<?php

namespace App\Http\Controllers;

use App\Models\Slide; // Pastikan Anda sudah membuat model Slide
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data slide yang aktif dari database, urutkan berdasarkan kolom 'order'
        $slides = Slide::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('welcome', compact('slides'));
    }
}
