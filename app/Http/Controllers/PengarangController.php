<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    // Menampilkan daftar pengarang
    public function index()
    {
        $pengarangs = Pengarang::all();
        return view('pengarang.index', compact('pengarangs'));
    }

    // Menampilkan form untuk menambah pengarang
    public function create()
    {
        return view('pengarang.create');
    }

    // Menyimpan pengarang baru
    public function store(Request $request)
    {
        $request->validate([
            'PENGARANG_ID' => 'required|max:3',
            'PENGARANG_NAMA' => 'required|max:30',
        ]);

        Pengarang::create($request->all());

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan');
    }

    // Menampilkan form untuk edit pengarang
    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('pengarang.edit', compact('pengarang'));
    }

    // Memperbarui pengarang
    public function update(Request $request, $id)
    {
        $request->validate([
            'PENGARANG_ID' => 'required|max:3',
            'PENGARANG_NAMA' => 'required|max:30',
        ]);

        $pengarang = Pengarang::findOrFail($id);
        $pengarang->update($request->all());

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil diperbarui');
    }

    // Menghapus pengarang
    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->delete();

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus');
    }
}
