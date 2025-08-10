<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KIDSZSTORE - Top Up Game Aman dan Cepat</title> {{-- Judul yang lebih deskriptif dan relevan dengan konten --}}

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    {{-- Preconnect untuk font pihak ketiga --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Kondisional untuk Vite atau CSS fallback. Lebih baik menggunakan Vite di produksi. --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Fallback CSS inline hanya jika Vite belum siap (misalnya, di lingkungan lokal tanpa build) --}}
        <style>
            body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; background: #1A255B; color: #1b1b18; }
            .text-white { color: #fff; }
            .bg-white { background: #fff; }
            .rounded-2xl { border-radius: 1rem; }
            .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        </style>
    @endif
</head>

<body class="bg-[#1A255B] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen"> {{-- Menggunakan min-h-screen untuk tinggi minimal --}}

    {{-- Header --}}
    <header class="fixed top-0 left-0 right-0 z-50 w-full px-8 py-3 flex items-center justify-between bg-[#0e1a4b] text-white" aria-label="Situs Navigasi Utama">
        <a href="/" class="flex items-center gap-3 shrink-0" aria-label="KIDSZSTORE Beranda">
            <img src="{{ asset('images/logo.png') }}" alt="KIDSZSTORE Logo" class="h-10 w-10 rounded-full object-cover">
            <span class="text-2xl font-bold">KIDSZSTORE</span> {{-- Konsisten dengan KIDSZSTORE --}}
        </a>
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
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3" role="group" aria-label="Tautan Media Sosial">
                <a href="#" class="text-green-400 text-xl" title="WhatsApp" aria-label="Kunjungi WhatsApp KIDSZSTORE">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                </a>
                <a href="#" class="text-pink-400 text-xl" title="Instagram" aria-label="Kunjungi Instagram KIDSZSTORE">
                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="#" class="text-indigo-400 text-xl" title="Discord" aria-label="Bergabung ke Discord KIDSZSTORE">
                    <i class="fa-brands fa-discord" aria-hidden="true"></i>
                </a>
            </div>
            @guest
                <a
                    href="{{ route('login') }}"
                    class="px-6 py-2 bg-white text-[#0e1a4b] rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors duration-200"
                >
                    Masuk
                </a>
                <a
                    href="{{ route('register') }}"
                    class="px-6 py-2 bg-[#17307a] text-white rounded-lg text-sm font-semibold hover:bg-[#22308a] transition-colors duration-200"
                >
                    Daftar
                </a>
            @endguest
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-sm font-semibold text-white hover:text-blue-300">Admin</a>
                @endif
                {{-- <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-semibold text-white hover:text-blue-300">Dashboard</a> --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="px-6 py-2 bg-red-500 text-white rounded-lg text-sm font-semibold hover:bg-red-600 transition-colors duration-200">
                        Keluar
                    </a>
                </form>
            @endauth
        </div>
    </header>
    {{-- End Header --}}

    {{-- Conditional Layout for Admin vs Public --}}
    @if(Auth::check() && Auth::user()->is_admin && request()->routeIs('admin.*'))
        {{-- Admin Layout with Sidebar --}}
        <div class="flex min-h-screen pt-16"> {{-- pt-16 for fixed header offset --}}
            <aside class="w-64 bg-[#1A255B] shadow-lg flex-col justify-between hidden md:flex">
                <div> 
                    <!-- Admin Navigation Menu -->
                    <nav class="mt-8 px-2">
                        <h3 class="uppercase text-gray-500 font-semibold text-xs mt-4 px-4 mb-2">Menu</h3>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('admin.slides.index') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.slides.*') ? 'bg-sky-600 text-white font-semibold' : 'text-gray-300 hover:bg-slate-700 hover:text-white' }}">
                                    <i class="fa-solid fa-images w-5 h-5 mr-3" aria-hidden="true"></i>
                                    Slides
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.index') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-sky-600 text-white font-semibold' : 'text-gray-300 hover:bg-slate-700 hover:text-white' }}">
                                    <i class="fa-solid fa-box-archive w-5 h-5 mr-3" aria-hidden="true"></i>
                                    Products
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders.index') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.orders.*') ? 'bg-sky-600 text-white font-semibold' : 'text-gray-300 hover:bg-slate-700 hover:text-white' }}">
                                    <i class="fa-solid fa-receipt w-5 h-5 mr-3" aria-hidden="true"></i>
                                    Orders
                                </a>
                            </li>
                             <li>
                                <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-sky-600 text-white font-semibold' : 'text-gray-300 hover:bg-slate-700 hover:text-white' }}">
                                    <i class="fa-solid fa-users w-5 h-5 mr-3" aria-hidden="true"></i>
                                    Users
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            {{-- Main Admin Content --}}
            <main class="flex-1 p-6 lg:p-8 bg-[#0e1a4b]">
                {{ $slot }}
            </main>
        </div>
    @else
        {{-- Public Layout --}}
        <main class="w-full p-6 lg:p-8 flex flex-col items-center">
            {{ $slot }}
        </main>
    @endif

    {{-- Footer --}}
    <footer class="w-full bg-[#0e1a4b] py-6 px-8 text-white" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Navigasi Footer</h2>
        <div class="flex flex-col md:flex-row md:justify-between gap-8">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="KIDSZSTORE Logo" class="h-10 w-10 rounded-full bg-[#101c44] object-cover">
                <span class="text-2xl font-bold">KIDSZSTORE</span>
            </div>
            <div class="flex flex-1 justify-between mt-8 md:mt-0">
                <nav aria-label="Tautan Ikuti Kami">
                    <h3 class="font-semibold mb-2">FOLLOW US</h3>
                    <ul>
                        <li><a href="#" class="block text-gray-300 hover:text-white transition" aria-label="WhatsApp KIDSZSTORE">WhatsApp KIDSZSTORE</a></li>
                        <li><a href="#" class="block mt-1 text-gray-300 hover:text-white transition" aria-label="Instagram KIDSZSTORE">Instagram KIDSZSTORE</a></li>
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
                <a href="#" class="hover:text-[#25D366]" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                <a href="#" class="hover:text-[#E4405F]" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                <a href="#" class="hover:text-[#5865F2]" aria-label="Discord"><i class="fa-brands fa-discord" aria-hidden="true"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
