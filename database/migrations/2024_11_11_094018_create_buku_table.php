<?php

// database/migrations/2024_11_15_000004_create_buku_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    public function up()
    {
        Schema::create('BUKU', function (Blueprint $table) {
            $table->char('BUKU_ISBN', 13)->primary(); // Primary key
            $table->string('BUKU_JUDUL', 75);
            $table->char('PENERBIT_ID', 4);
            $table->date('BUKU_TGLTERBIT')->nullable();
            $table->integer('BUKU_JMLHALAMAN')->nullable();
            $table->text('BUKU_DESKRIPSI')->nullable();
            $table->decimal('BUKU_HARGA', 10, 2)->nullable();

            // Foreign key ke tabel PENERBIT
            $table->foreign('PENERBIT_ID')->references('PENERBIT_ID')->on('PENERBIT')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('BUKU');
    }
}
