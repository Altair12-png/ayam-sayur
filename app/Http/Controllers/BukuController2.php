<?php

// app/Http/Controllers/BukuController.php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pembelian;
use App\Models\Pengarang;
use App\Models\User;
use Illuminate\Http\Request;

class BukuController2 extends Controller
{
    public function index()
    {
        // Mengambil 5 buku terakhir berdasarkan BUKU_TGLTERBIT dalam urutan menurun
        $books = Buku::with('Penerbit')->orderBy('BUKU_TGLTERBIT', 'desc')->take(5)->get();


        $title = 'Pustaka Bit';

        // Menghitung statistik
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $totalPembelian = Pembelian::count();
        $totalPengarang = Pengarang::count();
        $totalUser =  User::count();
        return view('HomeAdmin', compact('books', 'totalBuku', 'totalKategori', 'totalPenerbit', 'title', 'totalPembelian','totalPengarang','totalUser'));
         $bukus = Buku::all();
        
    }
}


