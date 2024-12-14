@extends('layouts.app')

@section('content')
    <div class="bg-gray-900 min-h-screen py-12 px-6 flex flex-col items-center custom-bg" x-data="recipeSearch">
        <div class="w-full max-w-6xl">
            <div class="flex flex-col md:flex-row items-center mb-8 space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex-1 relative">
                    <input
                        type="text"
                        id="search"
                        class="w-full bg-gray-800 text-white placeholder-gray-500 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="Vyhledat recept..."
                        @input.debounce.300ms="searchRecipes"
                        x-model="searchQuery">
                </div>

                <div class="relative w-full md:w-1/3">
                    <button type="button" @click="open = !open" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Filtrovat alergeny
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-cloak
                        @click.away="open = false"
                        class="absolute z-10 mt-1 bg-gray-800 border rounded-md w-full max-h-60 overflow-y-auto shadow-lg">
                        <div class="p-2 space-y-2">
                            @foreach ($allergens as $allergen)
                                <label class="flex items-center space-x-2 cursor-pointer text-white">
                                    <input type="checkbox" :value="{{ $allergen->id }}"
                                           @click="
                        if ($el.checked) {
                            selectedAllergens.push({{ $allergen->id }});
                        } else {
                            selectedAllergens = selectedAllergens.filter(i => i !== {{ $allergen->id }});
                        }
                        searchRecipes();
                    "
                                           :checked="selectedAllergens.includes({{ $allergen->id }})"
                                           class="form-checkbox h-4 w-4 text-yellow-500 rounded" />
                                    <span>bez {{ $allergen->genitive_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div>
                    <button @click="resetFilters" class="w-full px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-400 transition">
                        Reset
                    </button>
                </div>
            </div>

            <div id="searchResults" class="text-white text-center mb-8 max-h-96 overflow-y-auto">
            </div>

            <div class="text-3xl font-bold text-white mb-6 text-center">
                Kategorie receptů:
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('recipes.category', ['category' => $category->id]) }}"
                       class="group bg-gray-800 text-white p-6 rounded-lg shadow-xl hover:scale-105 hover:shadow-2xl transition-all ease-in-out duration-300 flex items-center justify-center">
                        <div class="text-center text-2xl font-semibold group-hover:text-yellow-400">
                            {{ $category->name }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('recipeSearch', () => ({
                searchQuery: '',
                open: false,
                selectedAllergens: [],
                resetFilters() {
                    this.searchQuery = '';
                    this.selectedAllergens = [];
                    this.open = false;
                    this.searchRecipes();
                },
                searchRecipes() {
                    let input = this.searchQuery.trim().toLowerCase();
                    let allergens = this.selectedAllergens;

                    if (input === "" && allergens.length === 0) {
                        document.getElementById("searchResults").innerHTML = "";
                        return;
                    }

                    let url = `/api/search-recipes?query=${encodeURIComponent(input)}`;
                    if (allergens.length > 0) {
                        url += `&allergens=${allergens.join(',')}`;
                    }

                    fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            let resultHTML = "<h2 class='text-2xl font-semibold text-white mb-4'>Výsledky hledání:</h2>";

                            if (data.length > 0) {
                                let containerClass = data.length > 6 ? "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 max-h-96 overflow-y-auto" : "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4";

                                resultHTML += `<div class='${containerClass}'>`;
                                data.forEach(recipe => {
                                    resultHTML += `
                                    <div class="bg-gray-800 p-3 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <h3 class="text-lg font-semibold text-yellow-500 mb-1">
                                            <a href="/recept/${recipe.id}" class="hover:underline">${recipe.name}</a>
                                        </h3>
                                        <p class="text-gray-300 text-sm">Počet porcí: ${recipe.servings}</p>
                                    </div>
                                `;
                                });
                                resultHTML += "</div>";
                            } else {
                                resultHTML += "<p class='text-gray-400'>Žádné výsledky pro tento dotaz.</p>";
                            }

                            document.getElementById("searchResults").innerHTML = resultHTML;
                        })
                        .catch(error => {
                            console.error("Error fetching recipes:", error);
                            document.getElementById("searchResults").innerHTML = "<p class='text-red-500'>Chyba při načítání receptů.</p>";
                        });
                }
            }));
        });
    </script>

@endsection
