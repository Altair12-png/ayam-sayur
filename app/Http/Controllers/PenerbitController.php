<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    // Menampilkan daftar penerbit
    public function index()
    {
        $penerbits = Penerbit::all();
        return view('penerbit.index', compact('penerbits'));
    }

    // Menampilkan form untuk menambah penerbit
    public function create()
    {
        return view('penerbit.create');
    }

    // Menyimpan penerbit baru
    public function store(Request $request)
    {
        $request->validate([
            'PENERBIT_ID' => 'required|max:4',
            'PENERBIT_NAMA' => 'required|max:50',
        ]);

        Penerbit::create($request->all());

        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    // Menampilkan form untuk edit penerbit
    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('penerbit.edit', compact('penerbit'));
    }

    // Memperbarui penerbit
    public function update(Request $request, $id)
    {
        $request->validate([
            'PENERBIT_ID' => 'required|max:4',
            'PENERBIT_NAMA' => 'required|max:50',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->all());

        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diperbarui');
    }

    // Menghapus penerbit
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil dihapus');
    }
}

