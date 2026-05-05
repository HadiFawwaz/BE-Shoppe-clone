<x-app-layout>
    <div class="py-8 bg-[#f5f5f5] min-h-screen font-sans">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- NOTIFIKASI SUCCESS / ERROR -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-sm shadow-sm mb-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-green-700 font-medium text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- A. HEADER DASHBOARD -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard Admin</h2>
                    <p class="text-gray-500 text-sm mt-1">Ringkasan performa toko dan manajemen produk Anda.</p>
                </div>
            </div>

            <!-- B. KARTU STATISTIK (Desain Premium) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card 1: Total Produk (Sekarang bisa diklik ke halaman produk!) -->
                <a href="{{ route('admin.products') }}" class="bg-white p-6 rounded-sm border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-300 transition duration-300 group flex items-center gap-5 cursor-pointer relative overflow-hidden">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition duration-300 relative z-10">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Total Produk</p>
                        <h3 class="text-3xl font-black text-gray-800">{{ $total_produk }}</h3>
                        <p class="text-xs text-blue-500 mt-1 font-bold flex items-center gap-1">
                            Kelola Etalase <svg class="w-3 h-3 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </p>
                    </div>
                    <!-- Hiasan Background -->
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition duration-500"></div>
                </a>
                <!-- Card 2: Pesanan Masuk (Bisa Diklik) -->
                <a href="{{ route('admin.riwayat') }}" class="bg-white p-6 rounded-sm border border-gray-100 shadow-sm hover:shadow-md hover:border-green-300 transition duration-300 group flex items-center gap-5 cursor-pointer relative overflow-hidden">
                    <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition duration-300 relative z-10">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Pesanan Baru</p>
                        <h3 class="text-3xl font-black text-gray-800">{{ $total_pesanan }}</h3>
                        <p class="text-xs text-green-500 mt-1 font-bold flex items-center gap-1">
                            Cek Pesanan <svg class="w-3 h-3 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </p>
                    </div>
                    <!-- Hiasan Background -->
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition duration-500"></div>
                </a>

                <!-- Card 3: Total Pendapatan -->
                <div class="bg-white p-6 rounded-sm border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group flex items-center gap-5">
                    <div class="w-16 h-16 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-[#ee4d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Pendapatan</p>
                        <h3 class="text-2xl font-black text-gray-800">Rp{{ number_format($pendapatan, 0, ',', '.') }}</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Total penjualan selesai</p>
                    </div>
                </div>

            </div>

            <!-- C. FORM UPLOAD PRODUK BARU -->
            <div class="bg-white rounded-sm shadow-sm border border-gray-200 mt-8 overflow-hidden">
                
                <!-- Header Form -->
                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex items-center gap-3">
                    <div class="bg-white p-1.5 rounded-sm shadow-sm">
                        <svg class="w-5 h-5 text-[#ee4d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Upload Produk Baru</h3>
                        <p class="text-xs text-gray-500">Pastikan detail produk jelas agar pembeli tertarik.</p>
                    </div>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        @csrf
                        
                        <!-- Area Kiri: Input Teks (Ambil 2 Kolom) -->
                        <div class="lg:col-span-2 space-y-5">
                            
                            <!-- Nama Barang -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Barang <span class="text-[#ee4d2d]">*</span></label>
                                <input type="text" name="nama_barang" placeholder="Contoh: Sepatu Sneakers Pria Premium Original" 
                                       class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm transition" required>
                            </div>
                            
                            <!-- Harga & Stok -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Harga Satuan (Rp) <span class="text-[#ee4d2d]">*</span></label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-bold">Rp</span>
                                        <input type="number" name="harga" placeholder="0" 
                                               class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm pl-9 transition" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Stok Awal <span class="text-[#ee4d2d]">*</span></label>
                                    <input type="number" name="stok" placeholder="0" 
                                           class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm transition" required>
                                </div>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Metode Pembayaran <span class="text-[#ee4d2d]">*</span></label>
                                <select name="jenis_pembayaran" class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm text-gray-700 transition cursor-pointer" required>
    <option value="" disabled selected>-- Pilih Metode Pembayaran yang Diterima --</option>
    <option value="COD">Bisa COD (Bayar di Tempat)</option>
    <option value="Transfer">Transfer Bank Saja</option>
    <option value="COD & Transfer">Keduanya (Bisa COD & Transfer)</option>
</select>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi Lengkap <span class="text-[#ee4d2d]">*</span></label>
                                <textarea name="deskripsi" rows="5" placeholder="Tuliskan spesifikasi produk, bahan, ukuran, kebijakan garansi, dan detail lainnya..." 
                                          class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm transition resize-y" required></textarea>
                            </div>
                        </div>

                        <!-- Area Kanan: Upload Foto & Tombol Simpan (Ambil 1 Kolom) -->
                        <div class="flex flex-col gap-6">
                            
                            <!-- Box Upload Gambar -->
                            <div class="flex-grow">
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Foto Produk <span class="text-[#ee4d2d]">*</span></label>
                                <div class="relative border-2 border-dashed border-gray-300 rounded-sm bg-gray-50 hover:bg-orange-50 hover:border-[#ee4d2d] transition duration-300 flex flex-col items-center justify-center h-[260px] group overflow-hidden">
                                    
                                    <!-- TEMPAT PREVIEW FOTO (Awalnya disembunyiin) -->
                                    <img id="preview-img" src="" class="absolute inset-0 w-full h-full object-cover hidden z-10">

                                    <!-- TEKS & IKON UPLOAD (Bakal hilang kalo foto udah dipilih) -->
                                    <div id="upload-prompt" class="flex flex-col items-center justify-center p-6 text-center group-hover:scale-105 transition duration-300 relative z-0">
                                        <div class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 text-[#ee4d2d]">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <span class="text-sm text-gray-700 font-bold mb-1">Klik untuk upload foto</span>
                                        <span class="text-xs text-gray-500">Rasio foto 1:1 direkomendasikan.</span>
                                        <span class="text-[10px] text-gray-400 mt-2 bg-gray-200 px-2 py-1 rounded-sm">Format: JPG, PNG (Max 2MB)</span>
                                    </div>
                                    
                                    <!-- Input File Transparan (Dikasih onchange buat manggil fungsi JS) -->
                                    <input type="file" name="gambar" id="gambar-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*" required onchange="previewImage(event)">
                                </div>
                            </div>
                            <!-- Tombol Submit -->
                            <button type="submit" class="w-full bg-[#ee4d2d] hover:bg-[#d73211] text-white py-3.5 text-sm font-bold rounded-sm shadow-md transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                SIMPAN PRODUK
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MAGIC JAVASCRIPT BUAT PREVIEW FOTO -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const previewImg = document.getElementById('preview-img');
            const uploadPrompt = document.getElementById('upload-prompt');

            // Kalo admin beneran milih file
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                // Pas file selesai dibaca sama browser
                reader.onload = function(e) {
                    previewImg.src = e.target.result; // Masukin gambar ke tag img
                    previewImg.classList.remove('hidden'); // Munculin gambarnya
                    uploadPrompt.classList.add('hidden'); // Sembunyiin teks "Klik untuk upload"
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                // Kalo admin gajadi milih / nge-cancel
                previewImg.src = "";
                previewImg.classList.add('hidden');
                uploadPrompt.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>