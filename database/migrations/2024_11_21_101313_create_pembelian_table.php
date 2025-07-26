<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_PENGGUNA');
            $table->string('NAMA_USER');
            $table->string('BUKU_JUDUL');
            $table->string('BUKU_ISBN');
            $table->decimal('BUKU_HARGA', 10, 2);
            $table->integer('JUMLAH_ITEM');
            $table->decimal('TOTAL_HARGA', 10, 2);
            $table->string('BUKTI_PEMBAYARAN');
            $table->string('NAMA_PEMBELI');
            $table->string('ALAMAT');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('ID_PENGGUNA')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
}
