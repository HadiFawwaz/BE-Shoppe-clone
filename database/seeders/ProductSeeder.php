<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Fashion Pria
        Product::create([
            'nama_barang' => 'Kaos Distro Pria Oversize Katun Combed 30s',
            'harga' => 65000,
            'stok' => 150,
            'jenis_pembayaran' => 'COD & Transfer',
            'deskripsi' => 'Bahan katun combed 30s sangat adem dan menyerap keringat. Sablon plastisol anti pecah. Cocok untuk nongkrong.',
            'gambar' => 'products/foto1.jpeg', 
        ]);

        // 2. Sepatu
        Product::create([
            'nama_barang' => 'Sepatu Sneakers Pria Casual Premium',
            'harga' => 185000,
            'stok' => 80,
            'jenis_pembayaran' => 'Transfer',
            'deskripsi' => 'Sepatu sneakers dengan sol karet anti slip. Desain elegan dan cocok untuk sekolah, kuliah, atau jalan-jalan.',
            'gambar' => 'products/foto2.jpeg',
        ]);

        // 3. Aksesoris Komputer / Gaming
        Product::create([
            'nama_barang' => 'Mouse Gaming Wireless Sensor PAW3395',
            'harga' => 450000,
            'stok' => 30,
            'jenis_pembayaran' => 'Transfer',
            'deskripsi' => 'Mouse gaming super ringan dengan sensor PAW3395 kelas atas. Akurasi tinggi, polling rate 1000Hz, baterai awet hingga 80 jam pemakaian.',
            'gambar' => 'products/foto3.jpeg',
        ]);

        // 4. Keyboard
        Product::create([
            'nama_barang' => 'Keyboard Mechanical Custom 75% Layout',
            'harga' => 650000,
            'stok' => 25,
            'jenis_pembayaran' => 'Transfer',
            'deskripsi' => 'Keyboard mechanical layout 75% dengan knob volume. Hotswappable 5-pin, RGB per-key, dan sudah include peredam suara (foam) dari pabrik.',
            'gambar' => 'products/foto4.jpeg',
        ]);

        // 5. Tas Pria
        Product::create([
            'nama_barang' => 'Tas Ransel Laptop Kanvas Anti Air',
            'harga' => 125000,
            'stok' => 200,
            'jenis_pembayaran' => 'COD',
            'deskripsi' => 'Tas ransel berkapasitas besar, muat laptop hingga 15.6 inch. Bahan kanvas tebal dan sudah waterproof. Cocok untuk anak sekolah.',
            'gambar' => 'products/foto5.jpeg',
        ]);

        // 6. Makanan
        Product::create([
            'nama_barang' => 'Basreng Pedas Daun Jeruk 1 Kg (Ekstra Pedas)',
            'harga' => 45000,
            'stok' => 500,
            'jenis_pembayaran' => 'COD & Transfer',
            'deskripsi' => 'Baso goreng super renyah dengan bumbu pedas daun jeruk yang melimpah. Kemasan 1 kilogram puas untuk nyemil bareng teman.',
            'gambar' => 'products/foto6.jpeg',
        ]);

        // 7. Elektronik
        Product::create([
            'nama_barang' => 'Earphone TWS Bluetooth 5.3 Low Latency',
            'harga' => 110000,
            'stok' => 120,
            'jenis_pembayaran' => 'Transfer',
            'deskripsi' => 'TWS dengan koneksi Bluetooth 5.3 terbaru. Delay sangat minim, cocok untuk dengerin lagu atau main game. Suara bass nendang.',
            'gambar' => 'products/foto7.jpeg',
        ]);

        // 8. Pakaian Pria/Wanita
        Product::create([
            'nama_barang' => 'Jaket Hoodie Polos Bahan Fleece Tebal',
            'harga' => 95000,
            'stok' => 60,
            'jenis_pembayaran' => 'COD',
            'deskripsi' => 'Hoodie bahan fleece katun premium. Tebal tapi tidak bikin gerah. Tersedia dalam warna Hitam, Abu-abu, dan Navy.',
            'gambar' => 'products/foto8.jpeg',
        ]);

        // 9. Perlengkapan Rumah
        Product::create([
            'nama_barang' => 'Botol Minum Tumbler Stainless Steel 500ml',
            'harga' => 55000,
            'stok' => 90,
            'jenis_pembayaran' => 'COD & Transfer',
            'deskripsi' => 'Tumbler bahan stainless steel SUS 304 tahan karat. Mampu menahan suhu air panas atau dingin hingga 8 jam.',
            'gambar' => 'products/foto9.jpeg',
        ]);

        // 10. Fashion Pria
        Product::create([
            'nama_barang' => 'Kemeja Flanel Lengan Panjang Pria',
            'harga' => 85000,
            'stok' => 110,
            'jenis_pembayaran' => 'COD',
            'deskripsi' => 'Kemeja flanel bahan woll premium. Jahitan rapi, motif kotak-kotak klasik yang tidak pernah ketinggalan zaman.',
            'gambar' => 'products/foto10.jpeg',
        ]);
    }
}