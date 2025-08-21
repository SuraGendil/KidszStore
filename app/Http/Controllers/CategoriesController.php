<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function publicIndex()
    {
        $categories = Category::where('status', true)->get();
        return view('categories.index', compact('categories'));
    }
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        $games = Game::where('status', true)->orderBy('name')->get();
        return view('categories.create', compact('games'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        Category::create($validatedData);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $games = Game::where('status', true)->orderBy('name')->get();
        return view('categories.edit', compact('category', 'games'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $category->update($validatedData);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.dashboard')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
