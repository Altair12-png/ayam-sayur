
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Admin Login</h2>
        
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your email" required>
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your password" required>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 text-white py-3 rounded-lg shadow-md hover:bg-gradient-to-l hover:from-green-500 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-teal-300 mt-6">Login</button>
        </form>

        <!-- <div class="mt-4 text-center">
            <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>
        </div> -->
    </div>
</body>
</html>
