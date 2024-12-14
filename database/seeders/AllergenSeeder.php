<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    public function run(): void
    {
        $allergens = [
            [
                'name' => 'Lepek (pšenice, žito, ječmen, oves)',
                'genitive_name' => 'lepku',
            ],
            [
                'name' => 'Korýši',
                'genitive_name' => 'korýšů',
            ],
            [
                'name' => 'Vejce',
                'genitive_name' => 'vejce',
            ],
            [
                'name' => 'Ryby',
                'genitive_name' => 'ryb',
            ],
            [
                'name' => 'Podzemnice olejná (arašídy)',
                'genitive_name' => 'podzemnic olejné',
            ],
            [
                'name' => 'Sója',
                'genitive_name' => 'soji',
            ],
            [
                'name' => 'Mléko',
                'genitive_name' => 'mléka',
            ],
            [
                'name' => 'Skořápkové plody (ořechy)',
                'genitive_name' => 'skořápkových plodů',
            ],
            [
                'name' => 'Celer',
                'genitive_name' => 'celeru',
            ],
            [
                'name' => 'Hořčice',
                'genitive_name' => 'hořčice',
            ],
            [
                'name' => 'Sezamová semena',
                'genitive_name' => 'sezamových semen',
            ],
            [
                'name' => 'Oxid siřičitý a siřičitany',
                'genitive_name' => 'oxidů siřičitých a siřičitanů',
            ],
            [
                'name' => 'Vlčí bob (lupina)',
                'genitive_name' => 'vlčích bobů',
            ],
            [
                'name' => 'Měkkýši',
                'genitive_name' => 'měkkýšů',
            ],
        ];

        foreach ($allergens as $allergen) {
            Allergen::updateOrCreate(
                ['name' => $allergen['name']],
                ['genitive_name' => $allergen['genitive_name']]
            );
        }
    }
}
