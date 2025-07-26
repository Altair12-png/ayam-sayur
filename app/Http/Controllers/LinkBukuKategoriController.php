<?php

namespace App\Http\Controllers;

use App\Models\LinkBukuKategori;
use Illuminate\Http\Request;

class LinkBukuKategoriController extends Controller
{
    // Menampilkan daftar link buku kategori
    public function index()
    {
        $linkBukuKategoris = LinkBukuKategori::all();
        return view('link_buku_kategori.index', compact('linkBukuKategoris'));
    }

    // Menampilkan form untuk menambah link buku kategori
    public function create()
    {
        return view('link_buku_kategori.create');
    }

    // Menyimpan link buku kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'buku_isbn' => 'required|max:13',
            'kategori_id' => 'required|integer',
        ]);

        LinkBukuKategori::create($request->all());

        return redirect()->route('link_buku_kategori.index')->with('success', 'Link Buku Kategori berhasil ditambahkan');
    }

    // Menampilkan form untuk edit link buku kategori
    public function edit($buku_isbn, $kategori_id)
    {
        $linkBukuKategori = LinkBukuKategori::where('buku_isbn', $buku_isbn)
            ->where('kategori_id', $kategori_id)
            ->firstOrFail();
        return view('link_buku_kategori.edit', compact('linkBukuKategori'));
    }

    // Memperbarui link buku kategori
    public function update(Request $request, $buku_isbn, $kategori_id)
    {
        $request->validate([
            'buku_isbn' => 'required|max:13',
            'kategori_id' => 'required|integer',
        ]);

        $linkBukuKategori = LinkBukuKategori::where('buku_isbn', $buku_isbn)
            ->where('kategori_id', $kategori_id)
            ->firstOrFail();

        $linkBukuKategori->update($request->all());

        return redirect()->route('link_buku_kategori.index')->with('success', 'Link Buku Kategori berhasil diperbarui');
    }

    // Menghapus link buku kategori
    public function destroy($buku_isbn, $kategori_id)
    {
        $linkBukuKategori = LinkBukuKategori::where('buku_isbn', $buku_isbn)
            ->where('kategori_id', $kategori_id)
            ->firstOrFail();
        $linkBukuKategori->delete();

        return redirect()->route('link_buku_kategori.index')->with('success', 'Link Buku Kategori berhasil dihapus');
    }
}
