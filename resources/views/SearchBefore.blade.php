<x-layoutbefore>
    <x-slot:title>LiterasiID</x-slot:title>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Pencarian Buku Berdasarkan Harga</h1>

        <form method="GET" action="{{ route('SearchBefore') }}" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="min_price" class="block text-sm font-medium text-gray-700">Harga Minimum:</label>
                <input type="number" name="min_price" id="min_price" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ request('min_price') }}" required>
            </div>

            <div class="mb-4">
                <label for="max_price" class="block text-sm font-medium text-gray-700">Harga Maksimum:</label>
                <input type="number" name="max_price" id="max_price" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ request('max_price') }}" required>
            </div>

            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Cari Buku
            </button>
        </form>

        {{-- PERBAIKAN: Menambahkan pengecekan apakah variabel $books ada sebelum digunakan --}}
        @if(isset($books) && !$books->isEmpty())
            <div class="mt-8">
                <ul class="space-y-4">
                    @foreach($books as $book)
                        {{-- PERBAIKAN: Membungkus setiap list item dengan tag <a> --}}
                        <a href="{{ route('buku.show', $book->BUKU_ISBN) }}" class="block p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200">
                            <li class="flex items-center space-x-6">
                                <div class="w-24 md:w-32 h-auto flex-shrink-0">
                                    {{-- PERBAIKAN: Menampilkan sampul dinamis --}}
                                    <img class="w-full h-full object-cover rounded-md" src="{{ $book->BUKU_SAMPUL ? asset('images/sampul_buku/' . $book->BUKU_SAMPUL) : '/images/buku.jpeg' }}" alt="Cover Buku">
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $book->BUKU_JUDUL }}</h3>
                                    {{-- PERBAIKAN: Menampilkan nama pengarang dan penerbit --}}
                                    <p class="text-sm text-gray-600 mt-1">Oleh: {{ $book->pengarang->PENGARANG_NAMA ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600 mt-1">Penerbit: {{ $book->penerbit->PENERBIT_NAMA ?? 'N/A' }}</p>
                                    <p class="text-lg font-semibold text-gray-900 mt-2">Rp {{ number_format($book->BUKU_HARGA, 2, ',', '.') }}</p>
                                </div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        @elseif(isset($books))
            <p class="mt-6 text-center text-gray-600">Tidak ada buku yang ditemukan dengan harga tersebut.</p>
        @endif

    </div>

</body>
<br><br>

</x-layoutbefore>
<x-footer></x-footer>
