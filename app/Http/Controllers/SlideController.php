<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{

    public function publicIndex()
    {
        $slides = Slide::where('status', true)->get();
        return view('welcome', compact('slides'));
    }

    public function index()
    {
        $slides = Slide::latest()->paginate(10, ['*'], 'slides_page');
        $products = Product::latest()->paginate(10, ['*'], 'products_page');
        return view('admin.index', compact('slides', 'products'));
    }


    public function create()
    {
        return view('slides.create');
    }

    public function store(Request $request)
    {
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
            ]
        );

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides', 'public');
            $validatedData['image'] = $imagePath;
        }

        Slide::create($validatedData);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit(Slide $slide)
    {
        return view('slides.edit', compact('slide'));
    }

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
            ]
        );

        if ($request->hasFile('image')) {
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }
            $validatedData['image'] = $request->file('image')->store('slides', 'public');
        }

        $slide->update($validatedData);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(Slide $slide)
    {
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Slide berhasil dihapus.');
    }
}
