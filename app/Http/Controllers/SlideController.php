<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource for the public-facing page (welcome page).
     */
    public function publicIndex()
    {
        // Ambil slide yang aktif saja untuk ditampilkan di halaman utama
        $slides = Slide::where('status', true)->get();
        return view('welcome', compact('slides'));
    }

    /**
     * Display a listing of the resource for the admin dashboard.
     */
    public function index()
    {
        // Ambil data untuk dashboard, termasuk slide dan produk dengan paginasi
        // Nama halaman paginasi dibedakan ('slides_page', 'products_page') agar tidak bentrok
        $slides = Slide::latest()->paginate(10, ['*'], 'slides_page');
        $products = Product::latest()->paginate(10, ['*'], 'products_page');
        return view('admin.index', compact('slides', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validatedData = $request->validate(
            [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            ],
            [
                'image.required' => 'Anda harus memilih sebuah gambar untuk diunggah.',
                'image.image' => 'File yang diunggah harus berupa gambar yang valid.',
                'image.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.'
            ]);

        // 2. Handle upload gambar
        if ($request->hasFile('image')) {
            // Simpan gambar ke storage/app/public/slides dan simpan path-nya
            $imagePath = $request->file('image')->store('slides', 'public');
            $validatedData['image'] = $imagePath;
        }

        // 3. Buat data slide baru di database
        Slide::create($validatedData);

        // 4. Redirect kembali ke dashboard admin dengan pesan sukses
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Slide berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        return view('slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slide $slide)
    {
        $validatedData = $request->validate(
            [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar tidak wajib diubah
            'status' => 'required|boolean',
            ],
            [
                'image.image' => 'File yang diunggah harus berupa gambar yang valid.',
                'image.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.'
            ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }
            // Simpan gambar baru
            $validatedData['image'] = $request->file('image')->store('slides', 'public');
        }

        $slide->update($validatedData);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Slide berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        // Hapus gambar dari storage jika ada
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Slide berhasil dihapus.');
    }
}