<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'PEMBELIAN';

    protected $fillable = [
        'ID_PENGGUNA',
        'NAMA_USER',
        'BUKU_JUDUL',
        'JUMLAH_ITEM',
        'BUKU_HARGA',
        'TOTAL_HARGA',
        'BUKU_ISBN',
        'BUKTI_PEMBAYARAN',
        'NAMA_PEMBELI',
        'ALAMAT',
        'status_pesanan',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_PENGGUNA', 'id');
    }

    // Relasi ke tabel BUKU
    public function book()
    {
        return $this->belongsTo(Buku::class, 'BUKU_ISBN', 'BUKU_ISBN');
    }
}

