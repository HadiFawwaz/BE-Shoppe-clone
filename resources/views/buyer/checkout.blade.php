<x-app-layout>
    <!-- HEADER CHECKOUT -->
    <div class="bg-white py-6 shadow-sm border-b border-gray-200">
        <div class="max-w-[1000px] mx-auto px-4 flex items-center gap-4">
            <h1 class="text-2xl font-bold text-[#ee4d2d] border-r-2 border-gray-200 pr-4">Shopee</h1>
            <h2 class="text-xl text-gray-700">Checkout</h2>
        </div>
    </div>

    <div class="bg-[#f5f5f5] min-h-screen pb-32 font-sans pt-6 relative">
        <div class="max-w-[1000px] mx-auto px-4 space-y-4">
            
            <!-- 1. BLOK ALAMAT PENGIRIMAN -->
            <div class="bg-white rounded-sm shadow-sm relative overflow-hidden">
                <div class="h-1 w-full" style="background-image: repeating-linear-gradient(45deg,#6fa6d6,#6fa6d6 33px,transparent 0,transparent 41px,#f18d9b 0,#f18d9b 74px,transparent 0,transparent 82px);"></div>
                
                <div class="p-6">
                    <h2 class="text-lg font-bold text-[#ee4d2d] flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Alamat Pengiriman
                    </h2>
                    <div class="flex items-center gap-4 text-sm text-gray-700">
                        <p class="font-bold text-gray-800">{{ Auth::user()->name }} (+62) 812-3456-7890</p>
                        <p class="text-gray-600">Jl. Raya Tajur No. 123, Bogor Selatan, Kota Bogor, Jawa Barat, 16134</p>
                        <span class="border border-[#ee4d2d] text-[#ee4d2d] px-2 py-0.5 text-[10px] font-bold rounded-sm uppercase">Utama</span>
                    </div>
                </div>
            </div>

            <!-- FORM BUNGKUS SEMUA (Biar input jumlah kebawa ke Controller) -->
            <form action="{{ route('buyer.checkout', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="is_flash_sale" value="{{ $isFlashSale ? 1 : 0 }}">

                <!-- 2. BLOK PRODUK DIPESAN -->
                <div class="bg-white rounded-sm shadow-sm p-6 mb-4">
                    <div class="grid grid-cols-12 gap-4 text-sm text-gray-500 mb-4 border-b border-gray-100 pb-4">
                        <div class="col-span-6 font-bold text-gray-800 text-lg">Produk Dipesan</div>
                        <div class="col-span-2 text-center">Harga Satuan</div>
                        <div class="col-span-2 text-center">Jumlah</div>
                        <div class="col-span-2 text-right">Subtotal Produk</div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 items-center border-b border-dashed border-gray-200 pb-6">
                        <div class="col-span-6 flex gap-4">
                            <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : 'https://via.placeholder.com/150' }}" class="w-12 h-12 object-cover border border-gray-200 rounded-sm">
                            <div>
                                <p class="text-sm text-gray-800 font-medium">{{ $product->nama_barang }}</p>
                                <p class="text-xs text-gray-500 mt-1">Variasi: Default</p>
                                @if($isFlashSale)
                                    <span class="bg-[#ffe97a] text-[#f53d2d] text-[10px] px-2 py-0.5 mt-1 inline-block font-bold rounded-sm">Diskon Flash Sale 20%</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-2 text-center text-sm text-gray-700 flex flex-col items-center justify-center">
                            @if($isFlashSale)
                                <span class="text-xs text-gray-400 line-through">Rp{{ number_format($product->harga, 0, ',', '.') }}</span>
                            @endif
                            <span>Rp{{ number_format($hargaFinal, 0, ',', '.') }}</span>
                        </div>
                        
                        <!-- INPUT JUMLAH (PLUS MINUS) -->
                        <div class="col-span-2 text-center flex flex-col items-center">
                            <div class="flex items-center justify-center border border-gray-300 rounded-sm overflow-hidden w-max">
                                <button type="button" onclick="updateQty(-1)" class="w-8 h-8 flex items-center justify-center text-gray-600 bg-gray-50 hover:bg-gray-200 transition font-bold">-</button>
                                <input type="number" name="jumlah" id="qtyInput" value="1" min="1" max="{{ $product->stok }}" class="w-12 h-8 text-center border-x border-gray-300 border-y-0 p-0 text-sm focus:ring-0 appearance-none bg-white font-medium" readonly>
                                <button type="button" onclick="updateQty(1)" class="w-8 h-8 flex items-center justify-center text-gray-600 bg-gray-50 hover:bg-gray-200 transition font-bold">+</button>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1">Sisa: {{ $product->stok }}</p>
                        </div>

                        <!-- ID Buat JS -->
                        <div class="col-span-2 text-right text-sm font-bold text-gray-800" id="subtotalProdukTxt">
                            Rp{{ number_format($hargaFinal, 0, ',', '.') }}
                        </div>
                    </div>

                    <!-- Opsi Pengiriman -->
                    <div class="grid grid-cols-12 gap-4 items-center pt-6">
                        <div class="col-span-6"></div>
                        <div class="col-span-4 border-l border-gray-100 pl-6">
                            <p class="text-sm font-bold text-gray-800">Opsi Pengiriman:</p>
                            <p class="text-sm text-gray-600 mt-1">Reguler (Estimasi 2-3 Hari)</p>
                        </div>
                        <div class="col-span-2 text-right font-bold text-gray-800">Rp{{ number_format($ongkir, 0, ',', '.') }}</div>
                    </div>
                </div>

                <!-- 3. METODE PEMBAYARAN & RINCIAN -->
                <div class="bg-white rounded-sm shadow-sm p-6 border-t-4 border-gray-100">
                    <div class="flex items-center gap-6 border-b border-gray-100 pb-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Metode Pembayaran</h3>
                        <div class="flex gap-2">
                            <div class="flex flex-wrap gap-3">
                            @php
                                $opsiMetode = [];
                                if ($product->jenis_pembayaran == 'COD') $opsiMetode = ['COD (Bayar di Tempat)'];
                                elseif ($product->jenis_pembayaran == 'Transfer') $opsiMetode = ['Transfer Bank'];
                                else $opsiMetode = ['Transfer Bank', 'COD (Bayar di Tempat)'];
                            @endphp

                            @foreach($opsiMetode as $index => $opt)
                                <label class="cursor-pointer relative inline-block">
                                    <!-- Input Radio Disembunyiin -->
                                    <input type="radio" name="metode_pilihan" value="{{ $opt }}" class="peer sr-only" {{ $index == 0 ? 'checked' : '' }} required>
                                    
                                    <!-- Desain Kotak Tombol Ala Shopee -->
                                    <div class="px-5 py-2 text-sm font-medium border border-gray-300 rounded-sm text-gray-700 bg-white hover:bg-orange-50 peer-checked:border-[#ee4d2d] peer-checked:text-[#ee4d2d] transition duration-200">
                                        {{ $opt }}
                                    </div>
                                    
                                    <!-- Segitiga Checkmark di Pojok Kanan Bawah (Muncul Kalo Dipilih) -->
                                    <div class="absolute bottom-0 right-0 w-0 h-0 border-b-[16px] border-b-[#ee4d2d] border-l-[16px] border-l-transparent opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                                        <svg class="w-3 h-3 absolute right-0 bottom-[-16px] text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-3 text-sm text-gray-600 w-full">
                        <div class="flex justify-between w-[300px]">
                            <p>Subtotal untuk Produk</p>
                            <p id="rincianSubtotalTxt">Rp{{ number_format($hargaFinal, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between w-[300px]">
                            <p>Total Ongkos Kirim</p>
                            <p>Rp{{ number_format($ongkir, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between w-[300px] border-t border-dashed border-gray-200 pt-4 mt-2">
                            <p class="text-gray-800 font-medium">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-[#ee4d2d]" id="totalPembayaranTxt">Rp{{ number_format($hargaFinal + $ongkir, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- 4. BOTTOM BAR STICKY -->
                <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-[0_-4px_10px_rgba(0,0,0,0.05)] z-50">
                    <div class="max-w-[1000px] mx-auto px-4 py-4 flex justify-end items-center gap-6">
                        <div class="text-right flex items-center gap-4">
                            <p class="text-sm text-gray-600">Total Pembayaran:</p>
                            <p class="text-3xl font-bold text-[#ee4d2d]" id="stickyTotalTxt">Rp{{ number_format($hargaFinal + $ongkir, 0, ',', '.') }}</p>
                        </div>
                        <button type="submit" class="bg-[#ee4d2d] hover:bg-[#d73211] text-white px-12 py-3.5 rounded-sm font-bold text-sm transition">
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT BUAT AUTO HITUNG HARGA -->
    <script>
        const hargaSatuan = {{ $hargaFinal }};
        const ongkir = {{ $ongkir }};
        const maxStok = {{ $product->stok }};
        const qtyInput = document.getElementById('qtyInput');

        function updateQty(change) {
            let currentQty = parseInt(qtyInput.value);
            let newQty = currentQty + change;

            // Pastiin ga kurang dari 1 dan ga lebih dari stok toko
            if(newQty >= 1 && newQty <= maxStok) {
                qtyInput.value = newQty;
                hitungTotal(newQty);
            }
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function hitungTotal(qty) {
            let subtotal = hargaSatuan * qty;
            let totalAkhir = subtotal + ongkir;

            // Update semua teks harga di layar secara instan
            document.getElementById('subtotalProdukTxt').innerText = 'Rp' + formatRupiah(subtotal);
            document.getElementById('rincianSubtotalTxt').innerText = 'Rp' + formatRupiah(subtotal);
            document.getElementById('totalPembayaranTxt').innerText = 'Rp' + formatRupiah(totalAkhir);
            document.getElementById('stickyTotalTxt').innerText = 'Rp' + formatRupiah(totalAkhir);
        }
    </script>
</x-app-layout>