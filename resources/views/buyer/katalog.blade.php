<x-app-layout>
    @php
        $shortcutMenus = [
            ['name' => 'pilih lokal.', 'color' => 'bg-red-50 text-red-500', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
            ['name' => 'shopee mall.', 'color' => 'bg-red-100 text-red-600', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
            ['name' => 'pulsa.', 'color' => 'bg-blue-50 text-blue-500', 'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
            ['name' => 'flash sale.', 'color' => 'bg-yellow-50 text-yellow-600', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
            ['name' => 'supermarket.', 'color' => 'bg-green-50 text-green-500', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z'],
            ['name' => 'dikelola.', 'color' => 'bg-purple-50 text-purple-500', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
            ['name' => 'diskon 25%.', 'color' => 'bg-pink-50 text-pink-500', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
            ['name' => 'gratis ongkir.', 'color' => 'bg-teal-50 text-teal-500', 'icon' => 'M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10 M13 8h4a1 1 0 01.8.4l3 4v3.6a1 1 0 01-1 1h-1'],
            ['name' => 'barokah.', 'color' => 'bg-emerald-50 text-emerald-600', 'icon' => 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z'],
            ['name' => 'promo.', 'color' => 'bg-orange-50 text-orange-500', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z'],
        ];

        $categories = [
            ['name' => 'elektronik.', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ['name' => 'komputer.', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ['name' => 'handphone.', 'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
            ['name' => 'pakaian.', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
            ['name' => 'sepatu.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
            ['name' => 'tas pria.', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
            ['name' => 'aksesoris.', 'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.518 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.518-4.674z'],
            ['name' => 'jam tangan.', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['name' => 'kesehatan.', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ['name' => 'hobi.', 'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ];

        $flashSaleProducts = $products->take(6);
        $recommendedProducts = $products->skip(6);
    @endphp

    <div class="min-h-screen bg-[#f8fAfc] pb-20 font-sans selection:bg-[#ee4d2d] selection:text-white">
        <div class="mx-auto max-w-7xl px-4 pt-8 space-y-20"> <!-- Spacing antar section 80px -->
            
            <!-- 1. BANNER SECTION (BENTO STYLE) -->
            <section class="grid grid-cols-12 gap-6">
                <div class="col-span-12 lg:col-span-8 relative min-h-[350px] rounded-[32px] overflow-hidden shadow-xl shadow-gray-200/50 bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] group">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 20%, #fff 0 2px, transparent 3px);"></div>
                    <div class="relative z-10 flex h-full flex-col justify-center px-12 text-white">
                        <div class="inline-flex bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold w-fit mb-4 border border-white/20">Special Offer</div>
                        <h2 class="text-5xl font-black tracking-tighter">shopee pilih lokal.</h2>
                        <p class="mt-3 text-lg font-medium text-white/90">rumah produk lokal no. 1 di indonesia.</p>
                        <div class="mt-8 flex">
                            <a href="#" class="bg-white text-[#ee4d2d] px-8 py-3 rounded-full font-bold text-sm shadow-lg hover:scale-105 transition duration-300">jelajahi brand lokal.</a>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:grid col-span-4 grid-rows-2 gap-6">
                    <div class="rounded-[32px] bg-gradient-to-br from-[#cf102d] to-[#f53d2d] p-8 text-white shadow-xl shadow-red-100/50 flex flex-col justify-center group cursor-pointer overflow-hidden relative">
                         <div class="relative z-10">
                            <p class="text-2xl font-black tracking-tighter">shopee mall.</p>
                            <p class="text-sm font-bold opacity-80 uppercase tracking-widest">100% original.</p>
                         </div>
                         <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-white/10 group-hover:rotate-12 transition duration-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.45L20.15 19H3.85L12 5.45z"/></svg>
                    </div>
                    <div class="rounded-[32px] bg-white border border-gray-100 p-8 text-gray-900 shadow-xl shadow-gray-200/40 flex flex-col justify-center group cursor-pointer overflow-hidden relative">
                        <div class="relative z-10">
                            <p class="text-2xl font-black tracking-tighter">shopee barokah.</p>
                            <p class="text-sm font-bold text-[#26aa99]">diskon sampai 80%.</p>
                        </div>
                        <div class="absolute -right-2 top-4 text-6xl opacity-5 group-hover:scale-125 transition duration-700">🌙</div>
                    </div>
                </div>
            </section>

            <!-- 2. SHORTCUT MENUS (CLEAN BENTO) -->
            <section class="grid grid-cols-5 gap-6 bg-white p-10 lg:grid-cols-10 shadow-[0_8px_40px_rgba(0,0,0,0.03)] rounded-[32px]">
                @foreach ($shortcutMenus as $menu)
                    <div class="flex flex-col items-center gap-3 text-center cursor-pointer group">
                        <div class="flex h-16 w-16 items-center justify-center rounded-[24px] {{ $menu['color'] }} bg-opacity-10 group-hover:scale-110 transition duration-300">
                            <svg class="w-7 h-7 {{ $menu['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $menu['icon'] }}"></path>
                            </svg>
                        </div>
                        <p class="text-[11px] font-bold text-gray-500 tracking-tight lowercase">{{ $menu['name'] }}</p>
                    </div>
                @endforeach
            </section>

            <!-- 3. KATEGORI (MODERN & BORDERLESS) -->
            <section class="bg-white rounded-[32px] shadow-[0_8px_40px_rgba(0,0,0,0.03)] p-10">
                <div class="mb-10 flex items-center justify-between">
                    <h2 class="text-2xl font-black tracking-tighter text-gray-900 uppercase">kategori.</h2>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-5 lg:grid-cols-10 gap-x-8 gap-y-10">
                    @foreach ($categories as $category)
                        <div class="flex flex-col items-center gap-4 text-center cursor-pointer group">
                            <div class="h-16 w-16 rounded-[24px] bg-gray-50 flex items-center justify-center text-[#ee4d2d] group-hover:bg-[#ee4d2d] group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $category['icon'] }}"></path>
                                </svg>
                            </div>
                            <p class="text-[10px] font-bold text-gray-400 lowercase group-hover:text-[#ee4d2d] transition">{{ $category['name'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- 4. FLASH SALE (REFINED DESIGN) -->
            <section class="bg-white rounded-[32px] shadow-[0_20px_60px_rgba(0,0,0,0.03)] p-10">
                <div class="flex items-center justify-between mb-10">
                    <div class="flex items-center gap-5">
                        <h2 class="text-3xl font-black tracking-tighter text-[#ee4d2d] uppercase">flash sale.</h2>
                        <div class="flex items-center gap-2">
                            <span id="fs-hours" class="bg-gray-900 px-3 py-1.5 rounded-full text-[11px] font-black text-white">00</span>
                            <span class="font-black text-gray-900">:</span>
                            <span id="fs-minutes" class="bg-gray-900 px-3 py-1.5 rounded-full text-[11px] font-black text-white">00</span>
                            <span class="font-black text-gray-900">:</span>
                            <span id="fs-seconds" class="bg-gray-900 px-3 py-1.5 rounded-full text-[11px] font-black text-white">00</span>
                        </div>
                    </div>
                    <a href="#" class="text-sm font-bold text-[#ee4d2d] hover:underline lowercase">lihat semua.</a>
                </div>

                <div class="grid grid-cols-2 gap-8 md:grid-cols-3 lg:grid-cols-6">
                    @foreach ($flashSaleProducts as $product)
                        @php $hargaDiskon = $product->harga * 0.8; @endphp
                        <div class="group relative flex flex-col bg-white rounded-[28px] transition-all duration-500 hover:-translate-y-2">
                            <!-- Image Container (Consistent bg-gray-50) -->
                            <div class="relative aspect-square overflow-hidden bg-gray-50 rounded-[24px]">
                                <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : 'https://via.placeholder.com/220x220' }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                <span class="absolute right-3 top-3 bg-[#ffe97a] px-3 py-1 text-[10px] font-black text-[#ee4d2d] rounded-full shadow-sm">-20%</span>
                            </div>
                            
                            <div class="mt-4 space-y-1">
                                <p class="text-[10px] font-bold text-gray-300 line-through">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                                <p class="text-xl font-black text-[#ee4d2d]">Rp{{ number_format($hargaDiskon, 0, ',', '.') }}</p>
                                
                                <div class="h-2 w-full bg-orange-100 rounded-full mt-3 overflow-hidden relative">
                                    <div class="h-full w-1/2 bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] rounded-full"></div>
                                </div>
                                <p class="text-[9px] font-bold text-[#ee4d2d] uppercase tracking-tighter mt-1 italic">60% terjual</p>
                            </div>

                            <!-- Modern Floating Action Button -->
                            <a href="{{ route('buyer.checkout.page', ['id' => $product->id, 'is_flash_sale' => 1]) }}" 
                               class="absolute bottom-16 right-4 bg-[#ee4d2d] text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg shadow-orange-500/30 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 active:scale-90">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- 5. REKOMENDASI (CONSISTENCY & CLEAN ALIGNMENT) -->
            <section>
                <div class="mb-10 text-center relative">
                    <!-- Garis dihapus, diganti dengan text-center murni -->
                    <h2 class="text-3xl font-black tracking-tighter text-gray-900 uppercase">rekomendasi buat kamu.</h2>
                </div>

                <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-6">
                    @foreach ($recommendedProducts as $product)
                        <div class="group relative bg-white rounded-[28px] p-4 shadow-[0_8px_30px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 flex flex-col h-full border-none">
                             <!-- Image Container (Consistent bg-gray-50) -->
                            <div class="relative aspect-square overflow-hidden bg-gray-50 rounded-[22px] mb-4">
                                <img src="{{ asset('storage/' . $product->gambar) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute top-2 left-2 bg-white/60 backdrop-blur-md text-[#ee4d2d] text-[9px] font-black px-2 py-0.5 rounded-lg border border-white/20">Star</div>
                            </div>
                            
                            <div class="space-y-1 flex-grow">
                                <h4 class="text-xs font-bold text-gray-700 line-clamp-2 lowercase leading-tight">{{ $product->nama_barang }}.</h4>
                                <p class="text-lg font-black text-[#ee4d2d] pt-2">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                            </div>

                            <!-- Info Stok & Kota Sejajar Kiri-Kanan -->
                            <div class="mt-5 pt-4 border-t border-gray-50 flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter leading-none mb-1">stok.</span>
                                    <span class="text-[10px] font-black text-gray-700 leading-none">{{ $product->stok }}</span>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter leading-none mb-1">lokasi.</span>
                                    <span class="text-[10px] font-black text-gray-700 leading-none">Bogor.</span>
                                </div>
                            </div>

                            <!-- Modern Floating Action Button -->
                            <a href="{{ route('buyer.checkout.page', $product->id) }}" 
                               class="absolute bottom-20 right-8 bg-gray-900 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <!-- SCRIPT COUNTDOWN (Refined Logic) -->
    <script>
        let countDownDate = new Date().getTime() + (6 * 60 * 60 * 1000) + (50 * 60 * 1000) + (31 * 1000);
        let x = setInterval(function() {
            let now = new Date().getTime();
            let distance = countDownDate - now;
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            
            if(document.getElementById("fs-hours")) {
                document.getElementById("fs-hours").innerHTML = hours;
                document.getElementById("fs-minutes").innerHTML = minutes;
                document.getElementById("fs-seconds").innerHTML = seconds;
            }
        }, 1000);
    </script>
</x-app-layout>