<x-layoutadmin>
     <x-slot:title>Hai Admin</x-slot:title>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Buku</h1>

        {{-- Menampilkan semua error di bagian atas untuk debugging --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.update', $buku->BUKU_ISBN) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-md shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="BUKU_ISBN" class="block text-gray-700">ISBN</label>
                <input type="text" id="BUKU_ISBN" name="BUKU_ISBN" class="w-full p-2 mt-2 border @error('BUKU_ISBN') border-red-500 @else border-gray-300 @enderror rounded-md" value="{{ old('BUKU_ISBN', $buku->BUKU_ISBN) }}" required maxlength="13">
                @error('BUKU_ISBN')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="BUKU_JUDUL" class="block text-gray-700">Judul Buku</label>
                <input type="text" id="BUKU_JUDUL" name="BUKU_JUDUL" class="w-full p-2 mt-2 border @error('BUKU_JUDUL') border-red-500 @else border-gray-300 @enderror rounded-md" value="{{ old('BUKU_JUDUL', $buku->BUKU_JUDUL) }}" required maxlength="75">
                @error('BUKU_JUDUL')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="PENERBIT_ID" class="block text-gray-700">Penerbit</label>
                <select id="PENERBIT_ID" name="PENERBIT_ID" class="w-full p-2 mt-2 border @error('PENERBIT_ID') border-red-500 @else border-gray-300 @enderror rounded-md">
                    @foreach ($penerbits as $penerbit)
                        <option value="{{ $penerbit->PENERBIT_ID }}" {{ old('PENERBIT_ID', $buku->PENERBIT_ID) == $penerbit->PENERBIT_ID ? 'selected' : '' }}>
                            {{ $penerbit->PENERBIT_NAMA }}
                        </option>
                    @endforeach
                </select>
                 @error('PENERBIT_ID')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- PERBAIKAN: Menambahkan kembali dropdown Kategori --}}
            <div class="mb-4">
                <label for="KATEGORI_ID" class="block text-gray-700">Kategori</label>
                <select id="KATEGORI_ID" name="KATEGORI_ID" class="w-full p-2 mt-2 border @error('KATEGORI_ID') border-red-500 @else border-gray-300 @enderror rounded-md">
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->KATEGORI_ID }}" {{ old('KATEGORI_ID', $buku->KATEGORI_ID) == $kategori->KATEGORI_ID ? 'selected' : '' }}>
                            {{ $kategori->KATEGORI_NAMA }}
                        </option>
                    @endforeach
                </select>
                @error('KATEGORI_ID')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- PERBAIKAN: Menambahkan kembali dropdown Pengarang --}}
            <div class="mb-4">
                <label for="PENGARANG_ID" class="block text-gray-700">Pengarang</label>
                <select id="PENGARANG_ID" name="PENGARANG_ID" class="w-full p-2 mt-2 border @error('PENGARANG_ID') border-red-500 @else border-gray-300 @enderror rounded-md">
                    @foreach ($pengarangs as $pengarang)
                        <option value="{{ $pengarang->PENGARANG_ID }}" {{ old('PENGARANG_ID', $buku->PENGARANG_ID) == $pengarang->PENGARANG_ID ? 'selected' : '' }}>
                            {{ $pengarang->PENGARANG_NAMA }}
                        </option>
                    @endforeach
                </select>
                @error('PENGARANG_ID')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="BUKU_TGLTERBIT" class="block text-gray-700">Tanggal Terbit</label>
                <input type="date" id="BUKU_TGLTERBIT" name="BUKU_TGLTERBIT" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_TGLTERBIT', $buku->BUKU_TGLTERBIT) }}">
            </div>

            <div class="mb-4">
                <label for="BUKU_JMLHALAMAN" class="block text-gray-700">Jumlah Halaman</label>
                <input type="number" id="BUKU_JMLHALAMAN" name="BUKU_JMLHALAMAN" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_JMLHALAMAN', $buku->BUKU_JMLHALAMAN) }}">
            </div>

            <div class="mb-4">
                <label for="BUKU_DESKRIPSI" class="block text-gray-700">Deskripsi</label>
                <textarea id="BUKU_DESKRIPSI" name="BUKU_DESKRIPSI" class="w-full p-2 mt-2 border border-gray-300 rounded-md">{{ old('BUKU_DESKRIPSI', $buku->BUKU_DESKRIPSI) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="BUKU_HARGA" class="block text-gray-700">Harga</label>
                <input type="number" id="BUKU_HARGA" name="BUKU_HARGA" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_HARGA', $buku->BUKU_HARGA) }}" step="0.01">
            </div>

            <div class="mb-4">
                <label for="BUKU_SAMPUL" class="block text-gray-700">Ganti Sampul Buku</label>
                <input type="file" id="BUKU_SAMPUL" name="BUKU_SAMPUL" class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                @if ($buku->BUKU_SAMPUL)
                    <div class="mt-2">
                        <span class="block text-sm text-gray-500">Sampul saat ini:</span>
                        <img src="{{ asset('images/sampul_buku/' . $buku->BUKU_SAMPUL) }}" alt="Sampul Buku" class="w-32 h-auto mt-2 rounded">
                    </div>
                @endif
                @error('BUKU_SAMPUL')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Perbarui</button>
        </form>
    </div>
</body>
</x-layoutadmin>
<x-footer></x-footer>
