<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'category', 'searchRecipes', 'dailyRecipe']);
    }


    public function index(): View
    {
        $categories = Category::all();
        $allergens = Allergen::all(['id', 'name', 'genitive_name']);
        return view('recepty.index', compact('categories', 'allergens'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $allergens = Allergen::all()->pluck('name', 'id');

        return view('recepty.create', compact('categories', 'allergens'));
    }


    public function category($categoryId): View
    {
        $category = Category::findOrFail($categoryId);
        $recipes = Recipe::where('category_id', $category->id)->get();

        return view('recepty.category', compact('category', 'recipes'));
    }

    /**
     * @throws AuthorizationException
     */
    public function show($id): View
    {
        $recipe = Recipe::findOrFail($id);

        $ingredients = is_array($recipe->ingredients)
            ? $recipe->ingredients
            : json_decode($recipe->ingredients, true);

        return view('recepty.show', compact('recipe', 'ingredients'));
    }


    public function searchRecipes(Request $request): JsonResponse
    {
        $query = $request->input('query');
        $allergens = array_filter(explode(',', $request->input('allergens', '')));

        $recipes = Recipe::query();

        if ($query) {
            $recipes->where('name', 'like', '%' . $query . '%');
        }

        if (!empty($allergens)) {
            $recipes->whereDoesntHave('allergens', function($q) use ($allergens) {
                $q->whereIn('allergen_id', $allergens);
            });
        }

        return response()->json($recipes->get());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews' => 'nullable|integer|min:0',
            'allergens' => 'array',
            'allergens.*' => 'exists:allergens,id',
            'steps' => 'nullable|string',
            'servings' => 'nullable|integer|min:1|max:99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8096',
        ]);

        $recipe = new Recipe();
        $recipe->name = $validated['name'];
        $recipe->ingredients = explode("\n", $validated['ingredients']);
        $recipe->category_id = $validated['category_id'];
        $recipe->rating = $validated['rating'] ?? null;
        $recipe->reviews = $validated['reviews'] ?? 0;
        $recipe->steps = $validated['steps'] ?? null;
        $recipe->servings = $validated['servings'] ?? null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes_images', 'public');
            $recipe->image = basename($imagePath);
        }
        $recipe->user_id = Auth::id();

        $recipe->save();

        if (isset($validated['allergens'])) {
            $recipe->allergens()->attach($validated['allergens']);
        }

        return redirect()->route('recipes.index')->with('success', 'Recept byl úspěšně přidán');
    }


    public function rate(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $recipe = Recipe::findOrFail($id);

        $existingRating = Rating::where('recipe_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingRating) {
            $existingRating->rating = $request->rating;
            $existingRating->save();
        } else {
            Rating::create([
                'recipe_id' => $id,
                'user_id' => auth()->id(),
                'rating' => $request->rating,
            ]);
        }

        $averageRating = $recipe->ratings()->avg('rating');
        $reviewsCount = $recipe->ratings()->count();

        $recipe->rating = $averageRating;
        $recipe->reviews = $reviewsCount;
        $recipe->save();

        return redirect()->route('recipes.show', $id)->with('success', 'Tvoje hlasování bylo uloženo.');
    }


    /**
     * @throws AuthorizationException
     */
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);

        $this->authorize('update', $recipe);

        $categories = Category::all();
        $allergens = Allergen::all()->pluck('name', 'id');

        $recipe->ingredients = is_array($recipe->ingredients)
            ? implode("\n", $recipe->ingredients)
            : $recipe->ingredients;

        return view('recepty.edit', compact('recipe', 'categories', 'allergens'));
    }


    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $recipe = Recipe::findOrFail($id);

        $this->authorize('update', $recipe);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews' => 'nullable|integer|min:0',
            'allergens' => 'array',
            'allergens.*' => 'exists:allergens,id',
            'steps' => 'nullable|string',
            'servings' => 'nullable|integer|min:1|max:99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $recipe->update([
            'name' => $validated['name'],
            'ingredients' => explode("\n", $validated['ingredients']),
            'category_id' => $validated['category_id'],
            'rating' => $validated['rating'] ?? $recipe->rating,
            'reviews' => $validated['reviews'] ?? $recipe->reviews,
            'steps' => $validated['steps'] ?? $recipe->steps,
            'servings' => $validated['servings'] ?? $recipe->servings,
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::disk('public')->delete('recipes_images/' . $recipe->image);
            }

            $imagePath = $request->file('image')->store('recipes_images', 'public');
            $recipe->update(['image' => basename($imagePath)]);
        }

        $recipe->allergens()->sync($validated['allergens'] ?? []);

        return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recept byl úspěšně aktualizován');
    }


    /**
     * @throws AuthorizationException
     */
    public function destroy($id): RedirectResponse
    {
        $recipe = Recipe::findOrFail($id);

        $this->authorize('delete', $recipe);

        if ($recipe->image) {
            Storage::disk('public')->delete('recipes_images/' . $recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recept byl úspěšně smazán');
    }

    public function dailyRecipe(): View
    {
        $recipe = $this->getRandomRecipe();
        return view('home', compact('recipe'));
    }

    private function getRandomRecipe(): ?Recipe
    {
        return Recipe::inRandomOrder()->first();
    }

}
