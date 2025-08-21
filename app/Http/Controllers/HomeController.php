<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Game;
use App\Models\Slide;
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
        $slides = Slide::where('status', true)
            ->orderBy('id', 'desc')
            ->get();

        $popularProducts = Product::where('status', true)
            ->orderBy('sold_count', 'desc')
            ->take(4)
            ->get();

        $games = Game::where('status', true)->orderBy('name')->get();
        $allCategories = Category::with('game')->where('status', true)->orderBy('id', 'asc')->get();
        $allProducts = Product::with(['game', 'category'])
            ->where('status', true)
            ->orderBy('title', 'asc')
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
