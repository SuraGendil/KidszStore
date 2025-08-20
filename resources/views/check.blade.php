<x-app-layout>
    {{-- Container utama yang mengikuti tema gelap situs --}}
    <div class="w-full max-w-3xl mx-auto mt-32">
        <div class="bg-[#0e1a4b]/80 backdrop-blur-sm border border-blue-400/20 shadow-2xl overflow-hidden sm:rounded-2xl text-white p-6 md:p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Cek Status Transaksi</h2>
                <p class="text-gray-300 mt-2">Masukkan kode transaksi Anda untuk melihat detail pesanan.</p>
            </div>

            <form action="{{ route('transaction.check') }}" method="GET" class="mb-8">
                {{-- CSRF tidak diperlukan untuk method GET --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <label for="transaction_code" class="sr-only">Kode Transaksi</label>
                    <input
                        type="text"
                        id="transaction_code"
                        name="transaction_code"
                        value="{{ $transactionCode ?? '' }}"
                        class="flex-grow px-4 py-3 rounded-lg bg-gray-900/50 border-blue-400/30 text-white placeholder-gray-400 focus:border-blue-400 focus:ring-blue-400"
                        placeholder="Contoh: KIDSZ-ABC123"
                        required
                    >
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Cari</span>
                    </button>
                </div>
                @error('transaction_code')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </form>

            {{-- Hasil Pencarian --}}
            @if(isset($transactionCode))
                <div class="bg-gray-900/50 border border-blue-400/20 rounded-xl p-6">
                    @if(isset($transaction))
                        <div>
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-4 border-b border-blue-400/20">
                                <div>
                                    <h3 class="text-xl font-bold">Detail Transaksi</h3>
                                    <p class="text-gray-400 text-sm">Kode: <span class="font-mono">{{ $transaction->order_id }}</span></p>
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                                <div class="flex justify-between"><span class="text-gray-400">Produk:</span><span class="font-semibold">{{ $transaction->product->title ?? 'Produk Dihapus' }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Pembeli:</span><span class="font-semibold">{{ $transaction->user->name ?? 'User Dihapus' }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Jumlah:</span><span class="font-semibold">{{ $transaction->quantity }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Total Harga:</span><span class="font-semibold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span></div>
                                <div class="flex justify-between items-center md:col-span-2"><span class="text-gray-400">Status Pembayaran:</span><span class="font-semibold capitalize">{{ $transaction->status }}</span></div>
                                <div class="flex justify-between items-center md:col-span-2">
                                    <span class="text-gray-400">Progres Pesanan:</span>
                                    @if($transaction->progress)
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                                            @switch($transaction->progress->color)
                                                @case('yellow') bg-yellow-500/20 text-yellow-300 @break
                                                @case('blue') bg-blue-500/20 text-blue-400 @break
                                                @case('green') bg-green-500/20 text-green-300 @break
                                                @case('red') bg-red-500/20 text-red-400 @break
                                                @default bg-gray-500/20 text-gray-400
                                            @endswitch
                                        ">{{ $transaction->progress->name }}</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-500/20 text-gray-400">Menunggu Pembayaran</span>
                                    @endif
                                </div>
                                <div class="flex justify-between md:col-span-2"><span class="text-gray-400">Tanggal Transaksi:</span><span class="font-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y, H:i') }}</span></div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fa-solid fa-circle-xmark text-red-400 text-5xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-red-300">Transaksi Tidak Ditemukan</h3>
                            <p class="text-gray-400 mt-2">Pastikan kode <span class="font-mono bg-gray-700/50 px-1 rounded">{{ $transactionCode }}</span> sudah benar dan coba lagi.</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fa-solid fa-file-invoice-dollar text-4xl mb-4"></i>
                    <p>Masukkan kode transaksi Anda di atas untuk melihat status pesanan.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>