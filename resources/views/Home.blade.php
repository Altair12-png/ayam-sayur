<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<!-- Your content -->

    <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white p-6 rounded-lg shadow-lg text-center mb-6">
        <h1 class="text-3xl font-semibold">
            Hai <span class="font-extrabold">{{ Auth::user()->name }}</span>, 
        </h1>
        <p class="mt-2 text-lg">Selamat datang di LiterasiID, tempat belanja buku favoritmu!</p>
    </div>

    
<!-- images slider -->
<div id="gallery" class="relative w-full mb-6" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <!-- Item 1 -->
        <div class="absolute top-0 left-0 w-full h-full duration-700 ease-in-out" data-carousel-item>
            <img src="/images/gambar web buku 1.jpg" class="w-full h-full object-cover" alt="Image 1">
        </div>
        <!-- Item 2 -->
        <div class="absolute top-0 left-full w-full h-full duration-700 ease-in-out" data-carousel-item>
            <img src="/images/gambar web buku 2.jpg" class="w-full h-full object-cover" alt="Image 2">
        </div>
        <!-- Item 3 -->
        <div class="absolute top-0 left-full w-full h-full duration-700 ease-in-out" data-carousel-item>
            <img src="/images/gambar web buku 3.jpg" class="w-full h-full object-cover" alt="Image 3">
        </div>
        <!-- Item 4 -->
        <div class="absolute top-0 left-full w-full h-full duration-700 ease-in-out" data-carousel-item>
            <img src="/images/gambar web buku 4.jpg" class="w-full h-full object-cover" alt="Image 4">
        </div>
        <!-- Item 5 -->
        <div class="absolute top-0 left-full w-full h-full duration-700 ease-in-out" data-carousel-item>
            <img src="/images/gambar web buku 5.jpg" class="w-full h-full object-cover" alt="Image 5">
        </div>
    </div>

    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/forms@0.4.0/dist/index.min.js"></script>

<script>
    // Inisialisasi untuk kontrol carousel
    const prev = document.querySelector('[data-carousel-prev]');
    const next = document.querySelector('[data-carousel-next]');
    const items = document.querySelectorAll('[data-carousel-item]');

    let currentIndex = 0;

    // Fungsi untuk menampilkan item carousel berikutnya
    function showNextItem() {
        // Animasi geser ke kiri
        items[currentIndex].classList.remove('left-0');
        items[currentIndex].classList.add('left-full');
        items[currentIndex].classList.add('transition-all', 'duration-700', 'ease-in-out');
        
        // Pindah ke item berikutnya
        currentIndex = (currentIndex + 1) % items.length;
        items[currentIndex].classList.remove('left-full');
        items[currentIndex].classList.add('left-0');
    }

    // Fungsi untuk menampilkan item carousel sebelumnya
    function showPrevItem() {
        // Animasi geser ke kanan
        items[currentIndex].classList.remove('left-0');
        items[currentIndex].classList.add('left-full');
        items[currentIndex].classList.add('transition-all', 'duration-700', 'ease-in-out');
        
        // Pindah ke item sebelumnya
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        items[currentIndex].classList.remove('left-full');
        items[currentIndex].classList.add('left-0');
    }

    // Kontrol tombol 'prev' dan 'next'
    prev.addEventListener('click', showPrevItem);
    next.addEventListener('click', showNextItem);

    // Autoplay: Ganti gambar setiap 3 detik (3000 milidetik)
    setInterval(showNextItem, 3000);  // Mengganti gambar otomatis setiap 3 detik
</script>




<!-- images slider akhir -->


<!-- Dashboard Cards -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-10">
 
    <!-- Total Penjualan Card -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold text-red-600">Total Pembelian User</h3>
    <p class="text-4xl font-bold mt-2">{{ $totalPembelian }}</p>
  </div>



</div>

<div class="mt-10 bg-white shadow rounded-lg overflow-x-auto">
        <h3 class="text-2xl font-semibold p-6">Buku Terbitan Terbaru</h3>
        <table class="w-full">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left">Judul Buku</th>
                    <th class="py-3 px-4 text-left">Penerbit</th>
                    <th class="py-3 px-4 text-left">Tanggal Terbit</th>
                    <th class="py-3 px-4 text-left">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                {{-- PERBAIKAN: Baris tabel menjadi bisa diklik --}}
                <tr class="border-b hover:bg-indigo-50 cursor-pointer" onclick="window.location='{{ route('buku.show', $book->BUKU_ISBN) }}'">
                    <td class="py-3 px-4 font-semibold text-indigo-600">{{ $book->BUKU_JUDUL }}</td>
                    <td class="py-3 px-4">{{ $book->penerbit->PENERBIT_NAMA }}</td>
                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($book->BUKU_TGLTERBIT)->format('d M Y') }}</td>
                    <td class="py-3 px-4">Rp {{ number_format($book->BUKU_HARGA, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>






</x-layout>

<x-footer></x-footer>