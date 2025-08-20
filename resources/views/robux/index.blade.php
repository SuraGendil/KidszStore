<x-app-layout>
    {{-- Container utama yang mengisi layar dan mempertahankan tema gelap --}}
    <div class="relative w-full min-h-screen bg-[#1A255B] py-16 md:py-24 lg:py-32 flex items-center justify-center">
        {{-- Overlay transparan untuk fokus pada konten --}}
        <div class="absolute top-0 left-0 w-full h-full bg-[#0e1a4b]/60 backdrop-blur-md z-0"></div>

        {{-- Container konten utama yang responsif --}}
        <div class="relative w-full max-w-3xl mx-auto text-center z-10 px-6 lg:px-8">
            <div class="bg-[#0e1a4b]/80 backdrop-blur-sm border border-blue-400/20 shadow-2xl overflow-hidden sm:rounded-2xl text-white p-12 md:p-16">
                
                {{-- PERUBAHAN DI SINI: Ikon diperbesar dari text-7xl menjadi text-9xl --}}
                <i class="fa-solid fa-person-digging text-9xl text-yellow-500 mb-10"></i>
                
                {{-- Judul yang lebih menonjol --}}
                <h1 class="text-5xl font-bold mb-6">Segera Hadir!</h1>
                
                {{-- Deskripsi yang lebih jelas dan sedikit lebih besar --}}
                <p class="text-xl text-gray-300 mb-8">
                    Halaman "Beli Robux" sedang dalam tahap pengembangan. Tim kami bekerja keras untuk segera menyediakannya untuk Anda. Mohon bersabar ya!
                </p>
                
                {{-- Tombol kembali ke beranda dengan gaya yang lebih menarik --}}
                <a href="{{ route('welcome') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-semibold py-3 px-8 rounded-full shadow-md transition-all duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>