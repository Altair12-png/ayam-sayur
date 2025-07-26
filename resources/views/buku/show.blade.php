<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto p-4 md:p-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-1 flex justify-center">
                        <img src="{{ $buku->BUKU_SAMPUL ? asset('images/sampul_buku/' . $buku->BUKU_SAMPUL) : '/images/buku.jpeg' }}" 
                             alt="Sampul {{ $buku->BUKU_JUDUL }}" 
                             class="w-full max-w-xs md:max-w-full h-auto object-cover rounded-lg shadow-md">
                    </div>

                    <div class="md:col-span-2">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $buku->BUKU_JUDUL }}</h1>
                        <p class="text-lg text-indigo-600 font-semibold mt-2">{{ $buku->pengarang->PENGARANG_NAMA ?? 'N/A' }}</p>
                        <div class="flex items-center text-gray-600 mt-1">
                            <span>{{ $buku->penerbit->PENERBIT_NAMA ?? 'N/A' }}</span>
                            <span class="mx-2">&bull;</span>
                            <span>Kategori: {{ $buku->kategori->KATEGORI_NAMA ?? 'N/A' }}</span>
                        </div>
                        
                        <div class="mt-6 border-t pt-4">
                            <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</span>
                        </div>

                        <div class="mt-6">
                             <a href="{{ route('pembelian.tampil', ['judul_buku' => $buku->BUKU_JUDUL, 'isbn' => $buku->BUKU_ISBN, 'harga' => $buku->BUKU_HARGA]) }}" 
                                class="inline-block w-full sm:w-auto text-center bg-indigo-600 text-white py-3 px-8 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition duration-300">
                                Beli Buku
                            </a>
                        </div>
                        
                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-center border-t pt-4">
                             <div class="p-2">
                                <span class="block text-sm text-gray-500">Jumlah Halaman</span>
                                <span class="block font-semibold">{{ $buku->BUKU_JMLHALAMAN ?? 'N/A' }}</span>
                            </div>
                             <div class="p-2">
                                <span class="block text-sm text-gray-500">Tanggal Terbit</span>
                                <span class="block font-semibold">{{ \Carbon\Carbon::parse($buku->BUKU_TGLTERBIT)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang Buku Ini</h2>
                    <div class="prose max-w-none text-gray-700">
                        <p>{{ $buku->BUKU_DESKRIPSI ?? 'Tidak ada deskripsi untuk buku ini.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>