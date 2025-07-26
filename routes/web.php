<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarBukuController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuController2;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\TambahBukuController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LinkBukuKategoriController;


Route::get('/', [BukuController::class, 'index2']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/Home', [BukuController::class, 'index']);


Route::get('/Buku', [DaftarBukuController::class, 'index'])->name('buku.index');
Route::get('/BukuBefore', [DaftarBukuController::class, 'index2']);

Route::get('/Riwayat Pembelian', function () {
    return view('Riwayat_Pembelian', ['title' => 'Riwayat Pembelian']);
});

//  Pencarian Buku
Route::get('/Search', [DaftarBukuController::class, 'searchByPrice'])->name('Search');
Route::get('/SearchBefore', [DaftarBukuController::class, 'searchByPrice2'])->name('SearchBefore');

Route::get('/CariKategori', [BukuController::class, 'filterBuku'])->name('CariKategori');
Route::get('/CariKategoriBefore', [BukuController::class, 'filterBuku2'])->name('CariKategoriBefore');

// pencarian buku akhir

Route::middleware('auth')->group(function () {
    Route::get('/pembelian', [PembelianController::class, 'tampil'])->name('pembelian.tampil');
    Route::post('/pembelian/store', [PembelianController::class, 'store'])->name('pembelian.store');
    Route::get('/pembelian/history', [PembelianController::class, 'history'])->name('pembelian.history');
    Route::put('/pembelian/{id}/updateStatusUser', [PembelianController::class, 'updateStatusUser'])->name('pembelian.updateStatusUser');

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard3', [AdminController::class, 'index'])->name('dashboard3');
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard2', function () {
    return view('dashboard2');
});

Route::get('/qrCode', function () {
    return view('qrCode');
});



// Tampilan Halaman Untuk Admin

Route::get('/dashboard3', function () {
    return view('dashboard3');
});

Route::resource('kategori', KategoriController::class);

Route::resource('penerbit', PenerbitController::class);

Route::resource('pengarang', PengarangController::class);

Route::resource('buku', TambahBukuController::class);

Route::get('/HomeAdmin', [BukuController2::class, 'index']);

Route::get('/Buku', [DaftarBukuController::class, 'index'])->name('buku.index');
Route::get('/buku/{buku}', [DaftarBukuController::class, 'show'])->name('buku.show'); // TAMBAHKAN ROUTE INI

Route::get('/', [BukuController::class, 'index2']);
Route::get('/BukuBefore', [DaftarBukuController::class, 'index2']);
// Rute BARU untuk detail buku (HANYA UNTUK PENGGUNA TAMU)
Route::get('/detail-buku/{buku}', [DaftarBukuController::class, 'showBefore'])->name('buku.showBefore');

Route::get('/pembelian/historyAdmin', [PembelianController::class, 'historyAdmin'])->name('pembelian.historyAdmin');


Route::put('/pembelian/{id}/updateStatus', [PembelianController::class, 'updateStatus'])->name('pembelian.updateStatus');

Route::prefix('admin/link-buku-kategori')->group(function () {
    // Menampilkan daftar link buku kategori
    Route::get('/', [LinkBukuKategoriController::class, 'index'])->name('link_buku_kategori.index');

    // Menampilkan form untuk menambah link buku kategori
    Route::get('create', [LinkBukuKategoriController::class, 'create'])->name('link_buku_kategori.create');

    // Menyimpan link buku kategori baru
    Route::post('/', [LinkBukuKategoriController::class, 'store'])->name('link_buku_kategori.store');

    // Menampilkan form untuk edit link buku kategori
    Route::get('{buku_isbn}/{kategori_id}/edit', [LinkBukuKategoriController::class, 'edit'])->name('link_buku_kategori.edit');

    // Memperbarui link buku kategori
    Route::put('{buku_isbn}/{kategori_id}', [LinkBukuKategoriController::class, 'update'])->name('link_buku_kategori.update');

    // Menghapus link buku kategori
    Route::delete('{buku_isbn}/{kategori_id}', [LinkBukuKategoriController::class, 'destroy'])->name('link_buku_kategori.destroy');
    // ... (kode route lainnya)


// ... (kode route lainnya)
});








