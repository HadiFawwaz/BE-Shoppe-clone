<x-app-layout>
    <!-- HEADER ORANYE (Sudah dilebarin) -->
    <div class="bg-[#ee4d2d] py-6 shadow-sm">
        <div class="max-w-[1200px] mx-auto px-4 flex justify-between items-center">
            <div class="text-white">
                <h1 class="text-2xl font-bold">Pesanan Saya 📦</h1>
                <p class="text-sm opacity-90 mt-1">Lacak status pembelian Anda</p>
            </div>
            <a href="{{ route('buyer.katalog') }}" class="bg-white text-[#ee4d2d] px-5 py-2 rounded-sm font-bold text-sm hover:bg-gray-100 transition shadow-sm flex items-center gap-2">
                &larr; Belanja Lagi
            </a>
        </div>
    </div>

    <div class="bg-[#f5f5f5] min-h-screen pb-12 font-sans pt-6">
        <!-- CONTAINER UTAMA (Sudah dilebarin) -->
        <div class="max-w-[1200px] mx-auto px-4 space-y-4">
            
            <!-- TABS NAVIGASI -->
            <div class="bg-white rounded-sm shadow-sm flex overflow-x-auto border-b border-gray-200">
                <button onclick="filterOrders('all', this)" class="tab-btn flex-1 min-w-[150px] py-4 text-sm font-bold text-[#ee4d2d] border-b-2 border-[#ee4d2d] hover:text-[#ee4d2d] transition flex justify-center items-center gap-2">
                    📋 Semua Pesanan
                </button>
                <button onclick="filterOrders('Proses', this)" class="tab-btn flex-1 min-w-[150px] py-4 text-sm font-medium text-gray-600 border-b-2 border-transparent hover:text-[#ee4d2d] transition flex justify-center items-center gap-2">
                    ⏳ Menunggu Bayar
                </button>
                <button onclick="filterOrders('Packing', this)" class="tab-btn flex-1 min-w-[150px] py-4 text-sm font-medium text-gray-600 border-b-2 border-transparent hover:text-[#ee4d2d] transition flex justify-center items-center gap-2">
                    📦 Dikemas
                </button>
                <button onclick="filterOrders('Pengantaran', this)" class="tab-btn flex-1 min-w-[150px] py-4 text-sm font-medium text-gray-600 border-b-2 border-transparent hover:text-[#ee4d2d] transition flex justify-center items-center gap-2">
                    🚚 Dikirim
                </button>
                <button onclick="filterOrders('Selesai', this)" class="tab-btn flex-1 min-w-[150px] py-4 text-sm font-medium text-gray-600 border-b-2 border-transparent hover:text-[#ee4d2d] transition flex justify-center items-center gap-2">
                    ✅ Selesai
                </button>
            </div>

            <!-- CONTAINER PESANAN -->
            <div class="space-y-4">
                @forelse($history as $order)
                    @php
                        $latestStatus = $order->updates->last()->status ?? 'Proses';
                        
                        $badgeClass = 'bg-gray-100 text-gray-600';
                        if($latestStatus == 'Proses') $badgeClass = 'bg-yellow-100 text-yellow-700';
                        if($latestStatus == 'Packing') $badgeClass = 'bg-purple-100 text-purple-700';
                        if($latestStatus == 'Pengantaran') $badgeClass = 'bg-blue-100 text-blue-700';
                        if($latestStatus == 'Selesai') $badgeClass = 'bg-green-100 text-green-700';
                    @endphp

                    <div class="order-card bg-white rounded-sm shadow-sm border border-gray-100 overflow-hidden" data-status="{{ $latestStatus }}">
                        
                        <!-- Header Toko & Status -->
                        <div class="px-6 py-3 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">🏪</span>
                                <div>
                                    <h3 class="text-sm font-bold text-gray-800">Laravel Official Store</h3>
                                    <p class="text-[10px] text-gray-500">Toko Terpercaya</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="{{ $badgeClass }} text-xs font-bold px-3 py-1 rounded-sm flex items-center gap-1">
                                    @if($latestStatus == 'Selesai') ✅ @endif 
                                    @if($latestStatus == 'Packing') 📦 @endif 
                                    {{ $latestStatus }}
                                </span>
                            </div>
                        </div>

                        <!-- Isi Produk -->
                        <div class="p-6 flex flex-col md:flex-row gap-4 border-b border-gray-100">
                            <div class="w-20 h-20 bg-gray-100 border border-gray-200 rounded-sm overflow-hidden flex-shrink-0">
                                @if($order->product && $order->product->gambar)
                                    <img src="{{ asset('storage/' . $order->product->gambar) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">No Image</div>
                                @endif
                            </div>
                            
                            <div class="flex-1 flex flex-col justify-center">
                                <h4 class="text-base font-bold text-gray-800 leading-tight mb-1">{{ $order->product->nama_barang ?? 'Produk Tidak Tersedia' }}</h4>
                                <p class="text-xs text-gray-500 line-clamp-2 w-3/4">{{ $order->product->deskripsi ?? '' }}</p>
                                <div class="mt-2 text-sm font-bold text-[#ee4d2d]">
                                    Rp{{ number_format($order->product->harga ?? 0, 0, ',', '.') }} <span class="text-xs text-gray-400 font-normal ml-1">x{{ $order->jumlah }}</span>
                                </div>
                            </div>

                            <div class="flex flex-col justify-end text-right md:min-w-[120px] md:border-l border-gray-100 md:pl-4">
                                <p class="text-[10px] text-gray-400 mb-1">Total Belanja:</p>
                                <p class="text-xl font-bold text-[#ee4d2d]">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Riwayat Pengiriman -->
                        <div class="bg-[#fbfcff] px-6 py-3 border-b border-gray-100 text-xs">
                            <p class="font-bold text-gray-700 flex items-center gap-1 mb-1">
                                <svg class="w-3 h-3 text-[#ee4d2d]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                Riwayat Pengiriman:
                            </p>
                            <div class="pl-4 border-l-2 border-blue-200 ml-1 space-y-1">
                                @foreach($order->updates->sortByDesc('created_at') as $update)
                                    <p class="text-gray-600"><span class="font-semibold text-gray-800">{{ $update->status }}</span> - {{ $update->created_at->format('d/m/Y H:i') }}</p>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
                            <button class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-sm text-sm font-medium hover:bg-gray-100 transition shadow-sm">
                                💬 Hubungi Penjual
                            </button>
                            @if($latestStatus == 'Selesai')
                                <button class="bg-white border border-yellow-400 text-yellow-600 px-6 py-2 rounded-sm text-sm font-medium hover:bg-yellow-50 transition shadow-sm">
                                    ⭐ Beri Rating
                                </button>
                            @endif
                            <form action="{{ route('buyer.checkout', $order->product_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-[#ee4d2d] text-white px-8 py-2 rounded-sm text-sm font-bold hover:bg-[#d73211] transition shadow-sm">
                                    Beli Lagi
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="bg-white p-16 rounded-sm shadow-sm text-center border border-gray-100">
                        <div class="text-6xl mb-4">🛒</div>
                        <h3 class="text-xl font-bold text-gray-700">Belum ada pesanan</h3>
                        <p class="text-gray-500 mt-2 mb-6">Ayo temukan barang incaranmu sekarang!</p>
                        <a href="{{ route('buyer.katalog') }}" class="bg-[#ee4d2d] text-white px-6 py-2.5 rounded-sm font-bold hover:bg-[#d73211] transition">Mulai Belanja</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT FILTER TAB -->
    <script>
        function filterOrders(status, element) {
            let tabs = document.querySelectorAll('.tab-btn');
            tabs.forEach(tab => {
                tab.classList.remove('border-[#ee4d2d]', 'text-[#ee4d2d]', 'font-bold');
                tab.classList.add('border-transparent', 'text-gray-600', 'font-medium');
            });

            element.classList.remove('border-transparent', 'text-gray-600', 'font-medium');
            element.classList.add('border-[#ee4d2d]', 'text-[#ee4d2d]', 'font-bold');

            let cards = document.querySelectorAll('.order-card');
            cards.forEach(card => {
                if (status === 'all') {
                    card.style.display = 'block';
                } else {
                    if (card.getAttribute('data-status') === status) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }
    </script>
</x-app-layout>