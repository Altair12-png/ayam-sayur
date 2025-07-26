<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkBukuKategori extends Model
{
    use HasFactory;


     // Menonaktifkan penggunaan timestamps
    public $timestamps = false;
    
    // Menentukan nama tabel
    protected $table = 'link_buku_kategori';

    // Menentukan kolom-kolom yang bisa diisi
    protected $fillable = [
        'buku_isbn',
        'kategori_id',
    ];

    // Relasi dengan model Buku (One-to-Many)
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_isbn', 'buku_isbn');
    }

    // Relasi dengan model Kategori (One-to-Many)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'KATEGORI_ID');
    }
}
