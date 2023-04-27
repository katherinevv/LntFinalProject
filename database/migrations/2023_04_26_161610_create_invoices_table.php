<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_invoice')->unique();
            $table->string('kategori_barang');
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->integer('kuantitas');
            $table->string('alamat_pengiriman');
            $table->integer('kode_pos');
            $table->decimal('subtotal_harga', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
