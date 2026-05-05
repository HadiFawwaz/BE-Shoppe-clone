<x-app-layout>
    <div class="min-h-screen bg-[#f8fAfc] pb-20 font-sans selection:bg-[#ee4d2d] selection:text-white">
        
        <!-- 1. HEADER & TAB NAVIGATION (MODERN GRADIENT) -->
        <header class="bg-gradient-to-r from-[#ee4d2d] via-[#f15a24] to-[#ff8c42] pt-12 pb-20 px-6 md:px-12 relative overflow-hidden">
            <!-- Dekorasi Abstrak -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 20%, #fff 0 2px, transparent 3px);"></div>
            
            <div class="max-w-5xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-8 relative z-10">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tighter lowercase">pesanan saya.</h1>
                    <p class="text-white/80 text-xs font-bold mt-1 tracking-widest uppercase">lacak petualangan belanja anda.</p>
                </div>
                
                <!-- Pill-shaped Tabs (Melayang) -->
                <nav class="flex gap-2 overflow-x-auto pb-2 md:pb-0 no-scrollbar">
                    <button onclick="filterOrders('all', this)" class="tab-btn whitespace-nowrap bg-white text-[#ee4d2d] px-6 py-2.5 rounded-full text-xs font-black shadow-xl shadow-black/5 transition-all">semua.</button>
                    <button onclick="filterOrders('Proses', this)" class="tab-btn whitespace-nowrap bg-white/10 text-white border border-white/20 hover:bg-white/30 px-6 py-2.5 rounded-full text-xs font-black transition-all">belum bayar.</button>
                    <button onclick="filterOrders('Packing', this)" class="tab-btn whitespace-nowrap bg-white/10 text-white border border-white/20 hover:bg-white/30 px-6 py-2.5 rounded-full text-xs font-black transition-all">dikemas.</button>
                    <button onclick="filterOrders('Pengantaran', this)" class="tab-btn whitespace-nowrap bg-white/10 text-white border border-white/20 hover:bg-white/30 px-6 py-2.5 rounded-full text-xs font-black transition-all">dikirim.</button>
                    <button onclick="filterOrders('Selesai', this)" class="tab-btn whitespace-nowrap bg-white/10 text-white border border-white/20 hover:bg-white/30 px-6 py-2.5 rounded-full text-xs font-black transition-all">selesai.</button>
                </nav>
            </div>
        </header>

        <main class="max-w-5xl mx-auto px-6 -mt-10 relative z-20 space-y-8">
            
            @forelse($history as $order)
                @php
                    $latestStatus = $order->updates->last()->status ?? 'Proses';
                    
                    // Style Status Badge Pastel
                    $statusStyles = match($latestStatus) {
                        'Selesai' => 'bg-emerald-50 text-emerald-600',
                        'Proses' => 'bg-amber-50 text-amber-600',
                        'Packing' => 'bg-purple-50 text-purple-600',
                        'Pengantaran' => 'bg-blue-50 text-blue-600',
                        default => 'bg-gray-50 text-gray-600'
                    };
                @endphp

                <!-- 2. ORDER CARD (BENTO BOX STYLE) -->
                <div class="order-card bg-white rounded-[32px] shadow-[0_15px_40px_rgba(0,0,0,0.03)] p-8 border-none hover:shadow-[0_20px_50px_rgba(0,0,0,0.06)] transition-all duration-500 group" data-status="{{ $latestStatus }}">
                    
                    <!-- Store Info & Status Badge -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-50 rounded-full flex items-center justify-center text-[#ee4d2d]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <span class="text-xs font-black text-gray-800 tracking-tight lowercase">laravel official store.</span>
                        </div>
                        
                        <span class="{{ $statusStyles }} px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $latestStatus }}</span>
                    </div>

                    <!-- Product Row -->
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <!-- Image Container (Gallery Style) -->
                        <div class="w-full md:w-32 aspect-square bg-gray-50 rounded-3xl overflow-hidden shrink-0 border border-gray-50 shadow-inner">
                            <img src="{{ $order->product && $order->product->gambar ? asset('storage/' . $order->product->gambar) : 'https://via.placeholder.com/200' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Produk">
                        </div>

                        <!-- Product Detail -->
                        <div class="flex-grow space-y-4">
                            <h4 class="text-xl font-black text-gray-900 tracking-tighter lowercase leading-tight line-clamp-2">
                                {{ $order->product->nama_barang ?? 'produk tidak tersedia.' }}
                            </h4>
                            
                            <!-- Latest Status Pulse (Simplified) -->
                            <div class="bg-gray-50/80 rounded-2xl p-4 border border-gray-100 flex items-center gap-3">
                                <div class="w-2 h-2 bg-[#ee4d2d] rounded-full animate-pulse"></div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">status terakhir.</span>
                                    <span class="text-xs font-bold text-gray-700">
                                        {{ $order->updates->last()->status ?? 'pesanan sedang diproses sistem.' }} - {{ $order->updates->last() ? $order->updates->last()->created_at->format('d M, H:i') : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Price Info -->
                        <div class="w-full md:w-auto flex flex-col items-end justify-center md:border-l md:pl-8 border-gray-100">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">total belanja.</span>
                            <p class="text-2xl font-black text-[#ee4d2d] tracking-tighter">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons (Pill-shaped) -->
                    <div class="mt-10 pt-8 border-t border-gray-50 flex flex-col sm:flex-row justify-end items-center gap-4">
                        <button class="w-full sm:w-auto px-8 py-3 rounded-full border-2 border-gray-100 text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] hover:bg-gray-50 hover:text-gray-600 transition-all">hubungi penjual.</button>
                        
                        @if($latestStatus == 'Selesai')
                            <button class="w-full sm:w-auto px-8 py-3 rounded-full border-2 border-amber-200 text-amber-600 font-black text-[10px] uppercase tracking-[0.2em] hover:bg-amber-50 transition-all">beri rating.</button>
                        @endif

                        <form action="{{ route('buyer.checkout', $order->product_id) }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full px-10 py-4 rounded-full bg-[#ee4d2d] text-white font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-orange-500/25 hover:bg-[#d73211] hover:scale-105 active:scale-95 transition-all">
                                beli lagi.
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <!-- 3. EMPTY STATE (PREMIUM 3D STYLE) -->
                <div class="bg-white rounded-[40px] p-20 shadow-[0_20px_60px_rgba(0,0,0,0.03)] flex flex-col items-center text-center border-none">
                    <div class="w-48 h-48 bg-orange-50 rounded-full flex items-center justify-center mb-10 relative">
                        <div class="absolute inset-4 bg-orange-100/50 rounded-full animate-pulse"></div>
                        <svg class="w-20 h-20 text-[#ee4d2d] relative z-10 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 tracking-tighter lowercase">belum ada pesanan.</h3>
                    <p class="text-gray-400 font-semibold text-sm mt-3 max-w-xs mx-auto">yuk, mulai jelajahi ribuan produk menarik dan buat pesanan pertamamu hari ini!</p>
                    <a href="{{ route('buyer.katalog') }}" class="mt-12 px-12 py-5 bg-gray-900 text-white rounded-full font-black text-[11px] uppercase tracking-[0.3em] shadow-2xl shadow-black/20 hover:scale-105 active:scale-95 transition-all">mulai belanja.</a>
                </div>
            @endforelse

        </main>
    </div>

    <!-- JAVASCRIPT FILTER MODERN -->
    <script>
        function filterOrders(status, element) {
            // Update Tab Style
            const tabs = document.querySelectorAll('.tab-btn');
            tabs.forEach(tab => {
                tab.classList.remove('bg-white', 'text-[#ee4d2d]', 'shadow-xl', 'shadow-black/5');
                tab.classList.add('bg-white/10', 'text-white', 'border', 'border-white/20');
            });

            element.classList.remove('bg-white/10', 'text-white', 'border', 'border-white/20');
            element.classList.add('bg-white', 'text-[#ee4d2d]', 'shadow-xl', 'shadow-black/5');

            // Filter Cards
            const cards = document.querySelectorAll('.order-card');
            cards.forEach(card => {
                if (status === 'all') {
                    card.style.display = 'block';
                } else {
                    card.getAttribute('data-status') === status ? card.style.display = 'block' : card.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>