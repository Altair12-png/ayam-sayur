<?php

// app/Models/Pengarang.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;

    protected $table = 'PENGARANG'; // Nama tabel
    protected $primaryKey = 'PENGARANG_ID'; // Primary key
    public $timestamps = false; // Tidak menggunakan timestamp otomatis
    public $incrementing = false;
    protected $fillable = [
        'PENGARANG_ID',
        'PENGARANG_NAMA',
    ];

    // Relasi dengan model Buku (jika ada)
}


