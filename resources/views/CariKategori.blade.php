<x-layout>
    <x-slot:title>LiterasiID</x-slot:title>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-center mb-6">Daftar Buku {{ $kategoriNama }}</h2>

    <form method="GET" action="{{ route('CariKategori') }}" class="mb-6 flex justify-center">
        <div class="flex items-center space-x-4">
            <label for="kategori_id" class="text-lg">Pilih Kategori:</label>
            <select name="kat" id="kategori_id" class="border border-gray-300 rounded-md p-2">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->KATEGORI_ID }}" 
                        {{ request ('kat') == $kategori->KATEGORI_ID ? 'selected' : '' }}>
                        {{ $kategori->KATEGORI_NAMA }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Filter</button>
        </div>
    </form>

    <div>
        @foreach($groupedBuku as $kategoriNama => $bukus)
            <h3 class="text-2xl font-semibold mt-6 mb-4">{{ $kategoriNama }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($bukus as $buku)
                 <li class="flex items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="w-32 h-48 bg-gray-200 rounded-lg overflow-hidden mr-6">
                        <img class="w-full h-full object-cover" src="{{ $buku->BUKU_SAMPUL ? asset('images/sampul_buku/' . $buku->BUKU_SAMPUL) : '/images/buku.jpeg' }}" alt="Cover Buku">
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-gray-700">{{ $buku->BUKU_JUDUL }}</h3>
                        <p class="text-gray-500">ISBN: {{ $buku->BUKU_ISBN }}</p>
                        <p class="text-gray-500">Penerbit: {{ $buku->penerbit->PENERBIT_NAMA }}</p>
                        <p class="text-gray-700">Harga: Rp {{ number_format($buku->BUKU_HARGA, 0, "", ".") }},-</p>
                        <a href="{{ route('pembelian.tampil', [
                            'judul_buku' => urlencode($buku->BUKU_JUDUL),
                            'isbn' => $buku->BUKU_ISBN,
                            'harga' => $buku->BUKU_HARGA
                        ]) }}" 
                           class="mt-4 w-20 bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                            Beli
                        </a>
                    </div>
                    </li>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
</x-layout>