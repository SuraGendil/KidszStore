<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIDSZSTORE - Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" href="https://placehold.co/32x32/1A255B/ffffff?text=KS" type="image/x-icon">

    <!-- Google Fonts: Instrument Sans -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: #1A255B;
            color: #1b1b18;
        }
        /* Keeping original custom styles for consistency */
        .text-white { color: #fff; }
        .bg-white { background: #fff; }
        .rounded-2xl { border-radius: 1rem; }
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-[#1A255B] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">

    <!-- Header Section -->
    <header class="fixed top-0 left-0 right-0 z-50 w-full px-4 sm:px-8 py-3 flex flex-col sm:flex-row items-center justify-between bg-[#0e1a4b] text-white" aria-label="Situs Navigasi Utama">
        <!-- Logo and Site Title -->
        <a href="/" class="flex items-center gap-3 shrink-0 mb-2 sm:mb-0" aria-label="KIDSZSTORE Beranda">
            <img src="{{ asset('images/logo-KidszStore.png') }}" alt="KIDSZSTORE Logo" class="h-10 w-10 rounded-full object-cover">
            <span class="text-2xl font-bold">KIDSZSTORE</span>
        </a>

        <!-- Main Navigation Menu -->
        <nav class="flex-1 flex justify-center" aria-label="Menu Navigasi">
            <ul class="flex items-center gap-8 text-base">
                <li>
                    <a href="{{ route('welcome') }}" class="flex items-center gap-2 {{ request()->routeIs('welcome') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                        <i class="fa-solid fa-house" aria-hidden="true"></i> {{-- Menambahkan aria-hidden --}}
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('transaction.index') }}" class="flex items-center gap-2 {{ request()->routeIs('transaction.index') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                        Cek Transaksi
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-2 hover:text-blue-400">
                        <i class="fa-solid fa-store" aria-hidden="true"></i>
                        Beli Robux
                    </a>
                </li>
            </ul>
        </nav>

        <!-- User Actions / Social Media Links -->
        <div class="flex items-center gap-4 flex-wrap justify-center sm:justify-end">
            <div class="flex items-center gap-3" role="group" aria-label="Tautan Media Sosial">
                <a href="https://wa.me/6281234567890" class="text-green-400 text-xl hover:text-green-300 transition-colors duration-200" title="WhatsApp" aria-label="Kunjungi WhatsApp KIDSZSTORE">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                </a>
                <a href="https://www.instagram.com/kidsz.id" class="text-pink-400 text-xl hover:text-pink-300 transition-colors duration-200" title="Instagram" aria-label="Kunjungi Instagram KIDSZSTORE">
                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="#" class="text-indigo-400 text-xl hover:text-indigo-300 transition-colors duration-200" title="Discord" aria-label="Bergabung ke Discord KIDSZSTORE">
                    <i class="fa-brands fa-discord" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- End Header Section -->

    <!-- Admin Layout with Sidebar -->
    <div class="flex min-h-screen pt-32 sm:pt-16"> <!-- pt-32 for mobile header offset, pt-16 for desktop -->
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-[#1A255B] shadow-lg flex-col justify-between hidden md:flex">
            <nav class="mt-8 px-2">
                <h3 class="uppercase text-gray-500 font-semibold text-xs mt-4 px-4 mb-2">Menu</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="#" id="nav-slides" class="flex items-center p-3 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-slate-700 hover:text-white" onclick="showContent('slides', this)">
                            <i class="fa-solid fa-images w-5 h-5 mr-3" aria-hidden="true"></i>
                            Slides
                        </a>
                    </li>
                    <li>
                        <a href="#" id="nav-products" class="flex items-center p-3 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-slate-700 hover:text-white" onclick="showContent('products', this)">
                            <i class="fa-solid fa-box-archive w-5 h-5 mr-3" aria-hidden="true"></i>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="#" id="nav-popular" class="flex items-center p-3 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-slate-700 hover:text-white" onclick="showContent('popular', this)">
                            <i class="fa-solid fa-star w-5 h-5 mr-3" aria-hidden="true"></i>
                            Populer
                        </a>
                    </li>
                    <li>
                        <a href="#" id="nav-games" class="flex items-center p-3 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-slate-700 hover:text-white" onclick="showContent('games', this)">
                            <i class="fa-solid fa-gamepad w-5 h-5 mr-3" aria-hidden="true"></i>
                            Games
                        </a>
                    </li>
                    <li>
                        <a href="#" id="nav-categories" class="flex items-center p-3 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-slate-700 hover:text-white" onclick="showContent('categories', this)">
                            <i class="fa-solid fa-tags w-5 h-5 mr-3" aria-hidden="true"></i>
                            Kategori
                        </a>
                    </li>
                    <li>
                        <a href="#" id="nav-orders" class="flex items-center p-3 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-slate-700 hover:text-white" onclick="showContent('orders', this)">
                            <i class="fa-solid fa-receipt w-5 h-5 mr-3" aria-hidden="true"></i>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="#" id="nav-users" class="flex items-center p-3 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-slate-700 hover:text-white" onclick="showContent('users', this)">
                            <i class="fa-solid fa-users w-5 h-5 mr-3" aria-hidden="true"></i>
                            Users
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Admin Content Area -->
        <main id="main-content" class="flex-1 p-6 lg:p-8 bg-[#0e1a4b]">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Content for Slides Management -->
            <div id="content-slides" class="content-section">
                <h1 class="text-3xl font-bold text-white mb-6">Manajemen Slides</h1>
                <div class="flex flex-wrap items-center space-x-2 sm:space-x-4 mb-6">
                    <a href="{{ route('admin.slides.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center transition-colors duration-200" aria-label="Tambah Slide">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Slide
                    </a>
                </div>

                <!-- Slides Table -->
                <div class="bg-[#1A255B] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Id</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Title</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Gambar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($slides as $slide)
                                <tr class="hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">{{ $slide->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($slide->image)
                                            <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}">
                                        @else
                                            <img class="h-10 w-10 rounded-lg object-cover" src="https://placehold.co/40x40/1A255B/ffffff?text=No+Img" alt="No Image">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ Str::limit($slide->description, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($slide->status)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 bg-opacity-20 text-green-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-green-400 mr-1"></span> Aktif
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 bg-opacity-20 text-red-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-red-400 mr-1"></span> Non-aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.slides.edit', $slide->id) }}" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition-colors duration-200" title="Edit Slide" aria-label="Edit Slide">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-1.5l-6-6m2-2a2 2 0 112.828 2.828L13.828 15H11.5v2.5l2.5-2.5z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slide ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-300 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200" title="Hapus Slide" aria-label="Hapus Slide">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-400">Tidak ada slide yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6">
                    {{ $slides->links() }}
                </div>
            </div>

            <!-- Content for Products Management -->
            <div id="content-products" class="content-section hidden">
                <h1 class="text-3xl font-bold text-white mb-6">Daftar Produk</h1>

                <div class="flex flex-wrap items-center space-x-2 sm:space-x-4 mb-6">
                    <a href="{{ route('admin.products.create') }}" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center transition-colors duration-200" 
                    aria-label="Tambah Produk">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Produk
                    </a>
                </div>
                
                <!-- Products Table -->
                <div class="bg-[#1A255B] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nama Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Games</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Terjual</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($products as $product)
                                <tr class="hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                                    </td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">{{ $product->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->game->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->sold_count ?? 0 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</td> 
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->status)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 bg-opacity-20 text-green-400 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-400 mr-1"></span> Aktif
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 bg-opacity-20 text-red-400 items-center">
                                            <span class="w-2 h-2 rounded-full bg-red-400 mr-1"></span> Non-aktif
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                                            class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition-colors duration-200" 
                                            title="Edit Produk">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-1.5l-6-6m2-2a2 2 0 112.828 2.828L13.828 15H11.5v2.5l2.5-2.5z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 text-gray-300 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200" 
                                                        title="Hapus Produk">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-4 text-center text-gray-400">Tidak ada produk yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>

            <!-- Content for Games Management -->
            <div id="content-games" class="content-section hidden">
                <h1 class="text-3xl font-bold text-white mb-6">Manajemen Game</h1>

                <div class="mb-6">
                    {{-- Arahkan ke route untuk membuat game baru --}}
                    <a href="{{ route('admin.games.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center transition-colors duration-200 w-max" aria-label="Tambah Game Baru">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Game
                    </a>
                </div>

                <!-- Games Table -->
                <div class="bg-[#1A255B] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nama Game</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($games as $game)
                                <tr class="hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($game->image)
                                            <img class="h-10 w-16 rounded-lg object-contain bg-gray-700 p-1" src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->name }}">
                                        @else
                                            <img class="h-10 w-16 rounded-lg object-contain bg-gray-700 p-1" src="https://placehold.co/64x40/1A255B/ffffff?text=No+Img" alt="No Image">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">{{ $game->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($game->status)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 bg-opacity-20 text-green-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-green-400 mr-1"></span> Aktif
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 bg-opacity-20 text-red-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-red-400 mr-1"></span> Non-aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.games.edit', $game->id) }}" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition-colors duration-200" title="Edit Game"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-1.5l-6-6m2-2a2 2 0 112.828 2.828L13.828 15H11.5v2.5l2.5-2.5z" /></svg></a>
                                            <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus game ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-300 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200" title="Hapus Game"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-400">Tidak ada game yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination for Games -->
                <div class="mt-6">
                    {{ $games->links() }}
                </div>
            </div>

            <div id="content-popular" class="content-section hidden">
                <h1 class="text-3xl font-bold text-white mb-6">Manajemen Populer</h1>

                <div class="bg-[#1A255B] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Game</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Terjual</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($popularProducts as $product)
                                <tr class="hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->image)
                                            <img class="h-10 w-16 rounded-lg object-contain bg-gray-700 p-1" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                                        @else
                                            <img class="h-10 w-16 rounded-lg object-contain bg-gray-700 p-1" src="https://placehold.co/64x40/1A255B/ffffff?text=No+Img" alt="No Image">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">{{ $product->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->game->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->sold_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->status)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 bg-opacity-20 text-green-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-green-400 mr-1"></span> Aktif
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 bg-opacity-20 text-red-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-red-400 mr-1"></span> Non-aktif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-400">Tidak ada produk populer yang ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Content for Categories Management -->
            <div id="content-categories" class="content-section hidden">
                <h1 class="text-3xl font-bold text-white mb-6">Manajemen Kategori Produk</h1>

                <div class="mb-6">
                    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center transition-colors duration-200 w-max" aria-label="Tambah Kategori Baru">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Kategori
                    </a>
                </div>

                <div class="bg-[#1A255B] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nama Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Games</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($categories as $category)
                                <tr class="hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $category->game->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        @if ($category->status)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 bg-opacity-20 text-green-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-green-400 mr-1"></span> Aktif
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 bg-opacity-20 text-red-400 items-center">
                                                <span class="w-2 h-2 rounded-full bg-red-400 mr-1"></span> Non-aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-2">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition-colors duration-200" title="Edit Kategori">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-1.5l-6-6m2-2a2 2 0 112.828 2.828L13.828 15H11.5v2.5l2.5-2.5z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE') {{-- Menambahkan @method('DELETE') untuk standar RESTful --}}
                                            <button type="submit" class="p-2 text-gray-300 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200" title="Hapus Kategori">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">Tidak ada kategori yang ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Content for Orders Management -->
            <div id="content-orders" class="content-section hidden">
                <h1 class="text-3xl font-bold text-white mb-6">Manajemen Pesanan</h1>

                <!-- Orders Table -->
                <div class="bg-[#1A255B] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">ID Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Progres</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($orders as $order)
                                <tr class="hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $order->order_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $order->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ Str::limit($order->product->title ?? 'Produk Dihapus', 30) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $order->status ?? 'Produk Dihapus' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm capitalize">
                                        @if($order->progress)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @switch($order->progress->color)
                                                    @case('yellow') bg-yellow-500/20 text-yellow-400 @break
                                                    @case('blue') bg-blue-500/20 text-blue-400 @break
                                                    @case('green') bg-green-500/20 text-green-400 @break
                                                    @case('red') bg-red-500/20 text-red-400 @break
                                                    @default bg-gray-500/20 text-gray-400
                                                @endswitch
                                            ">
                                                {{ $order->progress->name }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500/20 text-gray-400">
                                                {{ $order->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-2">
                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition-colors duration-200" title="Edit Kategori">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-1.5l-6-6m2-2a2 2 0 112.828 2.828L13.828 15H11.5v2.5l2.5-2.5z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-300 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200" title="Hapus Kategori">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-400">Tidak ada pesanan yang ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>

            <div id="content-users" class="content-section hidden">
                <h1 class="text-3xl font-bold text-white mb-6">Manajemen Pengguna</h1>
                <div class="bg-[#1A255B] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Telepon</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Tanggal Daftar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($users as $user)
                                <tr class="hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->phone ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($user->is_admin)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-500/20 text-purple-400">
                                                Admin
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-500/20 text-cyan-400">
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition-colors duration-200" title="Edit Kategori">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-1.5l-6-6m2-2a2 2 0 112.828 2.828L13.828 15H11.5v2.5l2.5-2.5z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-300 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200" title="Hapus Kategori">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-400">Tidak ada pengguna yang ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </main>
    </div>

    <footer class="w-full bg-[#0e1a4b] py-6 px-4 sm:px-8 text-white" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Navigasi Footer</h2>
        <div class="flex flex-col md:flex-row md:justify-between gap-8">
            <div class="flex items-center gap-3">
                <img src="https://placehold.co/40x40/1A255B/ffffff?text=KS" alt="KIDSZSTORE Logo" class="h-10 w-10 rounded-full bg-[#101c44] object-cover">
                <span class="text-2xl font-bold">KIDSZSTORE</span>
            </div>
            <div class="flex flex-1 flex-col sm:flex-row justify-between mt-8 md:mt-0 gap-8">
                <nav aria-label="Tautan Ikuti Kami">
                    <h3 class="font-semibold mb-2">FOLLOW US</h3>
                    <ul>
                        <li><a href="https://wa.me/6281234567890" class="block text-gray-300 hover:text-white transition" aria-label="WhatsApp KIDSZSTORE">WhatsApp KIDSZSTORE</a></li>
                        <li><a href="https://www.instagram.com/kidsz.id" class="block mt-1 text-gray-300 hover:text-white transition" aria-label="Instagram KIDSZSTORE">Instagram KIDSZSTORE</a></li>
                        <li><a href="#" class="block mt-1 text-gray-300 hover:text-white transition" aria-label="Discord KIDSZSTORE">Discord KIDSZSTORE</a></li>
                    </ul>
                </nav>
                <nav aria-label="Tautan Hukum">
                    <h3 class="font-semibold mb-2">LEGAL</h3>
                    <ul>
                        <li><a href="#" class="block text-gray-300 hover:text-white transition" aria-label="Kebijakan Privasi">Privacy Policy</a></li>
                        <li><a href="#" class="block mt-1 text-gray-300 hover:text-white transition" aria-label="Syarat dan Ketentuan">Terms &amp; Conditions</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <hr class="my-6 border-white/20">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <p class="text-gray-400 text-sm">&copy; 2025 KIDSZSTORE. All Rights Reserved.</p>
            <div class="flex gap-4 text-xl" role="group" aria-label="Tautan Media Sosial Footer">
                <a href="https://wa.me/6281234567890" class="hover:text-[#25D366]" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/kidsz.id" class="hover:text-[#E4405F]" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                <a href="#" class="hover:text-[#5865F2]" aria-label="Discord"><i class="fa-brands fa-discord" aria-hidden="true"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /**
             * Fungsi untuk menampilkan bagian konten yang dipilih dan memperbarui tautan navigasi aktif.
             * @param {string} contentId - ID dari bagian konten yang akan ditampilkan (misalnya, 'slides', 'products').
             * @param {HTMLElement} clickedElement - Elemen tautan navigasi yang diklik.
             */
            window.showContent = function(contentId, clickedElement) {
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.add('hidden');
                });
                document.querySelectorAll('aside nav a').forEach(link => {
                    link.classList.remove('bg-blue-600', 'text-white', 'font-semibold');
                    link.classList.add('text-gray-300', 'hover:bg-slate-700', 'hover:text-white');
                });
                document.getElementById('content-' + contentId).classList.remove('hidden');
                clickedElement.classList.add('bg-blue-600', 'text-white', 'font-semibold');
                clickedElement.classList.remove('text-gray-300', 'hover:bg-slate-700', 'hover:text-white');
            };
            showContent('slides', document.getElementById('nav-slides'));
        });
    </script>
</body>
</html>
