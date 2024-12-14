<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergen extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'genitive_name'];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'allergen_recipe');
    }
}
