<x-layoutadmin>
     <x-slot:title>Hai Admin</x-slot:title>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Penerbit</h1>
        <a href="{{ route('penerbit.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Tambah Penerbit</a>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto bg-white rounded-md shadow-md">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left text-gray-700">Kode Penerbit</th>
                    <th class="px-4 py-2 text-left text-gray-700">Nama Penerbit</th>
                    <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penerbits as $penerbit)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-gray-700">{{ $penerbit->PENERBIT_ID }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $penerbit->PENERBIT_NAMA }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('penerbit.edit', $penerbit->PENERBIT_ID) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('penerbit.destroy', $penerbit->PENERBIT_ID) }}" method="POST" style="display:inline;">
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