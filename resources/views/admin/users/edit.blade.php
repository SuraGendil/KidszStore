<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - KIDSZSTORE</title>
    <link rel="icon" href="https://placehold.co/32x32/1A255B/ffffff?text=KS" type="image/x-icon">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #1A255B;
        }
    </style>
</head>
<body class="bg-[#1A255B] text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-lg bg-[#0e1a4b] p-8 rounded-2xl shadow-2xl border border-gray-700">
        <h1 class="text-3xl font-bold text-center mb-6">Edit Pengguna: {{ $user->name }}</h1>

        @if ($errors->any())
            <div class="bg-red-500/20 text-red-400 p-3 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-4 py-2 bg-[#1A255B] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-2 bg-[#1A255B] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Telepon (Opsional)</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="w-full px-4 py-2 bg-[#1A255B] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="is_admin" value="1" 
                           class="form-checkbox h-5 w-5 bg-[#1A255B] border-gray-600 rounded text-blue-500 focus:ring-blue-500"
                           @if(old('is_admin', $user->is_admin)) checked @endif>
                    <span class="text-gray-300">Jadikan sebagai Admin</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition-colors duration-200">
                    &larr; Kembali ke Dashboard
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>
</html>