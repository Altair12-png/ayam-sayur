<x-layoutadmin>
     <x-slot:title>Hai Admin</x-slot:title>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Kategori</h1>

        <form action="{{ route('kategori.update', $kategori->KATEGORI_ID) }}" method="POST" class="bg-white p-6 rounded-md shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="KATEGORI_NAMA" class="block text-gray-700">Nama Kategori</label>
                <input type="text" id="KATEGORI_NAMA" name="KATEGORI_NAMA" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('KATEGORI_NAMA', $kategori->KATEGORI_NAMA) }}" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Perbarui</button>
        </form>
    </div>
</body>
</x-layoutadmin>
<x-footer></x-footer>