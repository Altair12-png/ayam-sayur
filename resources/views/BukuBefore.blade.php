<x-layoutBefore>
    <x-slot:title>LiterasiID</x-slot:title>

<div class="container mx-auto py-10">
    <div class="flex flex-wrap items-center justify-between mb-6">
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Daftar Buku</h2>
            <p class="text-gray-600 mt-1">Silakan login untuk dapat membeli buku.</p>
        </div>
        <div class="flex space-x-4 items-center p-4 rounded-lg">
            <div class="text-center">
                <p class="text-indigo-600 mb-2">Cari berdasarkan harga:</p>
                <a href="/SearchBefore" class="w-full bg-indigo-600 text-white py-2 px-5 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all block">
                    Cari
                </a>
            </div>
            <div class="text-center">
                <p class="text-indigo-600 mb-2">Cari berdasarkan kategori:</p>
                <a href="/CariKategoriBefore" class="w-full bg-indigo-600 text-white py-2 px-5 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all block">
                    Cari
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($bukuList as $buku)
            {{-- Tautan mengarah ke route 'buku.show' --}}
            <a href="{{ route('buku.showBefore', $buku->BUKU_ISBN) }}" class="block bg-white shadow rounded-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group">
                {{-- Menampilkan sampul buku secara dinamis --}}
                <img class="w-full h-64 object-cover" src="{{ $buku->BUKU_SAMPUL ? asset('images/sampul_buku/' . $buku->BUKU_SAMPUL) : '/images/buku.jpeg' }}" alt="Sampul buku {{ $buku->BUKU_JUDUL }}">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate group-hover:text-indigo-600" title="{{ $buku->BUKU_JUDUL }}">{{ $buku->BUKU_JUDUL }}</h3>
                    {{-- Menambahkan nama pengarang --}}
                    <p class="text-sm text-gray-600 mt-1">Oleh: {{ $buku->pengarang->PENGARANG_NAMA ?? 'N/A' }}</p>
                    <p class="text-gray-900 font-bold mt-2">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>

</x-layoutBefore>
<x-footer></x-footer>
