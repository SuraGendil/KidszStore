<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KIDSZSTORE - Top Up Game Aman dan Cepat</title>

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#1A255B] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
    <header class="fixed top-0 left-0 right-0 z-50 w-full px-4 sm:px-8 py-3 bg-[#0e1a4b] text-white" aria-label="Situs Navigasi Utama">
        <div class="flex items-center justify-between">
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center gap-3" aria-label="KIDSZSTORE Beranda">
                    <img src="{{ asset('images/logo-KidszStore.png') }}" alt="KIDSZSTORE Logo" class="h-10 w-10 rounded-full object-cover">
                    <span class="text-2xl font-bold">KIDSZSTORE</span>
                </a>
            </div>

            <nav class="hidden md:flex justify-center" aria-label="Menu Navigasi">
                <ul class="flex items-center gap-8 text-base">
                    <li>
                        <a href="{{ route('welcome') }}" class="flex items-center gap-2 {{ request()->routeIs('welcome') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                            <i class="fa-solid fa-house" aria-hidden="true"></i>
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
                        <a href="{{ route('robux.index') }}" class="flex items-center gap-2 {{ request()->routeIs('robux.index') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                            <i class="fa-solid fa-store" aria-hidden="true"></i>
                            Beli Robux
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('how-to-buy.index') }}" class="flex items-center gap-2 {{ request()->routeIs('how-to-buy.index') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                            <i class="fa-solid fa-circle-question" aria-hidden="true"></i>
                            Cara Beli
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-4">
                    <div class="flex items-center gap-3 pr-2 border-r border-gray-700" role="group" aria-label="Tautan Media Sosial">
                        <a href="https://wa.me/6281234567890" target="_blank" class="text-green-400 text-xl hover:text-green-300" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="https://www.instagram.com/kidsz.id" target="_blank" class="text-pink-400 text-xl hover:text-pink-300" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://discord.gg/inviteKIDZSTORE" target="_blank" class="text-indigo-400 text-xl hover:text-indigo-300" title="Discord">
                            <i class="fa-brands fa-discord"></i>
                        </a>
                    </div>
                    @guest
                        <a href="{{ route('login') }}" class="px-6 py-2 bg-white text-[#0e1a4b] rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors duration-200">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-[#17307a] text-white rounded-lg text-sm font-semibold hover:bg-[#22308a] transition-colors duration-200">
                            Daftar
                        </a>
                    @endguest
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-white hover:text-blue-300">Admin</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-white hover:text-blue-300">Profil</a>
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
                <div class="md:hidden">
                    <button id="menu-toggle" type="button" class="text-white hover:text-blue-400 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <i class="fa-solid fa-bars fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden mt-4">
            <ul class="flex flex-col items-center gap-4 text-base py-4">
                <li>
                    <a href="{{ route('welcome') }}" class="flex items-center gap-2 py-2 {{ request()->routeIs('welcome') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                        <i class="fa-solid fa-house w-5" aria-hidden="true"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('transaction.index') }}" class="flex items-center gap-2 py-2 {{ request()->routeIs('transaction.index') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                        <i class="fa-solid fa-magnifying-glass w-5" aria-hidden="true"></i>
                        Cek Transaksi
                    </a>
                </li>
                <li>
                    <a href="{{ route('robux.index') }}" class="flex items-center gap-2 py-2 {{ request()->routeIs('robux.index') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                        <i class="fa-solid fa-store w-5" aria-hidden="true"></i>
                        Beli Robux
                    </a>
                </li>
                <li>
                    <a href="{{ route('how-to-buy.index') }}" class="flex items-center gap-2 py-2 {{ request()->routeIs('how-to-buy.index') ? 'text-blue-400 font-semibold' : 'hover:text-blue-400' }}">
                        <i class="fa-solid fa-circle-question w-5" aria-hidden="true"></i>
                        Cara Beli
                    </a>
                </li>
            </ul>
            <div class="flex flex-col items-center gap-4 pt-4 border-t border-gray-700">
                @guest
                    <a href="{{ route('login') }}" class="w-full text-center px-6 py-2 bg-white text-[#0e1a4b] rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="w-full text-center px-6 py-2 bg-[#17307a] text-white rounded-lg text-sm font-semibold hover:bg-[#22308a] transition-colors duration-200">
                        Daftar
                    </a>
                @endguest
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="py-2 text-sm font-semibold text-white hover:text-blue-300">Admin</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="py-2 text-sm font-semibold text-white hover:text-blue-300">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block text-center w-full px-6 py-2 bg-red-500 text-white rounded-lg text-sm font-semibold hover:bg-red-600 transition-colors duration-200">
                            Keluar
                        </a>
                    </form>
                @endauth
            </div>
            <div class="flex justify-center items-center gap-6 pt-4 mt-4 border-t border-gray-700" role="group" aria-label="Tautan Media Sosial">
                <a href="https://wa.me/6281380207365" target="_blank" class="text-green-400 text-2xl" title="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://www.instagram.com/kidsz.id" target="_blank" class="text-pink-400 text-2xl" title="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://discord.gg/inviteKIDZSTORE" target="_blank" class="text-indigo-400 text-2xl" title="Discord">
                    <i class="fa-brands fa-discord"></i>
                </a>
            </div>
        </div>
    </header>

    @if(Auth::check() && Auth::user()->is_admin && request()->routeIs('admin.*'))
        <div class="flex min-h-screen pt-16">
            <aside class="w-64 bg-[#1A255B] shadow-lg flex-col justify-between hidden md:flex">
                <div> 
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

            <main class="flex-1 p-6 lg:p-8 bg-[#0e1a4b]">
                {{ $slot }}
            </main>

        </div>
    @else
        <main class="w-full p-6 lg:p-8 flex flex-col items-center">
            {{ $slot }}
        </main>
    @endif

    <footer class="w-full bg-[#0e1a4b] py-6 px-8 text-white" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Navigasi Footer</h2>
        <div class="flex flex-col md:flex-row md:justify-between gap-8">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-KidszStore.png') }}" alt="KIDSZSTORE Logo" class="h-10 w-10 rounded-full bg-[#101c44] object-cover">
                <span class="text-2xl font-bold">KIDSZSTORE</span>
            </div>
            <div class="flex flex-1 justify-between mt-8 md:mt-0">
                <nav aria-label="Tautan Ikuti Kami">
                    <h3 class="font-semibold mb-2">FOLLOW US</h3>
                    <ul>
                        <li><a href="https://wa.me/6281380207365" target="_blank" class="block text-gray-300 hover:text-white transition" aria-label="WhatsApp KIDSZSTORE">WhatsApp KIDSZSTORE</a></li>
                        <li><a href="https://www.instagram.com/kidsz.id" target="_blank" class="block mt-1 text-gray-300 hover:text-white transition" aria-label="Instagram KIDSZSTORE">Instagram KIDSZSTORE</a></li>
                        <li><a href="https://discord.gg/inviteKIDZSTORE" target="_blank" class="block mt-1 text-gray-300 hover:text-white transition" aria-label="Discord KIDSZSTORE">Discord KIDSZSTORE</a></li>
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
                <a href="https://wa.me/6281380207365" target="_blank" class="hover:text-[#25D366]" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/kidsz.id" target="_blank" class="hover:text-[#E4405F]" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://discord.gg/inviteKIDZSTORE" target="_blank" class="hover:text-[#5865F2]" aria-label="Discord"><i class="fa-brands fa-discord"></i></a>
            </div>
        </div>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                    const icon = menuToggle.querySelector('i');
                    if (icon.classList.contains('fa-bars')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-xmark');
                    } else {
                        icon.classList.remove('fa-xmark');
                        icon.classList.add('fa-bars');
                    }
                });
            }
        });
    </script>
</body>
</html>