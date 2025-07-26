<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengarang', function (Blueprint $table) {
            $table->increments('PENGARANG_ID'); // Menggunakan increments
            $table->string('PENGARANG_NAMA', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengarang');
    }
};