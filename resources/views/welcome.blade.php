<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Keluhan - Login/Register</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), /* Gradien transparan */
                url('{{ asset('img/htmc-fix.png') }}'); /* Gambar latar belakang */
            background-size: 150px 150px; /* Ukuran gambar latar belakang */
            background-repeat: repeat; /* Mengulangi gambar */
            background-position: center; /* Posisi gambar di tengah */
        }
    </style>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-semibold text-center text-blue-600 mb-6">Management Keluhan <br> Mahasiswa TC</h1>

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Login</button>
        </form>

        <div class="text-center text-gray-600">Atau</div>

        <!-- Register Button -->
        <a href="{{ route('register') }}" class="w-full mt-4 block bg-blue-100 text-blue-600 py-2 rounded-md text-center hover:bg-blue-200 transition">Buat Akun Baru</a>
    </div>
</body>
</html>
