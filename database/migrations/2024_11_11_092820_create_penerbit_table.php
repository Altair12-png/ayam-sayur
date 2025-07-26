<?php

// database/migrations/2024_11_15_000003_create_penerbit_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbitTable extends Migration
{
    public function up()
    {
        Schema::create('PENERBIT', function (Blueprint $table) {
            $table->char('PENERBIT_ID', 4)->primary();
            $table->string('PENERBIT_NAMA', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('PENERBIT');
    }
}

