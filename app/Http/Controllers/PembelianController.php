<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Buku;

    
    class PembelianNode
        {
            public $pembelian;
            public $next;

            public function __construct($pembelian)
            {
                $this->pembelian = $pembelian;
                $this->next = null;
            }
        }

class PembelianController extends Controller
{
    private $head = null; // Linked list mulai dari sini

    
    /**
     * Tampilkan form untuk memesan buku.
     */
    public function tampil()
    {
        $title = 'Checkout';
        return view('Pembelian.Tampil', compact('title'));
    }

    /**
     * Proses dan simpan data form ke tabel pembelian.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'buku_judul' => 'required|string|max:75',
            'buku_isbn' => 'required|string|max:13',
            'buku_harga' => 'required|numeric',
            'jumlah_item' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Hitung total harga
        $totalHarga = $validated['buku_harga'] * $validated['jumlah_item'];

        try {
            // Simpan data ke tabel PEMBELIAN
            $pembelian = Pembelian::create([
                'ID_PENGGUNA' => auth()->id(), // ID pengguna yang sedang login
                'NAMA_USER' => auth()->user()->name, // Nama pengguna yang sedang login
                'BUKU_JUDUL' => $validated['buku_judul'],
                'BUKU_ISBN' => $validated['buku_isbn'],
                'BUKU_HARGA' => $validated['buku_harga'],
                'JUMLAH_ITEM' => $validated['jumlah_item'],
                'TOTAL_HARGA' => $totalHarga,
                'BUKTI_PEMBAYARAN' => $path,
                'NAMA_PEMBELI' => $validated['nama_pembeli'],
                'ALAMAT' => $validated['alamat'],
            ]);

            // Buat node baru untuk pembelian ini
            $node = new PembelianNode($pembelian);

            // Tambahkan node ke dalam linked list
            if ($this->head === null) {
                $this->head = $node;
            } else {
                $current = $this->head;
                while ($current->next !== null) {
                    $current = $current->next;
                }
                $current->next = $node;
            }

            session()->flash('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->withErrors('Error saving data: ' . $e->getMessage());
        }

        return redirect()->intended('dashboard2');
    }

    /**
     * Menampilkan data pembelian berdasarkan user_id menggunakan linked list.
     */
    public function historyAdmin()
    {
        // Ambil semua data pembelian dan urutkan berdasarkan total harga
    $pembelianList = Pembelian::orderBy('created_at', 'desc')->get(); // Mengambil semua data tanpa filter berdasarkan ID_PENGGUNA

    // Menampilkan data pembelian ke view
    return view('pembelian.historyAdmin', compact('pembelianList'));

    }

     public function history()
    {
        // Ambil data pembelian berdasarkan user_id dan urutkan berdasarkan total harga
        $pembelianList = Pembelian::where('ID_PENGGUNA', auth()->id())  // Mengambil data berdasarkan user_id yang sedang login
                                  ->orderBy('created_at', 'desc')  // Mengurutkan berdasarkan waktu pemesanan
                                  ->get();  // Mengambil data sebagai Collection

        // Mengecek apakah Collection kosong menggunakan isEmpty()
        // if ($pembelianList->isEmpty()) {
        //     // Jika kosong, beri notifikasi atau redirect sesuai kebutuhan
        //     return redirect()->route('pembelian.history')->with('error', 'Tidak ada pembelian');
        // }

        // Menampilkan data pembelian ke view
        return view('pembelian.history', compact('pembelianList'));

    }


    // Menambahkan metode untuk mengubah status pesanan
public function updateStatus(Request $request, $id)
{
    // Validasi status yang diterima, memastikan status pesanan hanya bisa diubah ke salah satu dari 'diproses', 'dikirim', atau 'sampai'
    $validated = $request->validate([
        'status_pesanan' => 'required|in:diproses,dikirim,ditolak',
    ]);

    try {
        // Mencari pembelian berdasarkan ID
        $pembelian = Pembelian::findOrFail($id);

        // Mengecek apakah status yang akan diupdate sudah sama dengan yang ada, untuk menghindari update yang tidak perlu
        if ($pembelian->status_pesanan == $validated['status_pesanan']) {
            return back()->with('info', 'Status pesanan sudah dalam keadaan tersebut.');
        }

        // Mengupdate status pesanan
        $pembelian->status_pesanan = $validated['status_pesanan'];
        $pembelian->save();

        // Menambahkan pesan sukses setelah update
        session()->flash('success', 'Status pesanan berhasil diperbarui!');

    } catch (\Exception $e) {
        // Menangani error jika terjadi kesalahan saat penyimpanan
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }

    // Mengarahkan ulang ke halaman history pembelian admin
    return redirect()->route('pembelian.historyAdmin');
}

public function updateStatusUser(Request $request, $id)
{
    // Validasi status yang diterima, memastikan status pesanan hanya bisa diubah ke salah satu dari 'diproses', 'dikirim', atau 'sampai'
    $validated = $request->validate([
        'status_pesanan' => 'required|in:sampai',
    ]);

    try {
        // Mencari pembelian berdasarkan ID
        $pembelian = Pembelian::findOrFail($id);

        // Mengecek apakah status yang akan diupdate sudah sama dengan yang ada, untuk menghindari update yang tidak perlu
        if ($pembelian->status_pesanan == $validated['status_pesanan']) {
            return back()->with('info', 'Status pesanan sudah dalam keadaan tersebut.');
        }

        // Mengupdate status pesanan
        $pembelian->status_pesanan = $validated['status_pesanan'];
        $pembelian->save();

        // Menambahkan pesan sukses setelah update
        session()->flash('success', 'Status pesanan berhasil diperbarui!');

    } catch (\Exception $e) {
        // Menangani error jika terjadi kesalahan saat penyimpanan
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }

    // Mengarahkan ulang ke halaman history pembelian admin
    return redirect()->route('pembelian.history');
}


}


