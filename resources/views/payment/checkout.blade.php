<x-app-layout>
    @php
        $snapJsUrl = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp

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
                <button id="pay-button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors text-lg disabled:opacity-60 disabled:cursor-not-allowed">
                    <span id="pay-button-text">Bayar Sekarang</span>
                    <span id="pay-button-spinner" class="hidden">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      const payButton = document.getElementById('pay-button');
      const payButtonText = document.getElementById('pay-button-text');
      const payButtonSpinner = document.getElementById('pay-button-spinner');

      payButton.onclick = function(){
        // Nonaktifkan tombol dan tampilkan spinner
        payButton.disabled = true;
        payButtonText.classList.add('hidden');
        payButtonSpinner.classList.remove('hidden');

        snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            console.log(result);
            window.location.href = '{{ route("transaction.index") }}?transaction_code={{ $order->order_id }}';
          },
          onPending: function(result){
            console.log(result);
            window.location.href = '{{ route("transaction.index") }}?transaction_code={{ $order->order_id }}';
          },
          onError: function(result){
            console.log(result);
            alert('Pembayaran gagal atau dibatalkan.');
            // Aktifkan kembali tombol jika terjadi error
            payButton.disabled = false;
            payButtonText.classList.remove('hidden');
            payButtonSpinner.classList.add('hidden');
          }
        });
      };
    </script>
</x-app-layout>