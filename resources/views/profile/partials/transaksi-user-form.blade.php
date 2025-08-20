                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Riwayat Transaksi
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Berikut adalah daftar semua transaksi yang pernah Anda lakukan.
                    </p>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID Pesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produk</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Pembayaran</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Progres Pesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $order->order_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $order->product->title ?? 'Produk Dihapus' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $order->status ?? 'Produk Dihapus' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm capitalize">
                                            @if($order->progress)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @switch($order->progress->color)
                                                        @case('yellow') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 @break
                                                        @case('blue') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 @break
                                                        @case('green') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 @break
                                                        @case('red') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @break
                                                        @default bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                    @endswitch
                                                ">
                                                    {{ $order->progress->name }}
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Anda belum memiliki riwayat transaksi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
