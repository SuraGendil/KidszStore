<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $slides = Slide::latest()->paginate(10, ['*'], 'slides');
        $products = Product::with(['game', 'category'])->latest()->paginate(10, ['*'], 'products');
        $games = Game::latest()->paginate(10, ['*'], 'games');
        $categories = Category::with('game')->latest()->paginate(10, ['*'], 'categories');
        $allCategoriesForFilter = Category::orderBy('name')->get();
        $popularProducts = Product::with(['game', 'category'])->orderBy('sold_count', 'desc')->take(10)->get();

        return view('admin.index', compact('slides', 'products', 'games', 'categories', 'allCategoriesForFilter', 'popularProducts'));    }
}
