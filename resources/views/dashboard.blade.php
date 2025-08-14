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
            @forelse ($popularProducts as $product)
                <article class="bg-[#17307a] rounded-xl overflow-hidden shadow flex flex-col">
                    {{-- Tautan ini sekarang mengarah ke halaman detail produk --}}
                    <a href="{{ route('product.show', $product->id) }}" class="block group flex flex-col flex-grow" aria-label="Lihat produk {{ $product->title }}">
                        <div class="relative">
                            {{-- Menampilkan gambar produk dinamis. Gunakan placeholder jika tidak ada gambar. --}}
                            <img src="{{ $product->image_url ?? 'https://placehold.co/400x200/1A255B/ffffff?text=No+Image' }}" alt="Gambar produk {{ $product->title }}" class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-200">
                        </div>
                        <div class="p-4 bg-[#00213a] flex flex-col flex-grow">
                            <h3 class="text-white font-bold text-base mb-1 flex-grow" title="{{ $product->title }}">{{ Str::limit($product->title, 35) }}</h3>
                            <p class="text-teal-300 text-xs mb-2">Terjual: {{ number_format($product->sold_count) }}+</p>
                            <p class="font-semibold text-white text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                </article>
            @empty
                <p class="text-gray-400 col-span-full text-center">Belum ada produk terlaris bulan ini.</p>
            @endforelse
        </div>
    </section>

    {{-- Product Categories Section (PERBAIKAN UTAMA DI SINI) --}}
    <section
        x-data="{
            categories: {{ json_encode($allCategories) }},
            products: {{ json_encode($allProducts) }},
            activeGameId: {{ $games->first()->id ?? 'null' }},
            activeCategoryId: {{ $allCategories->where('game_id', $games->first()->id ?? null)->first()->id ?? 'null' }},

            get activeCategories() {
                if (!this.activeGameId) return [];
                return this.categories.filter(c => c.game_id == this.activeGameId);
            },

            get activeProducts() {
                if (!this.activeCategoryId) return [];
                return this.products.filter(p => p.category_id == this.activeCategoryId);
            },

            selectGame(gameId) {
                this.activeGameId = gameId;
                const firstCategoryOfGame = this.categories.find(c => c.game_id == gameId);
                this.activeCategoryId = firstCategoryOfGame ? firstCategoryOfGame.id : null;
            }
        }"
        class="w-full max-w-[88%] mx-auto mt-8"
    >
        {{-- Kategori Game --}}
        <section class="bg-[#0e1a4b] md:rounded-3xl rounded-xl p-6 mb-8" aria-labelledby="game-categories-heading">
            <h2 id="game-categories-heading" class="sr-only">Kategori Game</h2>
            <div role="tablist" aria-label="Pilih Kategori Game" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 text-center text-white">
                @forelse ($games as $game)
                    <div role="tab" :aria-selected="activeGameId === {{ $game->id }}" class="group">
                        <button @click="selectGame({{ $game->id }})"
                                :class="{ 'ring-2 ring-blue-400 scale-105': activeGameId === {{ $game->id }} }"
                                class="block w-full p-2 hover:scale-105 transition-transform duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg">
                            <img src="{{ $game->image_url }}" alt="Logo Game {{ $game->name }}" class="mx-auto h-12 mb-2 object-contain">
                            <h3 class="text-white text-sm font-semibold">{{ $game->name }}</h3>
                        </button>
                    </div>
                @empty
                    <p class="text-gray-400 col-span-full text-center">Belum ada game yang tersedia.</p>
                @endforelse
            </div>
        </section>

        {{-- Kategori Produk --}}
        <section class="bg-[#0e1a4b] md:rounded-3xl rounded-xl p-6" aria-labelledby="product-categories-heading">
            <h2 id="product-categories-heading" class="sr-only">Kategori Produk</h2>

            <div class="flex flex-wrap gap-4 mb-8" role="tablist" aria-label="Kategori Produk">
                <template x-if="activeCategories.length > 0">
                    <template x-for="category in activeCategories" :key="category.id">
                        <button
                            @click="activeCategoryId = category.id"
                            :aria-selected="activeCategoryId === category.id"
                            :class="{
                                'bg-white/20 ring-2 ring-blue-300': activeCategoryId === category.id,
                                'bg-transparent hover:bg-white/10': activeCategoryId !== category.id
                            }"
                            class="px-5 py-2 rounded-lg font-semibold text-white border-2 border-blue-400 shadow-inner focus:outline-none transition-colors duration-200"
                            role="tab"
                            x-text="category.name"
                        >
                        </button>
                    </template>
                </template>
                <template x-if="activeCategories.length === 0 && activeGameId !== null">
                    <p class="text-gray-400">Tidak ada kategori produk untuk game ini.</p>
                </template>
            </div>

            <div>
                <template x-if="activeCategoryId">
                    <div class="text-white p-4 bg-[#17307a] rounded-xl" role="tabpanel">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-4">
                            <template x-for="product in activeProducts" :key="product.id">
                                <article class="bg-[#17307a] rounded-xl overflow-hidden shadow-lg group flex flex-col transition-all duration-300 hover:shadow-blue-400/30 hover:-translate-y-1">
                                    <a :href="'/product/' + product.id" class="flex flex-col flex-grow" :aria-label="'Lihat produk ' + product.title">
                                        <div class="relative">
                                            <img :src="product.image_url || 'https://placehold.co/400x200/101c44/ffffff?text=No+Image'" :alt="'Gambar produk ' + product.title" class="w-full h-32 object-cover transition-transform duration-300 group-hover:scale-105">
                                            <template x-if="product.stock > 0">
                                                <span class="absolute top-2 right-2 bg-green-500/80 text-white text-[10px] font-bold px-2 py-0.5 rounded-full backdrop-blur-sm">Tersedia</span>
                                            </template>
                                            <template x-if="product.stock <= 0">
                                                <span class="absolute top-2 right-2 bg-red-500/80 text-white text-[10px] font-bold px-2 py-0.5 rounded-full backdrop-blur-sm">Habis</span>
                                            </template>
                                        </div>
                                        <div class="p-3 flex flex-col flex-grow bg-[#101c44]">
                                            <h3 class="text-white text-sm font-bold flex-grow min-h-[40px]" x-text="product.title"></h3>
                                            <div class="flex justify-between items-center mt-2">
                                                <p class="text-xs text-gray-400 flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4z" clip-rule="evenodd" /></svg>
                                                    <span x-text="'Stok: ' + product.stock"></span>
                                                </p>
                                                <p class="font-semibold text-blue-300 text-sm" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.price)"></p>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            </template>
                        </div>
                        <template x-if="activeProducts.length === 0">
                            <p class="text-gray-400 text-center py-8">Tidak ada produk yang tersedia untuk kategori ini.</p>
                        </template>
                    </div>
                </template>
            </div>
        </section>
    </section>
</x-app-layout>