<x-layoutadmin>
     <x-slot:title>Pustaka Bit</x-slot:title>
     
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Penerbit</h1>

        <form action="{{ route('penerbit.store') }}" method="POST" class="bg-white p-6 rounded-md shadow-md">
            @csrf
            <div class="mb-4">
                <label for="PENERBIT_ID" class="block text-gray-700">Kode Penerbit</label>
                <input type="text" id="PENERBIT_ID" name="PENERBIT_ID" class="w-full p-2 mt-2 border border-gray-300 rounded-md" required maxlength="4">
            </div>

            <div class="mb-4">
                <label for="PENERBIT_NAMA" class="block text-gray-700">Nama Penerbit</label>
                <input type="text" id="PENERBIT_NAMA" name="PENERBIT_NAMA" class="w-full p-2 mt-2 border border-gray-300 rounded-md" required maxlength="50">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
        </form>
    </div>
</body>
</x-layoutadmin>
<x-footer></x-footer>