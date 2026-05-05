<nav class="bg-gradient-to-b from-[#f53d2d] to-[#ff6633] text-white">
    <div class="mx-auto max-w-7xl px-4">
        
        <!-- TOP NAV (Menu Kecil di Atas) -->
        <div class="hidden items-center justify-between py-1 text-xs md:flex">
            <div class="flex items-center gap-3">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline font-bold">Seller Centre</a>
                @else
                    <a href="#" class="hover:underline">Seller Centre</a>
                    <a href="#" class="hover:underline">Mulai Berjualan</a>
                    <a href="#" class="hover:underline">Download</a>
                    <a href="#" class="hover:underline">Ikuti kami</a>
                @endif
            </div>
            
            <div class="flex items-center gap-3">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline font-bold">Dashboard Toko</a>
                @else
                    <a href="{{ route('buyer.riwayat') }}" class="hover:underline font-bold">Pesanan Saya</a>
                    <a href="#" class="hover:underline">Notifikasi</a>
                    <a href="#" class="hover:underline">Bantuan</a>
                @endif
                
                <a href="#" class="hover:underline border-l border-white/40 pl-3">Bahasa Indonesia</a>
                <a href="{{ Auth::user()->role === 'admin' ? route('profile.edit') : route('buyer.profile') }}" class="hover:underline">{{ Auth::user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Log Out</button>
                </form>
            </div>
        </div>

        <!-- MAIN HEADER (Logo, Search, Icon) -->
        <div class="grid items-center gap-3 py-4 md:grid-cols-[180px_1fr_56px] md:gap-5">
            
            <!-- Logo Nyesuain Role -->
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('buyer.katalog') }}" class="flex items-center gap-2 hover:opacity-90 transition">
                <span class="rounded-md border-2 border-white px-2 py-1 text-xl font-bold">S</span>
                <span class="text-3xl font-semibold leading-none">Shopee</span>
            </a>

            <!-- Search Bar -->
            <div class="space-y-2">
                <div class="flex items-center overflow-hidden rounded-sm bg-white shadow-sm">
                    <!-- Placeholder berubah tergantung role -->
                    <input type="text" placeholder="{{ Auth::user()->role === 'admin' ? 'Cari data pesanan atau produk di toko...' : 'Daftar & Dapat Voucher Gratis' }}" class="h-10 w-full border-none px-3 text-sm text-gray-700 placeholder:text-gray-400 focus:ring-0">
                    <button class="flex h-10 w-14 items-center justify-center bg-[#ff6633] text-white hover:bg-[#f05328]" type="button" aria-label="Search">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.5 3a5.5 5.5 0 1 0 3.473 9.765l3.63 3.631a.75.75 0 1 0 1.06-1.06l-3.63-3.63A5.5 5.5 0 0 0 8.5 3Zm-4 5.5a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Teks Rekomendasi di bawah Search Bar -->
                @if(Auth::user()->role === 'admin')
                    <div class="hidden items-center gap-4 text-xs md:flex opacity-90">
                        <a href="#" class="hover:underline">Manajemen Stok</a>
                        <a href="#" class="hover:underline">Pesanan Masuk</a>
                        <a href="#" class="hover:underline">Laporan Penjualan</a>
                    </div>
                @else
                    <div class="hidden items-center gap-4 text-xs md:flex opacity-90">
                        <a href="#" class="hover:underline">Celana Pants</a>
                        <a href="#" class="hover:underline">Baju Korea Style</a>
                        <a href="#" class="hover:underline">Basreng 1 Kilo</a>
                        <a href="#" class="hover:underline">Baju Distro Pria</a>
                        <a href="#" class="hover:underline">Skincare Wajah</a>
                    </div>
                @endif
            </div>

            <!-- Icon Kanan (Troli vs Toko) -->
            <div class="flex items-center justify-end">
                @if(Auth::user()->role === 'admin')
                    <!-- Icon Toko Buat Admin -->
                    <a href="{{ route('admin.dashboard') }}" class="relative hover:opacity-80 transition" aria-label="Dashboard">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </a>
                @else
                    <!-- Icon Keranjang Buat Pembeli -->
                    <a href="{{ route('buyer.riwayat') }}" class="relative hover:opacity-80 transition" aria-label="Cart">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M3 3h2l2.5 12h10.5l2-8H7.3"></path>
                            <circle cx="10" cy="20" r="1.3"></circle>
                            <circle cx="18" cy="20" r="1.3"></circle>
                        </svg>
                    </a>
                @endif
            </div>
            
        </div>
    </div>
</nav>
