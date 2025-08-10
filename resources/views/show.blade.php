<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <div class="flex flex-col lg:flex-row gap-8">
            
                    <div class="lg:w-1/2 order-2 lg:order-1">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg mb-8">
                        @else
                            <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center mb-8">
                                <span class="text-gray-500">Gambar Produk Tidak Tersedia</span>
                            </div>
                        @endif
                        
                        <h2 class="text-2xl font-bold mb-4">Keunggulan Akun Ini</h2>
                        <p class="text-gray-700 mb-6">{{ $product->description ?? 'Akun ini memiliki level tinggi dan siap untuk petualanganmu di dunia Blox Fruits!' }}</p>
                        <ul class="list-disc list-inside text-gray-700 mb-8">
                            <li>Akun Level 1000</li>
                            <li>Siap untuk bermain di Second Sea</li>
                            <li>Full Access (email, password, dan PIN)</li>
                            <li>Akun bersih dan aman dari banned</li>
                        </ul>

                        <h2 class="text-2xl font-bold mb-4">Pertanyaan Umum (FAQ)</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-bold">Bagaimana cara melakukan pembelian?</h3>
                                <p>1. Klik tombol "Beli Sekarang".<br>2. Lengkapi formulir pembayaran.<br>3. Lakukan pembayaran.<br>4. Produk akan dikirim melalui email atau chat dalam 5-10 menit.</p>
                            </div>
                            <div>
                                <h3 class="font-bold">Apakah produk ini aman dan legal?</h3>
                                <p>Ya, semua produk yang kami jual 100% aman dan bukan hasil hack. Kami menjamin akun bersih dari banned.</p>
                            </div>
                            <div>
                                <h3 class="font-bold">Apakah ada garansi?</h3>
                                <p>Kami memberikan garansi 24 jam setelah produk diterima. Jika ada masalah, kami akan membantu atau memberikan pengembalian dana.</p>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-1/2 order-1 lg:order-2">
                        <div class="sticky top-8">
                            <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                            <p class="text-4xl font-extrabold text-blue-600 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                            <div class="mb-6 border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-500">Level</span>
                                    <span class="font-semibold">{{ $product->level }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-500">Status</span>
                                    <span class="font-semibold text-green-600">{{ $product->is_available ? 'Ready Stock' : 'Habis' }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-500">Terjual</span>
                                    <span class="font-semibold">{{ $product->sold_count }}+</span>
                                </div>
                            </div>

                            <div class="flex flex-col gap-4">
                                @if($product->is_available)
                                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center text-lg transition-colors">Beli Sekarang</a>
                                @else
                                    <button disabled class="bg-gray-400 text-white font-bold py-3 px-6 rounded-lg text-center text-lg cursor-not-allowed">Stok Habis</button>
                                @endif
                                <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-center text-lg transition-colors">Tanya Admin via WhatsApp</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>