<x-layoutadmin>
     <x-slot:title>Hai Admin</x-slot:title>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Buku</h1>
        <a href="{{ route('buku.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Tambah Buku</a>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto bg-white rounded-md shadow-md">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left text-gray-700">Sampul</th>
                    <th class="px-4 py-2 text-left text-gray-700">ISBN</th>
                    <th class="px-4 py-2 text-left text-gray-700">Judul</th>
                    <th class="px-4 py-2 text-left text-gray-700">Kategori</th>
                    <th class="px-4 py-2 text-left text-gray-700">Pengarang</th>
                    <th class="px-4 py-2 text-left text-gray-700">Penerbit</th>
                    <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $buku)
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            <img src="{{ $buku->BUKU_SAMPUL ? asset('images/sampul_buku/' . $buku->BUKU_SAMPUL) : '/images/buku.jpeg' }}" alt="Sampul Buku" class="w-16 h-auto rounded">
                        </td>
                        <td class="px-4 py-2 text-gray-700">{{ $buku->BUKU_ISBN }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $buku->BUKU_JUDUL }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $buku->kategori->KATEGORI_NAMA ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $buku->pengarang->PENGARANG_NAMA ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $buku->penerbit->PENERBIT_NAMA ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('buku.edit', $buku->BUKU_ISBN) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('buku.destroy', $buku->BUKU_ISBN) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-4">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</x-layoutadmin>
<x-footer></x-footer>
