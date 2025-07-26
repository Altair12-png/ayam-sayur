<?php

// database/migrations/2024_11_15_000001_create_kategori_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    public function up()
    {
        Schema::create('KATEGORI', function (Blueprint $table) {
            $table->increments('KATEGORI_ID');
            $table->string('KATEGORI_NAMA', 25);
        });
    }

    public function down()
    {
        Schema::dropIfExists('KATEGORI');
    }
}


