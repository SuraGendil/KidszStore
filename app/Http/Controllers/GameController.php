<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Menampilkan daftar resource.
     */
    public function index()
    {
        // Arahkan ke dasbor utama karena daftar game sudah ditampilkan di sana.
        return redirect()->route('admin.dashboard');
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Menyimpan resource yang baru dibuat ke dalam storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:games,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('games', 'public');
        }

        Game::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Game berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit resource yang spesifik.
     */
    public function edit(Game $game)
    {
        // Anda perlu membuat view 'games.edit' untuk fungsionalitas ini.
        // return view('games.edit', compact('game'));
        return back()->with('info', 'Halaman edit game belum diimplementasikan.');
    }

    /**
     * Memperbarui resource yang spesifik di storage.
     */
    public function update(Request $request, Game $game)
    {
        // Logika untuk update belum diimplementasikan.
        return back()->with('info', 'Fungsi update game belum diimplementasikan.');
    }

    /**
     * Menghapus resource yang spesifik dari storage.
     */
    public function destroy(Game $game)
    {
        // Hapus gambar dari storage jika ada
        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }

        $game->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Game berhasil dihapus.');
    }
}
