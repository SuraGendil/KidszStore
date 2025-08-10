<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul produk
            $table->string('category')->nullable();
            $table->string('image')->nullable();          // Path gambar (disesuaikan dengan model)
            $table->integer('stock')->default(0);         // Stok produk
            $table->integer('sold_count')->default(0);    // Jumlah terjual
            $table->decimal('price', 15, 2)->default(0);  // Harga produk
            $table->boolean('status')->default(true);     // true = tersedia
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
