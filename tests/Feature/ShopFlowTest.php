<?php

use App\Models\OrderUpdate;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('api register login and logout flow works', function () {
    $registerResponse = $this->postJson('/api/register', [
        'name' => 'Api User',
        'email' => 'api-user@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $registerResponse
        ->assertCreated()
        ->assertJsonStructure(['message', 'user', 'token']);

    $loginResponse = $this->postJson('/api/login', [
        'email' => 'api-user@example.com',
        'password' => 'password123',
    ]);

    $loginResponse
        ->assertOk()
        ->assertJsonStructure(['message', 'user', 'token']);

    $token = $loginResponse->json('token');

    $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson('/api/logout')
        ->assertOk();
});

test('api products checkout and history use the transaction schema correctly', function () {
    $user = User::factory()->create();

    $product = Product::create([
        'nama_barang' => 'Produk Uji',
        'deskripsi' => 'Produk untuk test API',
        'harga' => 10000,
        'stok' => 10,
        'jenis_pembayaran' => 'COD',
    ]);

    Sanctum::actingAs($user);

    $this->getJson('/api/products')
        ->assertOk()
        ->assertJsonPath('products.0.id', $product->id);

    $checkoutResponse = $this->postJson('/api/checkout', [
        'product_id' => $product->id,
        'jumlah' => 2,
    ]);

    $checkoutResponse
        ->assertCreated()
        ->assertJsonPath('transaction.jumlah', 2)
        ->assertJsonPath('transaction.total_harga', 20000)
        ->assertJsonPath('transaction.status_pembayaran', 'Pending');

    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'jumlah' => 2,
        'total_harga' => 20000,
        'status_pembayaran' => 'Pending',
    ]);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stok' => 8,
    ]);

    $this->getJson('/api/history')
        ->assertOk()
        ->assertJsonPath('transactions.0.user_id', $user->id)
        ->assertJsonPath('transactions.0.product_id', $product->id);
});

test('transaction relationships are available for admin and buyer flows', function () {
    $user = User::factory()->create();

    $product = Product::create([
        'nama_barang' => 'Produk Relasi',
        'deskripsi' => 'Relasi data',
        'harga' => 30000,
        'stok' => 4,
        'jenis_pembayaran' => 'Transfer',
    ]);

    $transaction = Transaction::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'jumlah' => 1,
        'total_harga' => 30000,
        'status_pembayaran' => 'Pending',
    ]);

    OrderUpdate::create([
        'transaction_id' => $transaction->id,
        'status' => 'Proses',
    ]);

    $loadedTransaction = Transaction::with(['user', 'product', 'updates'])->findOrFail($transaction->id);

    expect($loadedTransaction->user->id)->toBe($user->id);
    expect($loadedTransaction->product->id)->toBe($product->id);
    expect($loadedTransaction->updates->count())->toBe(1);
});

test('database seeder creates the admin account', function () {
    $this->seed();

    $this->assertDatabaseHas('users', [
        'email' => 'admin@toko.com',
        'role' => 'admin',
    ]);
});

test('buyer checkout route creates transaction and reduces stock', function () {
    $user = User::factory()->create([
        'role' => 'pembeli',
    ]);

    $product = Product::create([
        'nama_barang' => 'Produk Checkout Web',
        'deskripsi' => 'Produk checkout web test',
        'harga' => 12000,
        'stok' => 7,
        'jenis_pembayaran' => 'COD',
    ]);

    $this->actingAs($user)
        ->post(route('buyer.checkout', $product->id), [
            'jumlah' => 2,
            'is_flash_sale' => 0,
        ])
        ->assertRedirect(route('buyer.riwayat'));

    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'jumlah' => 2,
        'total_harga' => 39000,
        'status_pembayaran' => 'Pending',
    ]);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stok' => 5,
    ]);
});

test('buyer can update profile fields from buyer profile form', function () {
    $user = User::factory()->create([
        'role' => 'pembeli',
    ]);

    $this->actingAs($user)
        ->put(route('buyer.profile.update'), [
            'name' => 'Buyer Updated',
            'alamat' => 'Jl. Melati No. 10',
            'no_hp' => '08123456789',
            'sosmed' => '@buyerupdated',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Buyer Updated',
        'alamat' => 'Jl. Melati No. 10',
        'no_hp' => '08123456789',
        'sosmed' => '@buyerupdated',
    ]);
});

test('buyer profile view file exists', function () {
    expect(file_exists(resource_path('views/buyer/profile.blade.php')))->toBeTrue();
});
