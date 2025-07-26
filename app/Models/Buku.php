<?php

// app/Models/Buku.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'BUKU';
    protected $primaryKey = 'BUKU_ISBN';
    public $timestamps = false;
    public $incrementing = false; 

    // PERBAIKAN 1: Tambahkan KATEGORI_ID dan PENGARANG_ID ke $fillable
    protected $fillable = [
        'BUKU_ISBN', 
        'BUKU_JUDUL', 
        'PENERBIT_ID', 
        'KATEGORI_ID', 
        'PENGARANG_ID',
        'BUKU_TGLTERBIT',
        'BUKU_JMLHALAMAN', 
        'BUKU_DESKRIPSI', 
        'BUKU_HARGA', 
        'BUKU_SAMPUL'
    ];

    // Relasi dengan model Penerbit
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'PENERBIT_ID', 'PENERBIT_ID');
    }

    // PERBAIKAN 2: Ubah relasi kategori dari belongsToMany menjadi belongsTo
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'KATEGORI_ID', 'KATEGORI_ID');
    }
    
    // Relasi dengan model Pengarang
    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'PENGARANG_ID', 'PENGARANG_ID');
    }
}
