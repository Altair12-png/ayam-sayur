<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth; // Pastikan baris ini ada

class DaftarBukuController extends Controller
{
    public function index()
    {
        // Memuat relasi untuk ditampilkan di view
        $bukuList = Buku::with(['penerbit', 'kategori', 'pengarang'])->get();
        $title = 'LiterasiID'; // Diubah sesuai permintaan

        return view('Buku', compact('bukuList', 'title'));
    }

    public function index2()
    {
        // Memuat relasi untuk ditampilkan di view
        $bukuList = Buku::with(['penerbit', 'kategori', 'pengarang'])->get();
        $title = 'LiterasiID'; // Diubah sesuai permintaan

        return view('BukuBefore', compact('bukuList', 'title'));
    }

    /**
     * Menampilkan halaman detail buku dengan logika untuk user login dan tamu.
     */
    public function show(Buku $buku)
    {
        // Memuat relasi agar data tersedia
        $buku->load(['penerbit', 'kategori', 'pengarang']);
        $title = $buku->BUKU_JUDUL;

        // Cek apakah pengguna sudah login atau belum
        if (Auth::check()) {
            // Jika sudah login, tampilkan view detail dengan tombol "Beli"
            return view('buku.show', compact('buku', 'title'));
        }
        
        // Jika belum login, tampilkan view detail dengan tombol "Login untuk Membeli"
        return view('buku.showBefore', compact('buku', 'title'));
    }

     public function showBefore(Buku $buku)
    {
        $buku->load(['penerbit', 'kategori', 'pengarang']);
        $title = $buku->BUKU_JUDUL;
        return view('buku.showBefore', compact('buku', 'title'));
    }

    public function searchByPrice(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $books = Buku::with(['penerbit', 'kategori', 'pengarang'])
                     ->whereBetween('BUKU_HARGA', [$minPrice, $maxPrice])->get();
        
        $sortedBooks = $this->quickSort($books->all());
        $books = collect($sortedBooks);
        
        return view('Search', compact('books'));
    }

    public function searchByPrice2(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $books = Buku::with(['penerbit', 'kategori', 'pengarang'])
                     ->whereBetween('BUKU_HARGA', [$minPrice, $maxPrice])->get();

        $sortedBooks = $this->quickSort($books->all());
        $books = collect($sortedBooks);

        return view('SearchBefore', compact('books'));
    }

    private function quickSort(array $arr): array
    {
        if (count($arr) < 2) {
            return $arr;
        }

        $left = $right = [];
        $pivot_key = key($arr);
        $pivot = array_shift($arr);

        foreach ($arr as $val) {
            if ($val->BUKU_HARGA < $pivot->BUKU_HARGA) {
                $left[] = $val;
            } else {
                $right[] = $val;
            }
        }

        return array_merge($this->quickSort($left), array($pivot_key => $pivot), $this->quickSort($right));
    }
}
