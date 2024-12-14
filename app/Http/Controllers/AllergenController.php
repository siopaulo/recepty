<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AllergenController extends Controller
{
    public function index(): View
    {
        $allergens = Allergen::pluck('name', 'id')->toArray();
        return view('allergens.index', compact('allergens'));
    }
}
