<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkBukuKategoriTable extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_buku_kategori', function (Blueprint $table) {
            // Kolom buku_isbn
            $table->char('buku_isbn', 13);

            // Kolom kategori_id dengan unsigned
            $table->unsignedInteger('kategori_id');
            
            // Primary key gabungan
            $table->primary(['buku_isbn', 'kategori_id']);
            
            // Mendefinisikan foreign key
            $table->foreign('buku_isbn')
                ->references('buku_isbn')->on('buku')
                ->onDelete('cascade'); // Opsional, tergantung kebutuhan

            // Mendefinisikan foreign key
            $table->foreign('kategori_id')
                ->references('KATEGORI_ID')->on('KATEGORI')
                ->onDelete('cascade'); // Opsional, tergantung kebutuhan
        });
    }

    /**
     * Rollback migration untuk menghapus tabel.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_buku_kategori');
    }
}
