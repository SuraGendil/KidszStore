<x-app-layout>
    {{-- Tentukan URL script Snap.js berdasarkan environment --}}
    @php
        $snapJsUrl = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp

    {{-- Muat script Snap.js dari Midtrans --}}
    <script src="{{ $snapJsUrl }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <div class="w-full max-w-2xl mx-auto mt-32">
        <div class="bg-[#0e1a4b]/80 backdrop-blur-sm border border-blue-400/20 shadow-2xl overflow-hidden sm:rounded-2xl text-white p-6 md:p-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold mb-2">Selesaikan Pembayaran Anda</h2>
                <p class="text-gray-300 mb-6">Satu langkah lagi untuk menyelesaikan pesanan Anda. Klik tombol di bawah untuk membayar.</p>

                <div class="bg-gray-900/50 border border-blue-400/20 rounded-xl p-6 mb-8">
                    <div class="flex justify-between items-center pb-4 border-b border-blue-400/20">
                        <div>
                            <h3 class="text-lg font-bold">Detail Pesanan</h3>
                            <p class="text-gray-400 text-sm">Order ID: <span class="font-mono">{{ $order->order_id }}</span></p>
                        </div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-500/20 text-yellow-300">
                            Pending
                        </span>
                    </div>
                    <div class="mt-4 space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-400">Produk:</span><span class="font-semibold text-right">{{ $order->product->title }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Jumlah:</span><span class="font-semibold">{{ $order->quantity }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Total Harga:</span><span class="font-bold text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></div>
                    </div>
                </div>

                <button id="pay-button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors text-lg">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken di-pass dari controller
        snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* Anda bisa menambahkan logika di sini, misalnya, redirect ke halaman sukses */
            console.log(result);
            window.location.href = '{{ route("transaction.index") }}?transaction_code={{ $order->order_id }}';
          },
          onPending: function(result){
            /* Biasanya terjadi jika pembayaran butuh waktu, seperti transfer bank */
            console.log(result);
            window.location.href = '{{ route("transaction.index") }}?transaction_code={{ $order->order_id }}';
          },
          onError: function(result){
            /* Terjadi jika pembayaran gagal atau popup ditutup */
            console.log(result);
            alert('Pembayaran gagal atau dibatalkan.');
          }
        });
      };
    </script>
</x-app-layout>