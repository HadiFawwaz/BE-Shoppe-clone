<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\OrderUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    // Fungsi khusus buka Dashboard (Statistik & Form Tambah Produk)
    public function dashboard()
    {
        $total_produk = Product::count();
        $total_pesanan = Transaction::count();
        $pendapatan = Transaction::sum('total_harga');

        // Cukup kirim data statistik aja
        return view('admin.dashboard', compact('total_produk', 'total_pesanan', 'pendapatan'));
    }
    // Fungsi khusus buka Riwayat (Tabel Pesanan)


    public function storeProduct(Request $request)
    {

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'jenis_pembayaran' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|file|max:2048'
        ]);


        if ($request->file('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($validated);
        return back()->with('success', 'Barang berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, int $id)
    {
        OrderUpdate::create([
            'transaction_id' => $id,
            'status' => $request->status
        ]);
        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function riwayat()
    {

        $total_produk = Product::count();
        $total_pesanan = Transaction::count();
        $pendapatan = Transaction::sum('total_harga');

        $pesanan = Transaction::with(['product', 'user', 'updates'])->latest()->get();


        return view('admin.riwayat', compact('pesanan', 'total_produk', 'total_pesanan', 'pendapatan'));
    }

    public function editProduct(int $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function updateProduct(Request $request, int $id)
    {
        $product = Product::findOrFail($id);


        $product->nama_barang = $request->nama_barang;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->jenis_pembayaran = $request->jenis_pembayaran;
        $product->deskripsi = $request->deskripsi;


        if ($request->hasFile('gambar')) {


            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }


            $product->gambar = $request->file('gambar')->store('products', 'public');
        }

        // 3. Simpan permanen ke database
        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Data dan foto produk berhasil diubah!');
    }

    public function destroyProduct(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus dari etalase!');
    }
    public function productList()
    {

        $productsTransfer = Product::where('jenis_pembayaran', 'Transfer')->latest()->get();
        $productsCOD = Product::where('jenis_pembayaran', 'COD')->latest()->get();
        $productsBoth = Product::where('jenis_pembayaran', 'COD & Transfer')->latest()->get();


        return view('admin.products', compact('productsTransfer', 'productsCOD', 'productsBoth'));
    }
}
