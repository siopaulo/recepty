<x-guest-layout>
    <div class="bg-white shadow-md rounded-lg w-full max-w-md p-6 mx-auto">
        <h2 class="text-center text-xl font-semibold text-gray-700 mb-4">Potvrzení hesla</h2>
        <p class="text-sm text-gray-600 mb-6">
            {{ __('Toto je zabezpečená oblast aplikace. Prosím, potvrďte své heslo před pokračováním.') }}
        </p>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Heslo</label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition">
                Potvrdit
            </button>
        </form>
    </div>
</x-guest-layout>
