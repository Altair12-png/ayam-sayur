<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            // Pastikan tipe data cocok dengan primary key di tabel referensi
            // `increments` di tabel kategori/pengarang menghasilkan `unsigned int`.

            $table->unsignedInteger('KATEGORI_ID')->nullable()->after('PENERBIT_ID');
            $table->foreign('KATEGORI_ID')
                  ->references('KATEGORI_ID')->on('kategori')
                  ->onDelete('set null');

            $table->unsignedInteger('PENGARANG_ID')->nullable()->after('KATEGORI_ID');
            $table->foreign('PENGARANG_ID')
                  ->references('PENGARANG_ID')->on('pengarang')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['KATEGORI_ID']);
            $table->dropColumn('KATEGORI_ID');

            $table->dropForeign(['PENGARANG_ID']);
            $table->dropColumn('PENGARANG_ID');
        });
    }
};