<x-layoutadmin>
     <x-slot:title>Hai Admin</x-slot:title>

    <div class="container mx-auto mt-10 px-4">
        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Riwayat Pembelian Semua Pengguna</h2>
            <p class="text-gray-600 mt-2">Berikut adalah daftar pembelian yang telah dilakukan oleh semua pengguna.</p>
        </div>

        Tabel Riwayat Pembelian
        <div class="overflow-x-auto mt-6 bg-white shadow-lg rounded-lg border border-gray-200">
            <table class="min-w-full table-auto">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium text-left">No</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Nama Pembeli</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Judul Buku</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Jumlah Item</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Alamat</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Harga Satuan</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Total Harga</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Status Pesanan</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Aksi</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pembelianList as $index => $pembelian)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->NAMA_PEMBELI }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->BUKU_JUDUL }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->JUMLAH_ITEM }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->ALAMAT }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">Rp {{ number_format($pembelian->BUKU_HARGA, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">Rp {{ number_format($pembelian->TOTAL_HARGA, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                    @if($pembelian->status_pesanan == 'diproses') bg-yellow-200 text-yellow-800 
                                    @elseif($pembelian->status_pesanan == 'dikirim') bg-blue-600 text-white 
                                    @elseif($pembelian->status_pesanan == 'ditolak') bg-red-600 text-white 
                                    @elseif($pembelian->status_pesanan == 'sampai') bg-green-600 text-white 
                                    @else bg-gray-200 text-gray-800 
                                    @endif">
                                    {{ $pembelian->status_pesanan }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-sm text-gray-700">
                               <form action="{{ route('pembelian.updateStatus', $pembelian->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Ganti PATCH dengan PUT -->
                                    <select name="status_pesanan" class="py-1 px-3 border border-gray-300 rounded-md text-sm">
                                        <option value="diproses" {{ $pembelian->status_pesanan == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="dikirim" {{ $pembelian->status_pesanan == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="ditolak" {{ $pembelian->status_pesanan == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <button type="submit" class="mt-2 text-white bg-indigo-600 px-3 py-1 rounded-md">Update</button>
                                </form>
                            </td>
                             <!-- Kolom Bukti Pembayaran -->
                            <td class="py-3 px-6 text-sm text-gray-700">
                                @if($pembelian->BUKTI_PEMBAYARAN)
                                    <!-- Gambar yang Dapat Diklik -->
                                    <img src="{{ url('storage/' . $pembelian->BUKTI_PEMBAYARAN) }}" alt="Bukti Pembayaran" class="w-20 h-20 object-cover rounded-md cursor-pointer" onclick="openModal('{{ url('storage/' . $pembelian->BUKTI_PEMBAYARAN) }}')">
                                @else
                                    <span class="text-red-500">No image</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pesan jika tidak ada data pembelian -->
        @if($pembelianList->isEmpty())
            <div class="mt-4 p-4 bg-gray-100 text-center text-gray-600 rounded-lg shadow-md">
                Tidak ada riwayat pembelian.
            </div>
        @endif
      </div>

        <!-- Modal untuk Menampilkan Gambar Besar -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <span class="absolute top-4 right-4 text-white text-2xl cursor-pointer" onclick="closeModal()">×</span>
        <img id="modalImage" src="" alt="Bukti Pembayaran" class="max-w-full max-h-full">
    </div>

    <!-- Script untuk Modal -->
    <script>
        // Fungsi untuk membuka modal
        function openModal(imageUrl) {
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('modalImage').src = imageUrl;
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>

</x-layoutadmin>
<x-footer></x-footer>

