@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-r from-gray-800 via-gray-900 to-black min-h-screen flex items-center justify-center shadow-2xl custom-bg">
        <div class="bg-white rounded-lg w-full max-w-2xl p-8 shadow-lg">
            <div class="flex flex-col items-center mb-10">
                <h1 class="text-6xl font-semibold text-gray-700 mt-4 mb-6">Jídlo dne</h1>
            </div>

            @if($recipe)
                <div class="flex flex-col items-center justify-center">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $recipe->name }}</h3>
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition duration-300">
                            Zobrazit recept
                        </a>
                    </div>
                    <img src="{{ asset('storage/recipes_images/'.$recipe->image) }}" alt="{{ $recipe->name }}" class="w-96 h-96 object-cover rounded-lg shadow-xl mb-6">

                    <div class="mt-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 sm:text-center">Alergeny:</h2>
                        @if ($recipe->allergens && $recipe->allergens->count())
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
                </div>
            @else
                <p class="text-center text-gray-500 mt-4">Žádný recept dnes není dostupný.</p>
            @endif
        </div>
    </div>
@endsection
