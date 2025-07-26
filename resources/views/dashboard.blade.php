<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-gray-50 via-gray-100 to-gray-200 min-h-screen">>

    <!-- Kontainer utama -->
    <div class="container mx-auto mt-20 p-8 bg-white rounded-2xl shadow-2xl max-w-lg border border-gray-200">
        
        <!-- Judul -->
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-blue-800 tracking-wide">LiterasiID</h1>
            <p class="mt-2 text-lg text-gray-500 font-medium">Toko Buku Favoritmu!</p>
        </div>

        <!-- Menampilkan nama pengguna jika sudah login -->
        @if(Auth::check())
        <div class="bg-gradient-to-r from-blue-800 via-indigo-600 to-teal-400 text-white p-6 rounded-lg shadow-lg text-center mb-6 mt-6">
            <h1 class="text-3xl font-semibold">
                Hai <span class="font-extrabold">{{ Auth::user()->name }}</span>,
            </h1>
        </div>
        @else
        <div class="mt-8">
            <h2 class="text-xl font-medium text-gray-700 text-center">
                Silakan login untuk melanjutkan.
            </h2>
        </div>
        @endif

        <!-- Tombol Lanjut -->
        <div class="mt-8 text-center">
            <p class="mt-2 text-lg text-gray-600 " >Klik untuk melanjutkan</p>
            <a href="/Home" class="w-full inline-block">
                <button class="w-full bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 text-white py-3 rounded-lg shadow-md hover:bg-gradient-to-l hover:from-green-500 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-teal-300 mt-6">
                    Lanjut
                </button>
            </a>
        </div>
    </div>

</body>
</html>
