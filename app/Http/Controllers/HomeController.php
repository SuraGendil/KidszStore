<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product; // Pastikan Anda sudah membuat model Product
use App\Models\Game;
use App\Models\Slide; // Pastikan Anda sudah membuat model Slide
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mengambil data yang sama untuk halaman utama dan dashboard.
     *
     * @return array
     */
    private function getSharedViewData(): array
    {
        // Ambil data slide yang aktif dari database
        $slides = Slide::where('status', true)
            ->orderBy('id', 'desc') // Urutkan berdasarkan slide terbaru
            ->get();

        $popularProducts = Product::where('status', true)
            ->orderBy('sold_count', 'desc')
            ->take(4) // Ambil 4 produk teratas
            ->get();

        $games = Game::where('status', true)->orderBy('name')->get();
        $allCategories = Category::with('game')->where('status', true)->orderBy('id', 'asc')->get();
        $allProducts = Product::with(['game', 'category'])
            ->where('status', true)
            ->orderBy('title', 'asc') // Urutkan produk berdasarkan judul (A-Z)
            ->get();

        return compact('slides', 'popularProducts', 'games', 'allCategories', 'allProducts');
    }

    /**
     * Menampilkan halaman utama untuk pengunjung.
     */
    public function index()
    {
        return view('welcome', $this->getSharedViewData());
    }

    /**
     * Menampilkan dashboard untuk pengguna yang sudah login.
     */
    public function dashboard()
    {
        return view('dashboard', $this->getSharedViewData());
    }
}
