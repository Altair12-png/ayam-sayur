<x-layoutadmin>
     <x-slot:title>Hai Admin</x-slot:title>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-center mb-6">Tambah Link Buku Kategori</h1>
        <form action="{{ route('link_buku_kategori.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="buku_isbn" class="block text-sm font-medium text-gray-700">ISBN Buku</label>
                    <input type="text" id="buku_isbn" name="buku_isbn" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">ID Kategori</label>
                    <input type="number" id="kategori_id" name="kategori_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="text-center mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</body>
</x-layoutadmin>
<x-footer></x-footer>
