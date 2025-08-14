<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-6xl mx-auto bg-[#0e1a4b] md:rounded-3xl rounded-xl shadow-2xl overflow-hidden">
            <div class="relative w-full h-64 md:h-96 overflow-hidden">
                <img src="{{ $product->image_url ?? 'https://placehold.co/1200x400/1A255B/ffffff?text=Produk' }}" alt="Gambar header untuk {{ $product->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent flex flex-col justify-end p-6 md:p-8 text-white">
                    <span class="text-lg font-semibold text-blue-300">{{ $product->game->name ?? 'Game' }}</span>
                    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight drop-shadow-lg">{{ $product->title }}</h1>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-300">{{ $product->category->name ?? 'Kategori' }}</h2>
                </div>
            </div>

            <div class="bg-[#1a2c6d] text-sm md:text-base">
                <div class="flex justify-center overflow-x-auto whitespace-nowrap p-4 space-x-6">
                    <div class="flex items-center space-x-2 text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="glow-text">Jaminan Layanan</span>
                    </div>
                    <div class="flex items-center space-x-2 text-blue-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75l.094.026z" />
                        </svg>
                        <span class="glow-text">Jaminan Layanan 24 jam</span>
                    </div>
                    <div class="flex items-center space-x-2 text-blue-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 4v2a2 2 0 01-2 2H6a2 2 0 01-2-2V8h12zM6 8V6h12v2H6z" />
                        </svg>
                        <span class="glow-text">Pembayaran aman & terpercaya</span>
                    </div>
                    <div class="flex items-center space-x-2 text-blue-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4a1 1 0 102 0V8a1 1 0 10-2 0v6zm-1.5-6a1 1 0 112 0h-2z" clip-rule="evenodd" />
                        </svg>
                        <span class="glow-text">Proses cepat & otomatis</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 p-6 md:p-8 text-white gap-8">
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-3">Deskripsi Produk</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Dapatkan <strong class="text-white">{{ $product->title }}</strong> untuk game <strong class="text-white">{{ $product->game->name ?? '' }}</strong> dengan cepat dan aman hanya di KIDSZSTORE. Ikuti langkah-langkah di samping untuk menyelesaikan pembelian Anda.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-3">Cara Transaksi</h3>
                        <ol class="list-decimal list-inside text-gray-300 space-y-2 text-sm">
                            <li>Lengkapi data pada form pembelian di sebelah kanan.</li>
                            <li>Pilih jumlah produk yang ingin Anda beli.</li>
                            <li>Klik tombol "Beli Sekarang" untuk melanjutkan ke pembayaran.</li>
                            <li>Selesaikan pembayaran sesuai metode yang Anda pilih.</li>
                            <li>Pesanan Anda akan diproses secara otomatis setelah pembayaran berhasil.</li>
                            <li>Jika ada kendala, jangan ragu untuk menghubungi layanan pelanggan kami.</li>
                        </ol>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div x-data="{
                            quantity: {{ $product->stock > 0 ? 1 : 0 }},
                            price: {{ $product->price }},
                            stock: {{ $product->stock }},
                            increaseQuantity() {
                                if (this.quantity < this.stock) this.quantity++;
                            },
                            decreaseQuantity() {
                                if (this.quantity > 1) this.quantity--;
                            },
                            get totalPrice() {
                                return new Intl.NumberFormat('id-ID').format(this.quantity * this.price);
                            },
                            get whatsappLink() {
                                const phoneNumber = '{{ config('services.whatsapp.number') }}';
                                const productTitle = '{{ addslashes($product->title) }}';
                                const message = `Halo, saya ingin memesan:\n\n*Produk:* ${productTitle}\n*Jumlah:* ${this.quantity}\n*Total Harga:* Rp ${this.totalPrice}\n\nMohon diproses, terima kasih.`;
                                return `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                            }
                        }"
                        class="p-6 rounded-xl bg-[#1a2c6d] self-start sticky top-8 border border-blue-800 shadow-lg">
                        
                        <p class="text-lg font-semibold text-blue-300 mb-2">{{ $product->title }}</p>
                        <div class="mb-4">
                            <label class="block text-white text-sm font-bold mb-2">Pilih Jumlah</label>
                            <div class="flex items-center justify-between bg-[#0e1a4b] p-2 rounded-lg border-2 border-gray-600">
                                <button type="button" @click="decreaseQuantity()" :disabled="quantity <= 1 || stock <= 0" class="w-10 h-10 text-2xl font-bold text-white rounded-md hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">-</button>
                                <input type="number" name="quantity" x-model.number="quantity" min="1" :max="stock" class="w-16 text-center bg-transparent text-white text-lg font-bold border-0 focus:outline-none focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" :disabled="stock <= 0" />
                                <button type="button" @click="increaseQuantity()" :disabled="quantity >= stock || stock <= 0" class="w-10 h-10 text-2xl font-bold text-white rounded-md hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">+</button>
                            </div>
                            <p class="text-right text-xs text-gray-400 mt-1">Stok Tersedia: <span x-text="stock"></span></p>
                            <template x-if="stock <= 0">
                                <p class="text-red-400 text-sm mt-2 font-semibold">Stok produk ini telah habis.</p>
                            </template>
                        </div>

                        <hr class="border-blue-800 my-4">

                        <div class="flex justify-between items-center mb-6">
                            <span class="text-gray-300 font-semibold">Total Pembayaran</span>
                            <p class="text-3xl font-extrabold text-blue-300" x-text="'Rp ' + totalPrice"></p>
                        </div>

                        @auth
                            <a :href="stock > 0 ? whatsappLink : '#'" target="_blank" :class="{'opacity-50 cursor-not-allowed': stock <= 0}" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg text-center text-lg transition-all duration-300 flex items-center justify-center space-x-2 transform hover:scale-105">
                                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                                <span>Pesan via WhatsApp</span>
                            </a>
                            <a href="#" class="text-green-400 text-xl" title="WhatsApp" aria-label="Kunjungi WhatsApp KIDSZSTORE">

                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg text-center text-lg transition-all duration-300 flex items-center justify-center space-x-2 transform hover:scale-105">
                                <span>Masuk untuk Membeli</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>