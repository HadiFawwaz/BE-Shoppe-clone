<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function katalog()
    {
        // Ambil produk yang stoknya masih ada aja buat dipajang
        $products = Product::where('stok', '>', 0)->get();
        return view('buyer.katalog', compact('products'));
    }

    // FUNGSI INI BUAT NYIMPEN PESANAN KE DATABASE (POST)
    public function checkout(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'jumlah' => 'nullable|integer|min:1',
            'is_flash_sale' => 'nullable|in:0,1',
        ]);

        $isFlashSale = ($validated['is_flash_sale'] ?? 0) == 1;
        $hargaBarang = $isFlashSale ? ($product->harga * 0.8) : $product->harga;
        $ongkir = 15000;
        $jumlahBeli = (int) ($validated['jumlah'] ?? 1);

        if ($product->stok < $jumlahBeli) {
            return back()->with('error', 'Stok tidak mencukupi untuk jumlah yang dipilih.');
        }

        // TOTAL HARGA FINAL otomatis dikali jumlah beli yang baru
        $totalHargaFinal = ($hargaBarang * $jumlahBeli) + $ongkir;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'jumlah' => $jumlahBeli, // <-- Masuk ke database
            'total_harga' => $totalHargaFinal, // <-- Totalnya ikutan bener
            'status_pembayaran' => 'Pending',
        ]);

        $transaction->updates()->create([
            'status' => 'Proses'
        ]);

        $product->decrement('stok', $jumlahBeli);

        return redirect()->route('buyer.riwayat')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function riwayat()
    {
        // Ambil riwayat belanja user yang lagi login
        $history = Transaction::with(['product', 'updates'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('buyer.riwayat', compact('history'));
    }
    public function checkoutPage(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        // Ongkir statis
        $ongkir = 15000;

        // 1. Cek apakah di URL ada tanda "is_flash_sale=1"
        $isFlashSale = $request->query('is_flash_sale') == 1;

        // 2. Hitung Harga Final: Kalau Flash Sale dipotong 20%, kalau nggak ya harga normal
        $hargaFinal = $isFlashSale ? ($product->harga * 0.8) : $product->harga;

        // 3. Lempar datanya ke halaman checkout
        return view('buyer.checkout', compact('product', 'ongkir', 'isFlashSale', 'hargaFinal'));
    }
    // Fungsi untuk nampilin Detail Produk
    public function show(int $id)
    {
        $product = Product::findOrFail($id);
        return view('buyer.detail', compact('product'));
    }

    // Fungsi untuk nampilin form Profil
    public function profile()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('buyer.profile', compact('user'));
    }

    // Fungsi untuk nyimpen update Profil
    public function updateProfile(\Illuminate\Http\Request $request)
    {

        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $user->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'sosmed' => $request->sosmed,
        ]);

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    }
}
