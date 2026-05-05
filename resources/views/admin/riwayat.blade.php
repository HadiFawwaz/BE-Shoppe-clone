<x-app-layout>
    <div class="py-8 bg-[#f5f5f5] min-h-screen font-sans">
        <div class="max-w-[1000px] mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- HEADER -->
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Pesanan Masuk</h2>
                    <p class="text-gray-500 text-sm mt-1">Pantau, proses, dan update status pengiriman ke pembeli</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="text-sm bg-white border border-gray-300 px-4 py-2 rounded-sm font-bold text-gray-600 hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>

            <!-- LOGIKA PEMISAHAN DATA (MAGIC LARAVEL COLLECTION) -->
            @php
                $statuses = ['Proses', 'Packing', 'Pengantaran', 'Selesai'];

                // 1. Ambil pesanan yang BELUM selesai, lalu kelompokkan berdasarkan user_id
                $activeOrders = $pesanan->filter(function($order) {
                    return ($order->updates->last()->status ?? 'Proses') !== 'Selesai';
                })->groupBy('user_id');

                // 2. Ambil pesanan yang SUDAH selesai
                $completedOrders = $pesanan->filter(function($order) {
                    return ($order->updates->last()->status ?? 'Proses') === 'Selesai';
                });
            @endphp

            <!-- ========================================== -->
            <!-- SECTION 1: PESANAN AKTIF (GROUP PER USER) -->
            <!-- ========================================== -->
            <div>
                <div class="flex items-center gap-2 mb-4 border-b border-gray-200 pb-2">
                    <svg class="w-6 h-6 text-[#ee4d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-800">Pesanan Perlu Diproses</h3>
                </div>

                @forelse($activeOrders as $userId => $userOrders)
                    <!-- BUNGKUSAN 1 USER -->
                    <div class="bg-white rounded-sm shadow-sm border border-orange-200 mb-6 overflow-hidden">
                        
                        <!-- Header Nama User -->
                        <div class="bg-orange-50/80 border-b border-orange-100 px-6 py-3 flex justify-between items-center">
                            <div class="font-bold text-[#ee4d2d] flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Pesanan dari: User #{{ $userId }}
                                <span class="bg-[#ee4d2d] text-white text-[10px] px-2 py-0.5 rounded-sm ml-2 font-bold">{{ $userOrders->count() }} Item</span>
                            </div>
                        </div>

                        <!-- Daftar Pesanan Milik User Tersebut -->
                        <div class="p-6 space-y-6 bg-gray-50/30">
                            @foreach($userOrders as $order)
                                @php
                                    $latestStatus = $order->updates->last()->status ?? 'Proses';
                                    $currentIndex = array_search($latestStatus, $statuses);
                                    if ($currentIndex === false) $currentIndex = 0;
                                @endphp
                                
                                <!-- KARTU PESANAN DALAM GROUP -->
                                <div class="border border-gray-200 bg-white rounded-sm shadow-sm overflow-hidden relative">
                                    <div class="bg-white border-b border-gray-100 px-6 py-3 flex justify-between items-center">
                                        <span class="font-bold text-gray-700 tracking-wide">#TRX-{{ $order->id }}</span>
                                        <div class="font-bold text-[#ee4d2d] text-lg">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                                    </div>

                                    <div class="p-6 flex flex-col md:flex-row gap-6 items-center">
                                        <!-- Foto & Info -->
                                        <div class="flex gap-4 flex-1 w-full">
                                            <div class="w-20 h-20 flex-shrink-0 border border-gray-200 rounded-sm overflow-hidden bg-gray-50">
                                                @if($order->product && $order->product->gambar)
                                                    <img src="{{ asset('storage/' . $order->product->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                                        <span class="text-[9px]">No Image</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <h4 class="font-semibold text-gray-800 text-base leading-tight">{{ $order->product->nama_barang ?? 'Produk Dihapus' }}</h4>
                                                <p class="text-sm text-gray-500 mt-1">Variasi: <span class="font-bold text-gray-700">Default</span></p>
                                                <p class="text-sm text-gray-500">Jumlah dibeli: <span class="font-bold text-[#ee4d2d]">{{ $order->jumlah }} Item</span></p>
                                            </div>
                                        </div>

                                        <!-- Form Update -->
                                        <div class="flex flex-col justify-center w-full md:w-auto md:items-end border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6">
                                            <p class="text-[10px] font-bold text-gray-400 mb-2 uppercase tracking-widest">Update Status Resi</p>
                                            <form action="{{ route('admin.status.update', $order->id) }}" method="POST" class="flex gap-2 w-full md:w-64">
                                                @csrf
                                                <select name="status" class="flex-1 text-sm border-gray-300 rounded-sm focus:border-[#ee4d2d] focus:ring-[#ee4d2d] py-2 cursor-pointer shadow-sm font-semibold text-gray-700">
                                                    @foreach($statuses as $status)
                                                        <option value="{{ $status }}" {{ $latestStatus == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="bg-[#ee4d2d] text-white text-sm font-bold px-4 py-2 rounded-sm hover:bg-[#d73211] transition shadow-sm">SIMPAN</button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Informasi Pengiriman Pembeli -->
                                    <div class="border-t border-gray-100 bg-orange-50/10 px-6 py-4">
                                        <h4 class="text-xs font-bold text-[#ee4d2d] uppercase mb-2 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Informasi Pengiriman Pembeli
                                        </h4>
                                        <div class="text-sm text-gray-700 grid grid-cols-1 md:grid-cols-2 gap-2">
                                            <p><span class="font-bold text-gray-800">Penerima:</span> {{ $order->user->name ?? 'User Tidak Diketahui' }}</p>
                                            <p><span class="font-bold text-gray-800">No. HP:</span> {{ $order->user->no_hp ?? 'Belum diisi pembeli' }}</p>
                                            <p class="md:col-span-2"><span class="font-bold text-gray-800">Alamat:</span> {{ $order->user->alamat ?? 'Belum diisi pembeli' }}</p>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="bg-blue-50/20 border-t border-gray-100 px-6 py-5 overflow-x-auto">
                                        <div class="min-w-[500px] max-w-2xl mx-auto relative mt-2">
                                            <div class="absolute top-4 left-[10%] right-[10%] h-1 bg-gray-200 -z-10 rounded-full"></div>
                                            <div class="absolute top-4 left-[10%] h-1 bg-[#26aa99] -z-10 rounded-full transition-all duration-500" style="width: {{ ($currentIndex / 3) * 80 }}%;"></div>
                                            <div class="flex items-center justify-between relative z-10">
                                                @foreach($statuses as $index => $status)
                                                    <div class="flex flex-col items-center w-1/4">
                                                        <div class="w-9 h-9 rounded-full flex items-center justify-center border-4 shadow-sm transition-colors duration-500 {{ $index <= $currentIndex ? 'bg-[#26aa99] border-white text-white' : 'bg-white border-gray-200 text-gray-300' }}">
                                                            @if($index < $currentIndex)
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                            @elseif($index == $currentIndex)
                                                                <div class="w-3 h-3 bg-white rounded-full"></div>
                                                            @endif
                                                        </div>
                                                        <p class="mt-2 text-[10px] font-bold uppercase tracking-wider text-center {{ $index <= $currentIndex ? 'text-[#26aa99]' : 'text-gray-400' }}">{{ $status }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <!-- Kosong Aktif -->
                    <div class="bg-white p-12 rounded-sm shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center mb-6">
                        <span class="text-4xl mb-3">🎉</span>
                        <h3 class="text-xl font-bold text-gray-700">Tidak ada pesanan tertunda!</h3>
                        <p class="text-gray-500 text-sm mt-1">Semua pesanan sudah berhasil diselesaikan.</p>
                    </div>
                @endforelse
            </div>

            <!-- ========================================== -->
            <!-- SECTION 2: RIWAYAT SELESAI (PISAH BAWAH) -->
            <!-- ========================================== -->
            <div class="pt-6">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-200 pb-2">
                    <svg class="w-6 h-6 text-[#26aa99]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-800">Riwayat Pesanan Selesai</h3>
                </div>

                <div class="space-y-6">
                    @forelse($completedOrders as $order)
                        <!-- KARTU PESANAN SELESAI (Agak pudar biar gak menonjol) -->
                        <div class="bg-white rounded-sm shadow-sm border border-gray-200 overflow-hidden opacity-80 hover:opacity-100 transition">
                            <div class="bg-gray-50 border-b border-gray-100 px-6 py-3 flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-gray-500 tracking-wide">#TRX-{{ $order->id }}</span>
                                    <span class="text-xs text-gray-500 font-medium bg-white px-2 py-0.5 border rounded-sm">User #{{ $order->user_id }}</span>
                                </div>
                                <div class="font-bold text-gray-600 text-lg">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                            </div>

                            <div class="p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="flex gap-4 flex-1 w-full">
                                    <div class="w-16 h-16 flex-shrink-0 border border-gray-200 rounded-sm overflow-hidden bg-gray-50">
                                        @if($order->product && $order->product->gambar)
                                            <img src="{{ asset('storage/' . $order->product->gambar) }}" class="w-full h-full object-cover grayscale">
                                        @endif
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h4 class="font-semibold text-gray-700 text-base line-through">{{ $order->product->nama_barang ?? 'Produk Dihapus' }}</h4>
                                        <p class="text-sm text-gray-500">Telah diterima oleh pembeli.</p>
                                    </div>
                                </div>

                                <!-- Form Cuma Bisa Diubah Kalau Mau Ditarik Lagi (Opsional) -->
                                <div class="flex flex-col justify-center w-full md:w-auto md:items-end pt-4 md:pt-0 md:pl-6">
                                    <span class="bg-green-100 text-green-700 text-xs font-bold px-4 py-2 rounded-sm flex items-center gap-2 border border-green-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        TRANSAKSI SELESAI
                                    </span>
                                </div>
                            </div>

                            <!-- Informasi Pengiriman Pembeli (Riwayat) -->
                            <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-4">
                                <h4 class="text-xs font-bold text-gray-500 uppercase mb-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Informasi Pengiriman Pembeli
                                </h4>
                                <div class="text-sm text-gray-500 grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <p><span class="font-bold text-gray-600">Penerima:</span> {{ $order->user->name ?? 'User Tidak Diketahui' }}</p>
                                    <p><span class="font-bold text-gray-600">No. HP:</span> {{ $order->user->no_hp ?? 'Belum diisi pembeli' }}</p>
                                    <p class="md:col-span-2"><span class="font-bold text-gray-600">Alamat:</span> {{ $order->user->alamat ?? 'Belum diisi pembeli' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-8 rounded-sm shadow-sm border border-gray-100 text-center text-gray-500 text-sm">
                            Belum ada riwayat pesanan yang selesai.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>