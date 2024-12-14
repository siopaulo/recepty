@extends('layouts.app')

@section('content')
<div class=" min-h-screen flex flex-col items-center overflow-y-auto  custom-bg p-16 ">
<div class=" min-h-screen flex flex-col items-center">
    <div class="bg-white rounded-xl shadow-2xl p-8   w-full max-w-4xl">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between ">
            <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-2">{{ $recipe->name }}</h1>
            <div class="flex items-center space-x-2 text-yellow-600">
                <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                </svg>
                <span class="text-xl font-semibold">{{ number_format($recipe->rating, 1) }}</span>
                <span class="text-gray-500 text-sm ml-2">({{ $recipe->reviews }} recenzí)</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <img
                    src="{{ asset('storage/recipes_images/'.$recipe->image) }}"
                    alt="{{ $recipe->name }}"
                    class="w-full rounded-xl shadow-lg object-cover aspect-square shadow-gray-500"
                >
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4">Ingredience:</h2>
                @if ($ingredients)
                    <ul class="space-y-2 text-gray-700">
                        @foreach ($ingredients as $ingredient)
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $ingredient }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500">Ingredience nejsou uvedeny.</p>
                @endif
            </div>

        </div>

        @if($recipe->servings)
            <div class="mt-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Počet porcí:</h2>
                <p class="text-gray-700">{{ $recipe->servings }} {{ $recipe->servings > 4 ? 'porcí' : 'porce' }}</p>
            </div>
        @endif

        @if($recipe->steps)
        <div class="mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pracovní postup:</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $recipe->steps }}</p>
        </div>
        @endif

        {{-- Allergens --}}
        <div class="mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Alergeny:</h2>
            @if ($recipe->allergens->count())
            <div class="flex flex-wrap space-x-2">
                @foreach ($recipe->allergens as $allergen)
                <a href="/alergeny">
                                <span class="bg-yellow-500 text-black rounded-full px-4 py-2 text-sm relative group cursor-pointer">
                                    {{ $allergen->id }}
                                    <div class="absolute bottom-full mb-2 w-max px-3 py-2 rounded-md bg-gray-700 text-white text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform group-hover:translate-y-1">
                                        {{ $allergen->name }}
                                    </div>
                                </span>
                </a>
                @endforeach
            </div>
            @else
            <p class="text-sm text-gray-500">Žádné alergenové informace.</p>
            @endif
        </div>

        {{-- Rating Section --}}
        @auth
        <div class="mt-8 bg-gray-100 p-6 rounded-xl shadow">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ohodnoť tento recept</h3>
            <form action="{{ route('recipes.rate', $recipe->id) }}" method="POST" class="flex space-x-4">
                @csrf
                <input
                    type="number"
                    name="rating"
                    class="flex-grow px-4 py-2 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    min="1"
                    max="5"
                    step="0.1"
                    value="{{ old('rating') }}"
                    required
                    placeholder="Zadej hodnocení (1-5)"
                >
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300 flex items-center space-x-2"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Hodnotit</span>
                </button>
            </form>
        </div>
        @endauth

        {{-- Action Buttons --}}
        <div class="mt-8 flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:space-x-4 ">
            @auth
            <div class="flex space-x-4">
            @can('update', $recipe)
                <a
                    href="{{ route('recipes.edit', $recipe->id) }}"
                    class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors duration-300 flex items-center justify-center space-x-2 shadow-xl"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                    <span>Upravit</span>
                </a>
            @endcan
            @can('delete', $recipe)
                <form
                    action="{{ route('recipes.destroy', $recipe->id) }}"
                    method="POST"
                    class="flex-1"
                    onsubmit="return confirm('Opravdu chcete tento recept smazat?');"
                >
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="w-full bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition-colors duration-300 flex items-center justify-center space-x-2 shadow-xl"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Smazat</span>
                    </button>
                </form>
                @endcan

            </div>
            @endauth

            <a
                href="{{ route('recipes.index') }}"
                class="bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 transition-colors duration-300 flex items-center justify-center space-x-2 md:w-auto shadow-xl"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span>Zpět na seznam receptů</span>
            </a>
        </div>
    </div>
</div>
@endsection
