<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game - {{ $game->name }}</title>
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
        Kembali ke Dashboard
    </a>
    <div class="bg-[#1A255B] p-8 rounded-lg shadow-xl border border-gray-700">
        <h1 class="text-3xl font-bold text-white mb-6">Edit Game</h1>

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

        <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-300 text-sm font-bold mb-2">Nama Game</label>
                <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]" required>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-300 text-sm font-bold mb-2">Gambar Game (Opsional)</label>
                @if ($game->image)
                    <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->name }}" class="h-20 w-auto rounded-lg object-contain bg-gray-700 p-1 mb-4">
                @endif
                <input type="file" name="image" id="image" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]">
                <p class="text-gray-400 text-xs mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
            </div>
            <div class="mb-6">
                <label for="status" class="block text-gray-300 text-sm font-bold mb-2">Status</label>
                <select name="status" id="status" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-[#0e1a4b]">
                    <option value="1" {{ old('status', $game->status) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status', $game->status) == 0 ? 'selected' : '' }}>Non-aktif</option>
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
