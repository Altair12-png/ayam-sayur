<x-layout>
    <x-slot:title>LiterasiID</x-slot:title>

    <div class="container mx-auto mt-10 px-4">
        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Riwayat Pembelian Anda</h2>
            <p class="text-gray-600 mt-2">Berikut adalah daftar pembelian yang telah Anda lakukan.</p>
        </div>

        <!-- Tabel Riwayat Pembelian -->
        <div class="overflow-x-auto mt-6 bg-white shadow-lg rounded-lg border border-gray-200">
            <table class="min-w-full table-auto">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium text-left">No</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Judul Buku</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Jumlah Item</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Alamat</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Harga</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Total Harga</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Tanggal Pembelian</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Status Pesanan</th>
                        <th class="py-3 px-6 text-sm font-medium text-left">Konfirmasi</th>
                       
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pembelianList as $index => $pembelian)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->BUKU_JUDUL }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->JUMLAH_ITEM }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->ALAMAT}}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">Rp {{ number_format($pembelian->BUKU_HARGA, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">Rp {{ number_format($pembelian->TOTAL_HARGA, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->created_at->format('d-m-Y') }}</td>
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
                               <form action="{{ route('pembelian.updateStatusUser', $pembelian->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Ganti PATCH dengan PUT -->
                                    <button type="submit" name="status_pesanan" value="sampai" class="mt-2 text-white bg-indigo-600 px-3 py-1 rounded-md">
                                     Konfirmasi telah sampai
                                     </button>
                                    <!-- <button type="submit" class="mt-2 text-white bg-indigo-600 px-3 py-1 rounded-md">Konfirmasi</button> -->
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pesan jika tidak ada data pembelian -->
        @if($pembelianList->isEmpty())
            <div class="mt-4 p-4 bg-gray-100 text-center text-gray-600 rounded-lg shadow-md">
                Anda belum melakukan pembelian apapun.
            </div>
        @endif
    </div>

</x-layout>
<x-footer></x-footer>
