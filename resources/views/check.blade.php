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
                                    <p class="text-gray-400 text-sm">Kode: <span class="font-mono">{{ $transaction->code }}</span></p>
                                </div>
                                {{-- Asumsi ada kolom 'status' di tabel transaksi --}}
                                <span class="mt-2 sm:mt-0 px-3 py-1 text-sm font-semibold rounded-full
                                    {{ ($transaction->status ?? 'pending') === 'success' ? 'bg-green-500/20 text-green-300' :
                                       (($transaction->status ?? 'pending') === 'pending' ? 'bg-yellow-500/20 text-yellow-300' :
                                       'bg-red-500/20 text-red-300') }}">
                                    {{ ucfirst($transaction->status ?? 'pending') }}
                                </span>
                            </div>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                                {{-- Asumsi ada kolom-kolom ini di tabel transaksi --}}
                                <div class="flex justify-between"><span class="text-gray-400">Produk:</span><span class="font-semibold">{{ $transaction->product_name ?? 'N/A' }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">User ID:</span><span class="font-semibold">{{ $transaction->user_id ?? 'N/A' }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Harga:</span><span class="font-semibold">Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Metode Pembayaran:</span><span class="font-semibold">{{ $transaction->payment_method ?? 'N/A' }}</span></div>
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