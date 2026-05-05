<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // TAMPILIN SEMUA BARANG
    public function index()
    {
        $products = Product::latest()->get();

        return response()->json([
            'message' => 'Products retrieved successfully',
            'data' => $products, // Ubah jadi 'data' biar gampang ditangkep React Native
        ], 200);
    }

    // PROSES BELANJA
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['jumlah'];

        if ($product->stok < $quantity) {
            return response()->json([
                'message' => 'Stock is not enough for this checkout request.',
            ], 422);
        }

        $transaction = Transaction::create([
            'user_id' => $request->user()->id,
            'product_id' => $validated['product_id'],
            'jumlah' => $quantity,
            'total_harga' => $product->harga * $quantity,
            'status_pembayaran' => 'Pending',
        ]);

        $product->decrement('stok', $quantity);

        return response()->json([
            'message' => 'Checkout successful',
            'data' => $transaction,
        ], 201);
    }

    // RIWAYAT BELANJA
    public function history(Request $request)
    {
        // Wajib pakai with('product') biar detail barangnya ikut kebawa ke HP
        $transactions = Transaction::with(['updates', 'product'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Transaction history retrieved successfully',
            'data' => $transactions,
        ], 200);
    }

    // UPDATE PROFIL
    public function updateProfile(Request $request) 
    {
        $user = $request->user();
        
        $user->update([
            'name' => $request->name ?? $user->name,
            'alamat' => $request->alamat ?? $user->alamat, // Sekalian nangkep alamat
            'no_hp' => $request->no_hp ?? $user->no_hp,    // Sekalian nangkep no hp
        ]);

        return response()->json([
            'message' => 'Data Profil diperbarui!',
            'data' => $user
        ], 200);
    }
}