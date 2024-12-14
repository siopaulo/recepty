@extends('layouts.app')

@section('content')
    <div class="bg-gray-900 flex items-center justify-center min-h-screen py-12 px-6 custom-bg">
        <div class="bg-white shadow-md rounded-lg w-full max-w-md p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Upravit recept</h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-200 p-4 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Recipe Name -->
                <div class="mb-6">
                    <label for="name" class="block text-lg font-medium text-gray-700">Název receptu</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-3 border rounded-lg" value="{{ old('name', $recipe->name) }}" required>
                </div>

                <!-- Ingredients -->
                <div class="mb-6">
                    <label for="ingredients" class="block text-lg font-medium text-gray-700">Ingredience (oddělit čárkou)</label>
                    <textarea name="ingredients" id="ingredients" rows="5" class="w-full px-4 py-3 border rounded-lg" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
                </div>

                <!-- Servings -->
                <div class="mb-6">
                    <label for="servings" class="block text-lg font-medium text-gray-700">Počet porcí</label>
                    <input type="number" name="servings" id="servings" class="w-full px-4 py-3 border rounded-lg" min="1" max="99" value="{{ old('servings', $recipe->servings) }}" required>
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category_id" class="block text-lg font-medium text-gray-700">Kategorie</label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-3 border rounded-lg">
                        <option value="">-- Vyberte kategorii --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if(old('category_id', $recipe->category_id) == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Allergens Dropdown with Checkboxes -->
                <div
                    x-data="{
                    open: false,
                    selectedAllergens: @json(old('allergens', $recipe->allergens->pluck('id')->toArray()))
                }"
                    class="relative w-full mb-6"
                >
                    <label for="allergens" class="block text-lg font-medium text-gray-700">Alergeny</label>
                    <button type="button" @click="open = !open" class="w-full px-4 py-3 border rounded-lg sm:text-left border-gray-500">
                        Vyberte alergeny
                    </button>
                    <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 mt-1 bg-white border rounded-md w-full shadow-lg">
                        <div class="p-2 space-y-2">
                            @foreach ($allergens as $allergen)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" :value="{{ $allergen->id }}"
                                           @click="
                                    if ($el.checked) {
                                        selectedAllergens.push({{ $allergen->id }})
                                    } else {
                                        selectedAllergens = selectedAllergens.filter(i => i !== {{ $allergen->id }})
                                    }
                                "
                                           :checked="selectedAllergens.includes({{ $allergen->id }})"
                                           class="form-checkbox h-4 w-4 text-blue-600 rounded" />
                                    <span>{{ $allergen->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <template x-for="allergenId in selectedAllergens" :key="allergenId">
                        <input type="hidden" name="allergens[]" :value="allergenId" />
                    </template>
                </div>

                <!-- Steps -->
                <div class="mb-6">
                    <label for="steps" class="block text-lg font-medium text-gray-700">Pracovní postup</label>
                    <textarea name="steps" id="steps" rows="5" class="w-full px-4 py-3 border rounded-lg" required>{{ old('steps', $recipe->steps) }}</textarea>
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-lg font-medium text-gray-700">Obrázek</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 border rounded-lg">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center items-center gap-4">
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg shadow-lg hover:bg-green-700 transition duration-300">
                        Uložit recept
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
