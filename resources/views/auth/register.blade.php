<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
<div class="bg-white shadow-md rounded-lg w-full max-w-md p-6">
    <div class="flex flex-col items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
           <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4.001 4.001 0 0110 18h4a4.001 4.001 0 014.879-.196M12 14a4 4 0 100-8 4 4 0 000 8z" />
        </svg>
        <h2 class="text-2xl font-semibold text-gray-700 mt-4">Registrace</h2>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Jméno</label>
            <input type="text" id="name" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Heslo</label>
            <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Potvrďte heslo</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600">Registrovat</button>
    </form>

    <p class="text-sm text-gray-600 text-center mt-4">
        Již máte účet? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Přihlásit se</a>
    </p>
</div>
</body>
</html>
