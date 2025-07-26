<?php

// app/Models/Penerbit.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    protected $table = 'PENERBIT'; // Nama tabel
    protected $primaryKey = 'PENERBIT_ID'; // Primary key
    public $timestamps = false; // Tidak menggunakan timestamp otomatis
    public $incrementing = false;  
    protected $fillable = [
        'PENERBIT_ID',
        'PENERBIT_NAMA',
       
    ];

    // Relasi dengan model Buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'PENERBIT_ID', 'PENERBIT_ID');
    }
}

