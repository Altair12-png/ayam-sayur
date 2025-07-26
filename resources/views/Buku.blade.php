<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto py-10">
        <div class="inline-flex space-x-4 items-center border border-gray-300 p-4 rounded-lg shadow-md mb-6">
            <div class="mb-2">
                <p class="text-indigo-600 mt-1">Cari buku berdasarkan harga:</p>
                <a href="/Search" class="mt-4 mb-6 w-auto bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                    <h2>Cari</h2>
                </a>
            </div>

            <div class="mb-2">
                <p class="text-indigo-600 mt-1">Cari buku berdasarkan kategori:</p>
                <a href="/CariKategori" class="mt-4 mb-6 w-auto bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                    <h2>Cari</h2>
                </a>
            </div>
        </div>

    <div class="mb-6 mr-10">
            <h2 class="text-3xl font-bold text-gray-800">Daftar Buku</h2>
            <p class="text-gray-600 mt-1">Pilih buku yang ingin Anda beli.</p>
           
        </div>

    


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($bukuList as $buku)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ $buku->BUKU_SAMPUL ? asset('images/sampul_buku/' . $buku->BUKU_SAMPUL) : '/images/buku.jpeg' }}" alt="Cover Buku">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $buku->BUKU_JUDUL }}</h3>
                        <p class="text-gray-600 mt-1">Penerbit: {{ $buku->penerbit->PENERBIT_NAMA ?? 'Tidak Ada' }}</p>
                        <p class="text-gray-900 font-bold mt-2">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</p>
                        <p class="text-gray-500 text-sm">Jumlah Halaman: {{ $buku->BUKU_JMLHALAMAN }}</p>
                        <a href="{{ route('buku.show', $buku->BUKU_ISBN) }}" 
   class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 text-center block">
    Lihat Detail
</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
<x-footer></x-footer>