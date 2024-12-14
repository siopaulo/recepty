<x-guest-layout>
    <div class="bg-white shadow-md rounded-lg w-full max-w-md p-6 mx-auto">
        <h2 class="text-center text-xl font-semibold text-gray-700 mb-4">Zapomenuté heslo</h2>
        <p class="text-sm text-gray-600 mb-6">
            {{ __('Zapomněli jste heslo? Žádný problém. Zadejte svou emailovou adresu a my vám pošleme odkaz na resetování hesla.') }}
        </p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" required autofocus
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition">
                Odeslat odkaz na reset hesla
            </button>
        </form>
    </div>
</x-guest-layout>
