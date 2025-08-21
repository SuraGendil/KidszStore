<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order - KIDSZSTORE</title>
    <link rel="icon" href="https://placehold.co/32x32/1A255B/ffffff?text=KS" type="image/x-icon">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #1A255B;
        }
        .info-label {
            @apply block text-sm font-medium text-gray-400 mb-1;
        }
        .info-value {
            @apply w-full px-4 py-2 bg-[#1A255B] border border-gray-600 rounded-lg text-gray-200;
        }
    </style>
</head>
<body class="bg-[#1A255B] text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-2xl bg-[#0e1a4b] p-8 rounded-2xl shadow-2xl border border-gray-700">
        <h1 class="text-3xl font-bold text-center mb-8">Edit Order: #{{ $order->order_id }}</h1>

        @if (session('success'))
            <div class="bg-green-500/20 text-green-400 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-500/20 text-red-400 p-3 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <span class="info-label">Pelanggan</span>
                <div class="info-value">{{ $order->user->name ?? 'N/A' }}</div>
            </div>
            <div>
                <span class="info-label">Email Pelanggan</span>
                <div class="info-value">{{ $order->user->email ?? 'N/A' }}</div>
            </div>
            <div>
                <span class="info-label">Produk</span>
                <div class="info-value">{{ $order->product->title ?? 'Produk Dihapus' }}</div>
            </div>
            <div>
                <span class="info-label">Total Harga</span>
                <div class="info-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
            </div>
            <div>
                <span class="info-label">Tanggal Pesanan</span>
                <div class="info-value">{{ $order->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div>
                <span class="info-label">Status Pembayaran</span>
                <div class="info-value capitalize">{{ $order->status }}</div>
            </div>
        </div>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="progress_id" class="block text-sm font-medium text-gray-300 mb-2">Update Progres Pesanan</label>
                <select id="progress_id" name="progress_id" class="w-full px-4 py-2 bg-[#1A255B] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @foreach($progresses as $progress)
                        <option value="{{ $progress->id }}" {{ old('progress_id', $order->progress_id) == $progress->id ? 'selected' : '' }}>
                            {{ $progress->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-between mt-8">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition-colors duration-200">
                    &larr; Kembali ke Dashboard
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200">
                    Update Status
                </button>
            </div>
        </form>
    </div>

</body>
</html>