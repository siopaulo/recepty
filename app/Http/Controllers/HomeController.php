<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $recipe = Recipe::inRandomOrder()->first();

        return view('home', compact('recipe'));
    }
}
