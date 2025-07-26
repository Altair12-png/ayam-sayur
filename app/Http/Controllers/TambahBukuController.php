<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Kategori;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TambahBukuController extends Controller
{
    /**
     * Menampilkan daftar buku.
     */
    public function index()
    {
        // PERBAIKAN: Gunakan with() untuk eager loading relasi
        // Ini akan mengambil data buku beserta relasinya secara efisien
        $bukus = Buku::with(['penerbit', 'kategori', 'pengarang'])->get();
        return view('buku.index', compact('bukus'));
    }

    /**
     * Menampilkan form untuk menambah buku.
     */
    public function create()
    {
        $penerbits = Penerbit::all();
        $kategoris = Kategori::all();
        $pengarangs = Pengarang::all();
        return view('buku.create', compact('penerbits', 'kategoris', 'pengarangs'));
    }

    /**
     * Menyimpan buku baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'BUKU_ISBN' => 'required|max:13',
            'BUKU_JUDUL' => 'required|max:75',
            'PENERBIT_ID' => 'required|exists:PENERBIT,PENERBIT_ID',
            'KATEGORI_ID' => 'required|exists:kategori,KATEGORI_ID',
            'PENGARANG_ID' => 'required|exists:pengarang,PENGARANG_ID',
            'BUKU_TGLTERBIT' => 'nullable|date',
            'BUKU_JMLHALAMAN' => 'nullable|integer',
            'BUKU_DESKRIPSI' => 'nullable|string',
            'BUKU_HARGA' => 'nullable|numeric',
            'BUKU_SAMPUL' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('BUKU_SAMPUL')) {
            $destinationPath = 'images/sampul_buku/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['BUKU_SAMPUL'] = "$profileImage";
        }

        Buku::create($input);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk edit buku.
     */
    public function edit($isbn)
    {
        $buku = Buku::findOrFail($isbn);
        $penerbits = Penerbit::all();
        $kategoris = Kategori::all();
        $pengarangs = Pengarang::all();
        return view('buku.edit', compact('buku', 'penerbits', 'kategoris', 'pengarangs'));
    }

    /**
     * Memperbarui buku.
     */
    public function update(Request $request, $isbn)
    {
        $request->validate([
            'BUKU_ISBN' => 'required|max:13',
            'BUKU_JUDUL' => 'required|max:75',
            'PENERBIT_ID' => 'required|exists:PENERBIT,PENERBIT_ID',
            'KATEGORI_ID' => 'required|exists:kategori,KATEGORI_ID',
            'PENGARANG_ID' => 'required|exists:pengarang,PENGARANG_ID',
            'BUKU_TGLTERBIT' => 'nullable|date',
            'BUKU_JMLHALAMAN' => 'nullable|integer',
            'BUKU_DESKRIPSI' => 'nullable|string',
            'BUKU_HARGA' => 'nullable|numeric',
            'BUKU_SAMPUL' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $buku = Buku::findOrFail($isbn);
        $input = $request->all();

        if ($image = $request->file('BUKU_SAMPUL')) {
            $destinationPath = 'images/sampul_buku/';
            // Hapus gambar lama jika ada
            if ($buku->BUKU_SAMPUL && File::exists($destinationPath . $buku->BUKU_SAMPUL)) {
                File::delete($destinationPath . $buku->BUKU_SAMPUL);
            }
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['BUKU_SAMPUL'] = "$profileImage";
        } else {
            unset($input['BUKU_SAMPUL']);
        }

        $buku->update($input);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Menghapus buku.
     */
    public function destroy($isbn)
    {
        $buku = Buku::findOrFail($isbn);

        // Hapus gambar dari storage
        $destinationPath = 'images/sampul_buku/';
        if ($buku->BUKU_SAMPUL && File::exists($destinationPath . $buku->BUKU_SAMPUL)) {
            File::delete($destinationPath . $buku->BUKU_SAMPUL);
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
