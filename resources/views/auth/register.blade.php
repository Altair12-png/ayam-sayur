<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-200 min-h-screen">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Registrasi Akun</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none">
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 text-white py-3 rounded-lg shadow-md hover:bg-gradient-to-l hover:from-green-500 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-teal-300 mt-6">Daftar</button>
            </form>

            <p class="mt-4 text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600">Login Sekarang</a></p>
        </div>
    </div>
</body>
</html>
