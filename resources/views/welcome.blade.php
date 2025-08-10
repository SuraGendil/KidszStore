<x-app-layout>
    {{-- Section Carousel --}}
    <section
        x-data="{
            activeSlide: 0,
            slidesData: {{ json_encode($slides) }},
            nextSlide() { this.activeSlide = (this.activeSlide + 1) % this.slidesData.length },
            prevSlide() { this.activeSlide = (this.activeSlide - 1 + this.slidesData.length) % this.slidesData.length },
            goToSlide(index) { this.activeSlide = index },
            initCarousel() {
                if(this.slidesData.length > 1) {
                    setInterval(() => { this.nextSlide() }, 4000);
                }
            }
        }"
        x-init="initCarousel"
        class="relative flex items-center w-full max-w-[88%] mx-auto mt-32 h-[105px] xs:h-[115px] md:h-[230px] xl:h-[450px] overflow-hidden md:rounded-3xl rounded-xl"
        aria-label="Carousel Gambar Promosi"
    >
        <template x-for="(slide, i) in slidesData" :key="i">
            <div
                class="duration-700 ease-in-out absolute inset-0 transition-transform transform"
                :class="{
                    'z-30 translate-x-0': activeSlide === i,
                    'z-20 translate-x-full': activeSlide < i,
                    'z-10 -translate-x-full': activeSlide > i
                }"
                x-show="slidesData.length > 1 ? (Math.abs(activeSlide - i) <= 1 || (activeSlide === 0 && i === slidesData.length - 1) || (activeSlide === slidesData.length - 1 && i === 0)) : true"
            >
                <a :href="slide.link || '#'" :aria-label="slide.alt_text">
                    {{-- Menggunakan slide.image_url dan slide.alt_text dari data database --}}
                    <img :src="slide.image_url" :alt="slide.alt_text" class="w-full h-full object-cover cursor-pointer" />
                </a>
            </div>
        </template>

        {{-- Navigasi carousel hanya tampil jika jumlah slide lebih dari 1 --}}
        <template x-if="slidesData.length > 1">
            <div>
                <button
                    @click="prevSlide"
                    type="button"
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-40 flex items-center justify-center h-10 w-10 rounded-full bg-white/30 hover:bg-white/60 border-2 border-white focus:ring-2 focus:ring-white focus:outline-none group"
                    aria-label="Sebelumnya"
                >
                    <svg class="w-6 h-6 text-white rtl:rotate-180" aria-hidden="true" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"></path>
                    </svg>
                    <span class="sr-only">Sebelumnya</span>
                </button>
                <button
                    @click="nextSlide"
                    type="button"
                    class="absolute right-2 top-1/2 -translate-y-1/2 z-40 flex items-center justify-center h-10 w-10 rounded-full bg-white/30 hover:bg-white/60 border-2 border-white focus:ring-2 focus:ring-white focus:outline-none group"
                    aria-label="Selanjutnya"
                >
                    <svg class="w-6 h-6 text-white" aria-hidden="true" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 9l4-4-4-4"></path>
                    </svg>
                    <span class="sr-only">Selanjutnya</span>
                </button>
                <div class="flex justify-center gap-2 absolute bottom-4 left-0 right-0 z-50">
                    <template x-for="(slide, i) in slidesData" :key="i">
                        <button @click="goToSlide(i)" :class="activeSlide === i ? 'bg-white w-3 h-3' : 'bg-white/40 w-2.5 h-2.5'" class="rounded-full transition-all duration-200" :aria-label="'Pergi ke slide ' + (i + 1)"></button>
                    </template>
                </div>
            </div>
        </template>
    </section>

    {{-- Bagian Lain dari Halaman Anda --}}
    <section class="w-full max-w-[88%] mx-auto mt-8 bg-[#0e1a4b] md:rounded-3xl rounded-xl p-6" aria-labelledby="terlaris-heading">
        <h2 id="terlaris-heading" class="text-2xl font-bold text-white flex items-center gap-2 mb-4">
            <span role="img" aria-label="Api Emoji">🔥</span> Terlaris Bulan Ini!!
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {{-- Anda perlu mengambil data $products dari HomeController --}}
            {{-- Contoh: $products = \App\Models\Product::where('is_available', true)->take(4)->get(); --}}
            {{-- @foreach($products as $product) --}}
                <article class="bg-[#17307a] rounded-xl overflow-hidden shadow">
                    {{-- Ganti # dengan route dinamis ke halaman detail produk --}}
                    <a href="{{-- route('products.show', $product) --}}" class="block group" aria-label="Lihat produk PERMANENT DRAGON">
                        <div class="relative">
                            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10">Permanent</span>
                            <img src="{{ asset('images/barang/dragon-permanent.png') }}" alt="Gambar produk PERMANENT DRAGON" class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-200">
                        </div>
                        <div class="p-4 bg-[#00213a]">
                            <h3 class="text-white font-bold text-base mb-1">PERMANENT DRAGON</h3>
                            <p class="text-teal-300 text-xs mb-1">Transaksi: 1.588</p>
                            <p class="font-semibold text-white text-lg">Rp 450.000</p>
                        </div>
                    </a>
                </article>
            {{-- @endforeach --}}
        </div>
    </section>

    {{-- Product Categories Section (PERBAIKAN UTAMA DI SINI) --}}
    <section 
        x-data="{ activeGame: 'CDID', activeProductTab: 'Joki CDIC' }"
        class="w-full max-w-[88%] mx-auto mt-8"
    >

        {{-- Kategori Game --}}
        <section class="bg-[#0e1a4b] md:rounded-3xl rounded-xl p-6 mb-8" aria-labelledby="game-categories-heading">
            <h2 id="game-categories-heading" class="sr-only">Kategori Game</h2>
            <div role="tablist" aria-label="Pilih Kategori Game" class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center text-white">
                {{-- Tombol Game CDID --}}
                <div role="tab" :aria-selected="activeGame === 'CDID'" tabindex="0" class="group">
                    <button @click="activeGame = 'CDID'; activeProductTab = 'Joki CDIC'" class="block w-full hover:scale-105 transition-transform duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg">
                        <img src="{{ asset('images/logo_CDID.png') }}" alt="Logo Game CDID" class="mx-auto h-12 mb-2 object-contain">
                        <h3 class="text-white text-sm">CDID</h3>
                    </button>
                </div>
                
                {{-- Tombol Game DEAD RAILS --}}
                <div role="tab" :aria-selected="activeGame === 'DEAD RAILS'" tabindex="-1" class="group">
                    <button @click="activeGame = 'DEAD RAILS'; activeProductTab = 'Joki DR'" class="block w-full hover:scale-105 transition-transform duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg">
                        <img src="{{ asset('images/logo_dead_rails.png') }}" alt="Logo Game DEAD RAILS" class="mx-auto h-12 mb-2 object-contain">
                        <h3 class="text-white text-sm">DEAD RAILS</h3>
                    </button>
                </div>
            </div>
        </section>

        {{-- Kategori Produk --}}
        <section class="bg-[#0e1a4b] md:rounded-3xl rounded-xl p-6" aria-labelledby="product-categories-heading">
            <h2 id="product-categories-heading" class="sr-only">Kategori Produk</h2>
            
            <div class="flex flex-wrap gap-4 mb-8" role="tablist" aria-label="Kategori Produk">
                {{-- Tombol Joki CDIC --}}
                <template x-if="activeGame === 'CDID'">
                    <button
                        @click="activeProductTab = 'Joki CDIC'"
                        :aria-selected="activeProductTab === 'Joki CDIC' ? 'true' : 'false'"
                        :tabindex="activeProductTab === 'Joki CDIC' ? '0' : '-1'"
                        :class="{
                            'bg-white/20 ring-2 ring-blue-300': activeProductTab === 'Joki CDIC',
                            'bg-transparent hover:bg-white/10': activeProductTab !== 'Joki CDIC'
                        }"
                        class="px-5 py-2 rounded-lg font-semibold text-white border-2 border-blue-400 shadow-inner focus:outline-none transition-colors duration-200"
                        role="tab"
                        id="joki-CIDC-tab-btn"
                        aria-controls="joki-CIDC-panel"
                    >
                        Joki CDIC
                    </button>
                </template>

                {{-- Tombol GAMEPASS CIDC --}}
                <template x-if="activeGame === 'CDID'">
                    <button
                        @click="activeProductTab = 'GAMEPASS CIDC'"
                        :aria-selected="activeProductTab === 'GAMEPASS CIDC' ? 'true' : 'false'"
                        :tabindex="activeProductTab === 'GAMEPASS CIDC' ? '0' : '-1'"
                        :class="{
                            'bg-white/20 ring-2 ring-blue-300': activeProductTab === 'GAMEPASS CIDC',
                            'bg-transparent hover:bg-white/10': activeProductTab !== 'GAMEPASS CIDC'
                        }"
                        class="px-5 py-2 rounded-lg font-semibold text-white border-2 border-blue-400 shadow-inner focus:outline-none transition-colors duration-200"
                        role="tab"
                        id="gamepass-CIDC-tab-btn"
                        aria-controls="gamepass-CIDC-panel"
                    >
                        GAMEPASS CIDC
                    </button>
                </template>

                {{-- Tombol Kategori untuk DEAD RAILS --}}
                <template x-if="activeGame === 'DEAD RAILS'">
                    <button
                        @click="activeProductTab = 'Joki DR'"
                        :aria-selected="activeProductTab === 'Joki DR' ? 'true' : 'false'"
                        :tabindex="activeProductTab === 'Joki DR' ? '0' : '-1'"
                        :class="{
                            'bg-white/20 ring-2 ring-blue-300': activeProductTab === 'Joki DR',
                            'bg-transparent hover:bg-white/10': activeProductTab !== 'Joki DR'
                        }"
                        class="px-5 py-2 rounded-lg font-semibold text-white border-2 border-blue-400 shadow-inner focus:outline-none transition-colors duration-200"
                        role="tab"
                        id="joki-DR-tab-btn"
                        aria-controls="joki-DR-panel"
                    >
                        Joki DR
                    </button>
                </template>
            </div>
            
            <div>
                {{-- Konten untuk Joki CDIC --}}
                <div x-show="activeProductTab === 'Joki CDIC'" class="text-white p-4 bg-[#17307a] rounded-xl" role="tabpanel" aria-labelledby="joki-CIDC-tab-btn" id="joki-CIDC-panel">
                    <h3 class="text-xl font-bold mb-2">Produk Joki CDIC</h3>
                    <p>Ini adalah daftar produk untuk kategori Joki CDIC.</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-4">
                        <article class="bg-[#101c44] rounded-xl p-3 relative overflow-hidden shadow group">
                            <a href="#" class="block" aria-label="Lihat produk Akun CIDC A">
                                <img src="{{ asset('images/barang/vghuman.jpg') }}" alt="Gambar produk Akun CIDC A" class="rounded-lg w-full h-28 object-cover opacity-60 group-hover:opacity-80 transition-opacity duration-200">
                                <span class="absolute top-3 right-3 bg-green-500 text-white text-xs px-3 py-1 rounded-full font-semibold">Tersedia</span>
                                <h3 class="mt-3 text-white text-xs font-semibold">Akun CDIC Level MAX</h3>
                                <p class="text-[#a1a1a1] text-xs mb-1">ID: 1001</p>
                                <p class="font-semibold text-white text-sm">Rp 120.000</p>
                            </a>
                        </article>
                        <article class="bg-[#101c44] rounded-xl p-3 relative overflow-hidden shadow group">
                            <a href="#" class="block" aria-label="Lihat produk Akun CIDC A">
                                <img src="{{ asset('images/barang/vghuman.jpg') }}" alt="Gambar produk Akun CIDC A" class="rounded-lg w-full h-28 object-cover opacity-60 group-hover:opacity-80 transition-opacity duration-200">
                                <span class="absolute top-3 right-3 bg-green-500 text-white text-xs px-3 py-1 rounded-full font-semibold">Tersedia</span>
                                <h3 class="mt-3 text-white text-xs font-semibold">Akun CDIC Level MAX</h3>
                                <p class="text-[#a1a1a1] text-xs mb-1">ID: 1001</p>
                                <p class="font-semibold text-white text-sm">Rp 120.000</p>
                            </a>
                        </article>
                    </div>
                </div>

                {{-- Konten untuk Gamepass CIDC --}}
                <div x-show="activeProductTab === 'GAMEPASS CIDC'" class="text-white p-4 bg-[#17307a] rounded-xl" role="tabpanel" aria-labelledby="gamepass-CIDC-tab-btn" id="gamepass-CIDC-panel">
                    <h3 class="text-xl font-bold mb-2">Produk Gamepass CIDC</h3>
                    <p>Ini adalah daftar produk untuk kategori Gamepass CIDC.</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-4">
                        {{-- Produk Gamepass CIDC di sini --}}
                    </div>
                </div>

                {{-- Konten untuk Joki DR --}}
                <div x-show="activeProductTab === 'Joki DR'" class="text-white p-4 bg-[#17307a] rounded-xl" role="tabpanel" aria-labelledby="joki-DR-tab-btn" id="joki-DR-panel">
                    <h3 class="text-xl font-bold mb-2">Produk Joki DEAD RAILS</h3>
                    <p>Ini adalah daftar produk untuk kategori Joki DEAD RAILS.</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-4">
                        {{-- Produk Joki DR di sini --}}
                    </div>
                </div>
            </div>
        </section>

    </section>
</x-app-layout>