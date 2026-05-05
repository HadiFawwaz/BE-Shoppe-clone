<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang'); 
            $table->text('deskripsi'); 
            $table->integer('harga'); 
            $table->integer('stok'); 
            $table->string('gambar')->nullable(); 
            $table->enum('jenis_pembayaran', ['COD', 'Transfer', 'COD & Transfer']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};