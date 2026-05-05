<x-app-layout>
    <div class="py-8 bg-[#f5f5f5] min-h-screen font-sans">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white rounded-sm shadow-sm border border-gray-200 overflow-hidden">
                
                <!-- HEADER FORM -->
                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-white p-1.5 rounded-sm shadow-sm">
                            <svg class="w-5 h-5 text-[#ee4d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Edit Data Produk</h3>
                            <p class="text-xs text-gray-500">Perbarui spesifikasi atau ganti foto barang jualan Anda.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="text-sm bg-white border border-gray-300 px-4 py-2 rounded-sm font-bold text-gray-600 hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal
                    </a>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        @csrf
                        @method('PUT') <!-- Wajib buat Update di Laravel -->
                        
                        <!-- AREA KIRI: Input Teks (2 Kolom) -->
                        <div class="lg:col-span-2 space-y-5">
                            
                            <!-- Nama Barang -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Barang <span class="text-[#ee4d2d]">*</span></label>
                                <input type="text" name="nama_barang" value="{{ $product->nama_barang }}" 
                                       class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm transition font-medium text-gray-800" required>
                            </div>
                            
                            <!-- Harga & Stok -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Harga Satuan (Rp) <span class="text-[#ee4d2d]">*</span></label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-bold">Rp</span>
                                        <input type="number" name="harga" value="{{ $product->harga }}" 
                                               class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm pl-9 transition font-medium text-gray-800" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Stok Saat Ini <span class="text-[#ee4d2d]">*</span></label>
                                    <input type="number" name="stok" value="{{ $product->stok }}" 
                                           class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm transition font-medium text-gray-800" required>
                                </div>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Metode Pembayaran <span class="text-[#ee4d2d]">*</span></label>
                                <select name="jenis_pembayaran" class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm text-gray-800 font-medium transition cursor-pointer" required>
                                    <option value="COD" {{ $product->jenis_pembayaran == 'COD' ? 'selected' : '' }}>Bisa COD (Bayar di Tempat)</option>
                                    <option value="Transfer" {{ $product->jenis_pembayaran == 'Transfer' ? 'selected' : '' }}>Transfer Bank Saja</option>
                                    <option value="COD & Transfer" {{ $product->jenis_pembayaran == 'COD & Transfer' ? 'selected' : '' }}>Keduanya (Bisa COD & Transfer)</option>
                                </select>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi Lengkap <span class="text-[#ee4d2d]">*</span></label>
                                <textarea name="deskripsi" rows="5" 
                                          class="w-full border-gray-300 bg-gray-50/50 focus:bg-white focus:border-[#ee4d2d] focus:ring-1 focus:ring-[#ee4d2d] rounded-sm shadow-sm text-sm transition resize-y font-medium text-gray-800" required>{{ $product->deskripsi }}</textarea>
                            </div>
                        </div>

                        <!-- AREA KANAN: Upload Foto & Tombol Simpan -->
                        <div class="flex flex-col gap-6">
                            
            
                            <!-- Box Upload Gambar -->
                            <div class="flex-grow">
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Foto Produk <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                
                                <!-- RAHASIANYA DI SINI: Tag <div> diganti jadi <label for="gambar-input"> -->
                                <label for="gambar-input" class="relative border-2 border-dashed border-gray-300 rounded-sm bg-gray-50 hover:border-[#ee4d2d] transition duration-300 flex flex-col items-center justify-center h-[260px] group overflow-hidden cursor-pointer w-full">
                                    
                                    <!-- FOTO SAAT INI (Tampil Penuh) -->
                                    <img id="preview-img" src="{{ asset('storage/' . $product->gambar) }}" class="absolute inset-0 w-full h-full object-cover z-10 group-hover:opacity-40 transition duration-300">
                                    
                                    <!-- EFEK HOVER (Muncul tulisan Ganti Foto pas kena mouse) -->
                                    <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 z-20 pointer-events-none">
                                        <div class="w-12 h-12 bg-white rounded-full shadow-md flex items-center justify-center mb-2 text-[#ee4d2d]">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <span class="text-xs text-gray-800 font-bold bg-white/90 px-3 py-1.5 rounded-sm shadow-sm">GANTI FOTO</span>
                                    </div>
                                    
                                    <!-- INPUT FILE ASLI (Beneran disembunyiin 'hidden' biar gak ribet z-index) -->
                                    <input type="file" name="gambar" id="gambar-input" class="hidden" accept="image/*" onchange="previewImage(event)">
                                </label>

                                <p class="text-[10px] text-gray-400 mt-2 leading-tight">*Biarkan jika tidak ingin mengubah foto. Format yang didukung: JPG, PNG (Max 2MB).</p>
                            </div>

                            <!-- Tombol Submit Pindah ke Kanan Bawah -->
                            <button type="submit" class="w-full bg-[#ee4d2d] hover:bg-[#d73211] text-white py-3.5 text-sm font-bold rounded-sm shadow-md transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                SIMPAN PERUBAHAN
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>


    <script>
        function previewImage(event) {
            const input = event.target;
            const previewImg = document.getElementById('preview-img');


            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {

                    previewImg.src = e.target.result; 
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>