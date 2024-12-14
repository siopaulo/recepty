<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AllergenController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');

Route::get('/recepty', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recepty/{category}', [RecipeController::class, 'category'])->name('recipes.category');
Route::get('/recept/{id}', [RecipeController::class, 'show'])->name('recipes.show');

Route::get('/alergeny', [AllergenController::class, 'index'])->name('allergens.index');
Route::get('/daily-recipe', [RecipeController::class, 'dailyRecipe'])->name('recipes.daily');

Route::middleware('auth')->group(function () {
    Route::get('/pridat-recept', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/pridat-recept', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recept/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recept/{id}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recept/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    Route::post('/recept/{id}/rate', [RecipeController::class, 'rate'])->name('recipes.rate');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
