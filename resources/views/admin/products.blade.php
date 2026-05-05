<x-app-layout>
    <div class="py-8 bg-[#f5f5f5] min-h-screen font-sans">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- HEADER -->
            <div class="flex items-center justify-between mb-2 border-b border-gray-200 pb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Produk</h2>
                    <p class="text-gray-500 text-sm mt-1">Kelola barang jualan Anda berdasarkan metode pembayaran.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="text-sm bg-white border border-gray-300 px-4 py-2 rounded-sm font-bold text-gray-600 hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-sm shadow-sm mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-green-700 font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <!-- ========================================== -->
            <!-- SECTION 1: KEDUANYA (COD & TRANSFER)       -->
            <!-- ========================================== -->
            <div class="bg-white rounded-sm shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="bg-purple-50 border-b border-purple-100 px-6 py-4 flex items-center gap-3">
                    <div class="bg-white p-1.5 rounded-sm shadow-sm">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-purple-800">Pembayaran: Keduanya (COD & Transfer)</h3>
                        <p class="text-xs text-purple-600">{{ $productsBoth->count() }} Produk Tersedia</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600 border-collapse">
                        <thead class="bg-white border-b border-gray-200 text-xs uppercase text-gray-500 font-bold">
                            <tr>
                                <th class="px-6 py-4">Nama Produk</th>
                                <th class="px-6 py-4 text-center">Harga</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($productsBoth as $item)
                            <tr class="hover:bg-purple-50/30 transition">
                                <td class="px-6 py-4 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-sm border border-gray-200 overflow-hidden flex-shrink-0">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <p class="font-bold text-gray-800">{{ $item->nama_barang }}</p>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-[#ee4d2d]">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center font-bold {{ $item->stok < 10 ? 'text-red-500' : 'text-gray-700' }}">{{ $item->stok }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.product.edit', $item->id) }}" class="bg-blue-50 text-blue-600 border border-blue-200 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-sm text-xs font-bold transition shadow-sm">EDIT</a>
                                        <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen produk ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 border border-red-200 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-sm text-xs font-bold transition shadow-sm">HAPUS</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada produk dengan metode COD & Transfer.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SECTION 2: PEMBAYARAN TRANSFER BANK        -->
            <!-- ========================================== -->
            <div class="bg-white rounded-sm shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="bg-blue-50 border-b border-blue-100 px-6 py-4 flex items-center gap-3">
                    <div class="bg-white p-1.5 rounded-sm shadow-sm">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-blue-800">Pembayaran: Transfer Bank Saja</h3>
                        <p class="text-xs text-blue-600">{{ $productsTransfer->count() }} Produk Tersedia</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600 border-collapse">
                        <thead class="bg-white border-b border-gray-200 text-xs uppercase text-gray-500 font-bold">
                            <tr>
                                <th class="px-6 py-4">Nama Produk</th>
                                <th class="px-6 py-4 text-center">Harga</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($productsTransfer as $item)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="px-6 py-4 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-sm border border-gray-200 overflow-hidden flex-shrink-0">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <p class="font-bold text-gray-800">{{ $item->nama_barang }}</p>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-[#ee4d2d]">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center font-bold {{ $item->stok < 10 ? 'text-red-500' : 'text-gray-700' }}">{{ $item->stok }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.product.edit', $item->id) }}" class="bg-blue-50 text-blue-600 border border-blue-200 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-sm text-xs font-bold transition shadow-sm">EDIT</a>
                                        <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen produk ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 border border-red-200 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-sm text-xs font-bold transition shadow-sm">HAPUS</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada produk dengan metode Transfer.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- SECTION 3: PEMBAYARAN BISA COD             -->
            <!-- ========================================== -->
            <div class="bg-white rounded-sm shadow-sm border border-gray-200 overflow-hidden mb-12">
                <div class="bg-green-50 border-b border-green-100 px-6 py-4 flex items-center gap-3">
                    <div class="bg-white p-1.5 rounded-sm shadow-sm">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-green-800">Pembayaran: Bisa COD</h3>
                        <p class="text-xs text-green-600">{{ $productsCOD->count() }} Produk Tersedia</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600 border-collapse">
                        <thead class="bg-white border-b border-gray-200 text-xs uppercase text-gray-500 font-bold">
                            <tr>
                                <th class="px-6 py-4">Nama Produk</th>
                                <th class="px-6 py-4 text-center">Harga</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($productsCOD as $item)
                            <tr class="hover:bg-green-50/30 transition">
                                <td class="px-6 py-4 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-sm border border-gray-200 overflow-hidden flex-shrink-0">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <p class="font-bold text-gray-800">{{ $item->nama_barang }}</p>
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-[#ee4d2d]">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center font-bold {{ $item->stok < 10 ? 'text-red-500' : 'text-gray-700' }}">{{ $item->stok }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.product.edit', $item->id) }}" class="bg-blue-50 text-blue-600 border border-blue-200 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-sm text-xs font-bold transition shadow-sm">EDIT</a>
                                        <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen produk ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 border border-red-200 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-sm text-xs font-bold transition shadow-sm">HAPUS</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada produk dengan metode COD.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>