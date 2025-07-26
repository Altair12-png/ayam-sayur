<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-200 min-h-screen">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none">
                </div>
                
                <p>Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600">Daftar Sekarang</a></p>
                
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 text-white py-3 rounded-lg shadow-md hover:bg-gradient-to-l hover:from-green-500 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-teal-300 mt-6">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
