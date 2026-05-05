<x-app-layout>
    <div class="bg-[#f5f5f5] min-h-screen py-6 font-sans">
        <div class="max-w-[1200px] mx-auto px-4">
            
            <!-- Breadcrumb -->
            <div class="text-sm text-gray-500 mb-4 flex items-center gap-2">
                <a href="{{ route('buyer.katalog') }}" class="text-blue-600 hover:underline">Shopee</a>
                <span>&gt;</span>
                <span class="truncate">{{ $product->nama_barang }}</span>
            </div>

            <!-- Kartu Utama Produk -->
            <div class="bg-white rounded-sm shadow-sm p-6 grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                <!-- Kiri: Gambar -->
                <div class="aspect-square bg-gray-50 border border-gray-100 rounded-sm overflow-hidden flex items-center justify-center">
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400">Tidak ada gambar</span>
                    @endif
                </div>

                <!-- Kanan: Info Produk -->
                <div class="flex flex-col">
                    <h1 class="text-xl font-medium text-gray-800 mb-2">{{ $product->nama_barang }}</h1>
                    
                    <div class="bg-gray-50 px-5 py-4 mb-6">
                        <p class="text-3xl font-bold text-[#ee4d2d]">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>

                    <div class="space-y-4 text-sm text-gray-600 flex-grow">
                        <div class="flex items-center gap-4">
                            <span class="w-32 text-gray-500">Pengiriman</span>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                <span>Ongkos Kirim Rp15.000</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="w-32 text-gray-500">Pembayaran</span>
                            <span class="font-bold text-gray-800 border border-gray-300 px-2 py-1 rounded-sm">{{ $product->jenis_pembayaran }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="w-32 text-gray-500">Tersisa</span>
                            <span class="font-medium text-gray-800">{{ $product->stok }} buah</span>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex gap-4 mt-8">
                        <a href="{{ route('buyer.checkout.page', $product->id) }}" class="flex-1 bg-orange-50 border border-[#ee4d2d] text-[#ee4d2d] py-3 rounded-sm font-bold text-center hover:bg-orange-100 transition">
                            Masukkan Keranjang
                        </a>
                        <a href="{{ route('buyer.checkout.page', $product->id) }}" class="flex-1 bg-[#ee4d2d] text-white py-3 rounded-sm font-bold text-center hover:bg-[#d73211] transition">
                            Beli Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kartu Deskripsi -->
            <div class="bg-white rounded-sm shadow-sm p-6">
                <h3 class="bg-gray-50 px-4 py-3 font-bold text-gray-800 mb-4 rounded-sm">Spesifikasi & Deskripsi Produk</h3>
                <div class="px-4 whitespace-pre-wrap text-sm text-gray-700 leading-relaxed">{{ $product->deskripsi }}</div>
            </div>

        </div>
    </div>
</x-app-layout>