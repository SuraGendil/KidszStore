<x-app-layout>
    <div class="w-full max-w-4xl mx-auto mt-32 mb-20">
        <div class="bg-[#0e1a4b]/80 backdrop-blur-sm border border-blue-400/20 shadow-2xl overflow-hidden sm:rounded-2xl text-white p-6 md:p-10">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold">Cara Melakukan Pembelian</h2>
                <p class="text-gray-300 mt-2">Ikuti langkah-langkah mudah di bawah ini untuk menyelesaikan pesanan Anda.</p>
            </div>

            <div class="relative space-y-8">
                
                <div class="absolute left-8 top-8 bottom-8 w-px bg-blue-500/30 hidden md:block"></div>

                <div class="flex items-start gap-8 relative z-10">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white text-2xl font-bold ring-8 ring-[#0e1a4b]">1</div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-blue-300 mb-2 pt-1 flex items-center gap-3">
                            <i class="fa-solid fa-mouse-pointer"></i>
                            Pilih Produk & Isi Data
                        </h3>
                        <p class="text-gray-300">Pilih game, kategori, dan produk yang Anda inginkan. Masukkan jumlah yang di inginkan pada form yang tersedia, lalu pilih jumlah pembelian.</p>
                    </div>
                </div>

                <div class="flex items-start gap-8 relative z-10">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white text-2xl font-bold ring-8 ring-[#0e1a4b]">2</div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-blue-300 mb-2 pt-1 flex items-center gap-3">
                            <i class="fa-solid fa-credit-card"></i>
                            Lakukan Pembayaran
                        </h3>
                        <p class="text-gray-300">Klik tombol "Pesan Sekarang" dan pilih metode pembayaran yang paling nyaman bagi Anda (QRIS, Virtual Account, E-Wallet). Selesaikan pembayaran sesuai instruksi.</p>
                    </div>
                </div>

                <div class="flex items-start gap-8 relative z-10">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white text-2xl font-bold ring-8 ring-[#0e1a4b]">3</div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-blue-300 mb-2 pt-1 flex items-center gap-3">
                            <i class="fa-brands fa-whatsapp"></i>
                            Konfirmasi via WhatsApp
                        </h3>
                        <p class="text-gray-300">Setelah bayar, klik tombol konfirmasi. Jika WhatsApp terbuka dengan pesan otomatis, cukup lengkapi data yang diminta (Username/Password jika membeli Joki atau Gamepass).</p>
                        <p class="text-gray-300 mt-2">Jika pesan kosong, silakan salin dan lengkapi format di bawah ini:</p>
                        
                        <div class="mt-4 bg-slate-800/50 border border-slate-600 rounded-lg p-4 text-left text-sm text-gray-300 font-mono">
                            <p>Halo Admin KIDSZSTORE,</p>
                            <p class="mt-2">Saya ingin konfirmasi pesanan:</p>
                            <ul class="list-none mt-2 space-y-1">
                                <li>ID Pesanan: <strong>[ID Pesanan Anda]</strong></li>
                                <li>Produk: <strong>[Nama Produk Anda]</strong></li>
                                <li>Total: <strong>[Total Bayar Anda]</strong></li>
                            </ul>
                            <hr class="border-slate-600 my-3">
                            <p><strong>DATA AKUN (jika Joki/Gamepass):</strong></p>
                            <ul class="list-none mt-2 space-y-1">
                                <li>Username Roblox:</li>
                                <li>Password Roblox:</li>
                            </ul>
                            <p class="mt-2">Mohon segera diproses. Terima kasih!</p>
                        </div>
                        <div class="mt-4 bg-slate-800/50 border border-slate-700 rounded-lg p-3 text-sm text-gray-400">
                            <p><i class="fa-solid fa-circle-info mr-2 text-blue-400"></i><strong class="text-gray-300">Catatan:</strong> ID Pesanan dapat Anda temukan di halaman <strong class="text-gray-300">Profil</strong> pada bagian <strong class="text-gray-300">Riwayat Transaksi</strong>.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-8 relative z-10">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-green-500 text-white text-2xl font-bold ring-8 ring-[#0e1a4b]"><i class="fa-solid fa-check"></i></div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-green-300 mb-2 pt-1 flex items-center gap-3">
                            <i class="fa-solid fa-cogs"></i>
                            Pesanan Diproses
                        </h3>
                        <p class="text-gray-300">Setelah konfirmasi, pesanan Anda akan segera kami proses. Anda dapat mengecek status pesanan melalui halaman "Cek Transaksi".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>