<x-layoutBefore>
    <x-slot:title>LiterasiID</x-slot:title>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-center mb-6">Daftar Buku {{ $kategoriNama }}</h2>

    <!-- Form Filter Kategori -->
    <form method="GET" action="{{ route('CariKategoriBefore') }}" class="mb-6 flex justify-center">
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

    <!-- Daftar Buku Berdasarkan Kategori -->
    <div>
        @forelse($groupedBuku as $kategoriNamaGrup => $bukus)
            <h3 class="text-2xl font-semibold mt-6 mb-4">{{ $kategoriNamaGrup }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($bukus as $buku)
                    <a href="{{ route('buku.showBefore', $buku->BUKU_ISBN) }}" class="block bg-white shadow rounded-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group">
                        <img class="w-full h-64 object-cover" src="{{ $buku->BUKU_SAMPUL ? asset('images/sampul_buku/' . $buku->BUKU_SAMPUL) : '/images/buku.jpeg' }}" alt="Sampul {{ $buku->BUKU_JUDUL }}">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 truncate group-hover:text-indigo-600" title="{{ $buku->BUKU_JUDUL }}">{{ $buku->BUKU_JUDUL }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Oleh: {{ $buku->pengarang->PENGARANG_NAMA ?? 'N/A' }}</p>
                            <p class="text-gray-900 font-bold mt-2">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @empty
            <p class="mt-6 text-center text-gray-600">Tidak ada buku yang ditemukan dalam kategori ini.</p>
        @endforelse
    </div>
</div>

</body>
</html>
</x-layoutBefore>
<x-footer></x-footer>
