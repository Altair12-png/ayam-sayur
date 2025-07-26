<?php

// app/Models/Kategori.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'KATEGORI'; // Nama tabel
    protected $primaryKey = 'KATEGORI_ID'; // Primary key
    public $timestamps = false; // Tidak menggunakan timestamp otomatis

    protected $fillable = [
        'KATEGORI_NAMA',
    ];

    // Relasi dengan model Buku (jika ada)
}

