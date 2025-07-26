<x-layout>
    <x-slot:title>LiterasiID</x-slot:title>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Pencarian Buku Berdasarkan Harga</h1>

        <form method="GET" action="{{ route('Search') }}" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="min_price" class="block text-sm font-medium text-gray-700">Harga Minimum:</label>
                <input type="number" name="min_price" id="min_price" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="max_price" class="block text-sm font-medium text-gray-700">Harga Maksimum:</label>
                <input type="number" name="max_price" id="max_price" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Cari Buku
            </button>
        </form>

        @if($books->isEmpty())
            <p class="mt-6 text-center text-gray-600">Tidak ada buku yang ditemukan dengan harga tersebut.</p>
        @else
    <div class="mt-6">
        <ul class="space-y-4">
            @foreach($books as $book)
                <li class="flex items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="w-32 h-48 bg-gray-200 rounded-lg overflow-hidden mr-6">
                        <img class="w-full h-full object-cover" src="{{ $book->BUKU_SAMPUL ? asset('images/sampul_buku/' . $book->BUKU_SAMPUL) : '/images/buku.jpeg' }}" alt="Cover Buku">
                    </div>

                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $book->BUKU_JUDUL }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Penerbit: {{ $book->PENERBIT_ID }}</p>
                        <p class="text-sm text-gray-600 mt-1">Harga: <span class="font-semibold">Rp {{ number_format($book->BUKU_HARGA, 2, ',', '.') }}</span></p>
                         <a href="{{ route('pembelian.tampil', [
                            'judul_buku' => urlencode($book->BUKU_JUDUL),
                            'isbn' => $book->BUKU_ISBN,
                            'harga' => $book->BUKU_HARGA
                        ]) }}" 
                           class="mt-4 w-20 bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                            Beli
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif

    </div>

</body>
<br><br>

</x-layout>

<x-footer></x-footer>