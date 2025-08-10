<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0e1a4b;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#0e1a4b]">

<div class="container mx-auto p-8 max-w-2xl">
    <a href="{{ route('admin.dashboard') }}" class="text-blue-400 hover:underline mb-4 inline-flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar
    </a>
    <div class="bg-[#1A255B] p-8 rounded-lg shadow-xl border border-gray-700"> 
        <h1 class="text-3xl font-bold text-white mb-6">Edit Produk</h1>

        {{-- Menampilkan Error Validasi --}}
        @if ($errors->any())
            <div class="bg-red-500 bg-opacity-20 text-red-300 border border-red-600 text-sm rounded-lg p-4 mb-6" role="alert">
                <strong class="font-bold">Oops! Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-300 text-sm font-bold mb-2">Nama Produk</label>
                <input type="text" name="title" id="title" value="{{ old('title', $product->title) }}" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]" required>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-300 text-sm font-bold mb-2">Gambar Produk Saat Ini</label>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="mb-2 max-h-40 rounded-lg">
                @else
                    <p class="text-gray-400">Tidak ada gambar saat ini.</p>
                @endif
                <label for="image" class="block text-gray-300 text-sm font-bold my-2">Ubah Gambar (Opsional)</label>
                <input type="file" name="image" id="image" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-300 text-sm font-bold mb-2">Harga</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]" required>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-gray-300 text-sm font-bold mb-2">Stok</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]" required>
            </div>
            <div class="mb-6">
                <label for="status" class="block text-gray-300 text-sm font-bold mb-2">Status</label>
                <select name="status" id="status" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]">
                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Non-aktif</option>
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Perbarui</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>