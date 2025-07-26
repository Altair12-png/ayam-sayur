<?php

// app/Http/Controllers/BukuController.php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pembelian;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // PERBAIKAN: Tambahkan ini untuk mengakses data user

class BukuController extends Controller
{
    public function index()
    {
        // Mengambil 5 buku terakhir berdasarkan BUKU_TGLTERBIT dalam urutan menurun
        // Memuat semua relasi yang dibutuhkan
        $books = Buku::with(['penerbit', 'kategori', 'pengarang'])->orderBy('BUKU_TGLTERBIT', 'desc')->take(5)->get();

        $title = 'LiterasiID';

        // Menghitung statistik
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        
        // PERBAIKAN: Menghitung total pembelian HANYA untuk user yang sedang login
        $totalPembelian = Pembelian::where('ID_PENGGUNA', Auth::id())->count();

        return view('Home', compact('books', 'totalBuku', 'totalKategori', 'totalPenerbit', 'title', 'totalPembelian'));
    }

    public function index2()
    {
        // Mengambil 5 buku terakhir berdasarkan BUKU_TGLTERBIT dalam urutan menurun
        // Memuat semua relasi yang dibutuhkan
        $books = Buku::with(['penerbit', 'kategori', 'pengarang'])->orderBy('BUKU_TGLTERBIT', 'desc')->take(5)->get();

        $title = 'LiterasiID';

        // Menghitung statistik
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $totalPembelian = Pembelian::count();

        return view('HomeBefore', compact('books', 'totalBuku', 'totalKategori', 'totalPenerbit', 'title', 'totalPembelian'));
    }

    public function filterBuku(Request $request)
    {
        $kategoris = Kategori::orderBy('KATEGORI_NAMA')->get();
        $kategoriId = $request->get('kat');
        $kategoriNama = 'Semua Kategori';
        
        // Memulai query dengan eager loading relasi yang benar
        $query = Buku::with(['penerbit', 'kategori', 'pengarang']);

        // Jika ada filter kategori, tambahkan kondisi where
        if ($kategoriId) {
            $query->where('KATEGORI_ID', $kategoriId);
            $kategoriTerpilih = Kategori::find($kategoriId);
            if ($kategoriTerpilih) {
                $kategoriNama = $kategoriTerpilih->KATEGORI_NAMA;
            }
        }

        $bukuByKategori = $query->get();

        // Mengelompokkan buku berdasarkan nama kategori dari relasi tunggal
        $groupedBuku = $bukuByKategori->groupBy(function($buku) {
            return $buku->kategori->KATEGORI_NAMA ?? 'Tanpa Kategori';
        });

        return view('CariKategori', compact('kategoris', 'groupedBuku', 'kategoriNama'));
    }

    public function filterBuku2(Request $request)
    {
        $kategoris = Kategori::orderBy('KATEGORI_NAMA')->get();
        $kategoriId = $request->get('kat');
        $kategoriNama = 'Semua Kategori';

        // Memulai query dengan eager loading relasi yang benar
        $query = Buku::with(['penerbit', 'kategori', 'pengarang']);

        // Jika ada filter kategori, tambahkan kondisi where
        if ($kategoriId) {
            $query->where('KATEGORI_ID', $kategoriId);
            $kategoriTerpilih = Kategori::find($kategoriId);
            if ($kategoriTerpilih) {
                $kategoriNama = $kategoriTerpilih->KATEGORI_NAMA;
            }
        }
        
        $bukuByKategori = $query->get();
        
        // Mengelompokkan buku berdasarkan nama kategori dari relasi tunggal
        $groupedBuku = $bukuByKategori->groupBy(function($buku) {
            return $buku->kategori->KATEGORI_NAMA ?? 'Tanpa Kategori';
        });

        return view('CariKategoriBefore', compact('kategoris', 'groupedBuku', 'kategoriNama'));
    }
}
