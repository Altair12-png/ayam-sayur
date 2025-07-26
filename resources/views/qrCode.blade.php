<x-layout> 
    <x-slot:title>Silahkan Scan QR Code dibawah ini</x-slot:title>

    <!-- Kontainer untuk QR Code -->
    <div class="flex justify-center items-center bg-gray-100 p-4 rounded-lg shadow-lg max-w-max mx-auto mt-50">
        <img src="/images/qrcode.png" alt="QR code" class="object-contain rounded-lg shadow-md" style="width: 300px; height: 300px;">
    </div>

    <div class="mt-10 text-center">
        <!-- Tombol Kembali dengan JavaScript -->
        <button onclick="window.history.back()" class="w-70 p-6 bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 text-white py-3 rounded-lg shadow-md hover:bg-gradient-to-l hover:from-green-500 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-teal-300 mt-3">
            Kembali
        </button>
    </div>

</x-layout>

<x-footer></x-footer>
