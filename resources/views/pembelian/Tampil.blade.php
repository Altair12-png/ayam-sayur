<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<div class="container mx-auto mt-10 px-4">
    <div class="w-full max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8">
        <!-- Judul dengan Latar Belakang dan Garis Pemisah -->
        <h1 class="text-3xl font-semibold text-white py-4 px-6 bg-indigo-600 rounded-t-xl border-b-4 border-indigo-700 mb-6 text-center">
            Form Pemesanan Buku
        </h1>

        @php
            // Ambil data dari query parameters
            $judulBuku = request('judul_buku', '');
            $isbnBuku = request('isbn', '');
            $hargaBuku = request('harga', '');
        @endphp

        <form id="form-pembelian" action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Pembeli dan Nama User -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div class="col-span-1">
                    <label for="nama_pembeli" class="block text-sm font-medium text-indigo-600">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg py-3 px-6 transition-all">
                </div>

                <div class="col-span-1">
                    <label for="nama_user" class="block text-sm font-medium text-indigo-600">Nama User</label>
                    <input type="text" name="nama_user" id="nama_user" value="{{ auth()->user()->name }}" readonly
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-gray-500 py-3 px-6">
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="alamat" class="block text-sm font-medium text-indigo-600">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg py-3 px-6 transition-all"></textarea>
            </div>

            <!-- Judul Buku, ISBN, Harga Buku -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <div class="col-span-1">
                    <label for="buku_judul" class="block text-sm font-medium text-indigo-600">Judul Buku</label>
                    <input type="text" name="buku_judul" id="buku_judul" value="{{ $judulBuku }}" readonly
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg py-3 px-6 bg-gray-50">
                </div>

                <div class="col-span-1">
                    <label for="buku_isbn" class="block text-sm font-medium text-indigo-600">ISBN Buku</label>
                    <input type="text" name="buku_isbn" id="buku_isbn" value="{{ $isbnBuku }}" readonly
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg py-3 px-6 bg-gray-50">
                </div>

                <div class="col-span-1">
                    <label for="buku_harga" class="block text-sm font-medium text-indigo-600">Harga Buku</label>
                    <input type="text" name="buku_harga" id="buku_harga" value="{{ $hargaBuku }}" readonly
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg py-3 px-6 bg-gray-50">
                </div>
            </div>

            <!-- Jumlah Item, Total Harga -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div class="col-span-1">
                    <label for="jumlah_item" class="block text-sm font-medium text-indigo-600">Jumlah Item</label>
                    <input type="number" name="jumlah_item" id="jumlah_item" min="1" value="1" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg py-3 px-6 transition-all">
                </div>

                <div class="col-span-1">
                    <label for="total_harga" class="block text-sm font-medium text-indigo-600">Total Harga</label>
                    <input type="text" name="total_harga" id="total_harga" value="{{ $hargaBuku }}" readonly
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg py-3 px-6 bg-gray-50">
                </div>
            </div>

            <!-- Upload Bukti Pembayaran -->
              <div class="mb-6">
                <h3 class="block  font-medium text-indigo-600">Transfer ke : 1122-3344-5566-65 ( BRI )</h3>
                
            </div>

              <div class="mb-6">
                <h3 class="block  font-medium text-indigo-600">Bayar dengan : <a href="/qrCode" class = "block  font-medium text-teal-600 inline">QR Code</a></h3>
                
            </div>

            <div class="mb-6">
                <label for="bukti_pembayaran" class="block text-sm font-medium text-indigo-600">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 py-3 px-6">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                    Pesan Buku
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript untuk Menghitung Total Harga Otomatis -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahItemInput = document.getElementById('jumlah_item');
        const hargaBukuInput = document.getElementById('buku_harga');
        const totalHargaInput = document.getElementById('total_harga');
        
        // Fungsi untuk menghitung total harga
        function hitungTotalHarga() {
            const hargaBuku = parseFloat(hargaBukuInput.value.replace(/[^\d.-]/g, '')); // Mengambil harga buku
            const jumlahItem = parseInt(jumlahItemInput.value, 10); // Mengambil jumlah item
            const totalHarga = hargaBuku * jumlahItem; // Menghitung total harga
            totalHargaInput.value = totalHarga.toFixed(2); // Menampilkan total harga
        }

        // Event listener untuk mengubah total harga saat jumlah item berubah
        jumlahItemInput.addEventListener('input', hitungTotalHarga);

        // Panggil fungsi untuk pertama kali untuk memastikan total harga ditampilkan saat halaman dimuat
        hitungTotalHarga();
    });
</script>





</x-layout>
