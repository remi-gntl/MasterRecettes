<?php

namespace Database\Seeders;

use App\Models\Recette;
use App\Models\Categorie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorieSeeder::class,
        ]);

        // Créer 5 recettes pour chaque catégorie
        Categorie::all()->each(function ($categorie) {
            Recette::factory(5)->create([
                'categorie_id' => $categorie->id
            ]);
        });
    }
}
