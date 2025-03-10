<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Entrées' => 'Les meilleures entrées pour commencer un repas',
            'Plats' => 'Plats principaux délicieux pour tous les goûts',
            'Desserts' => 'Douceurs et gourmandises pour terminer en beauté',
            'Extras' => 'Accompagnements, sauces et compléments'
        ];

        foreach ($categories as $nom => $description) {
            Categorie::create([
                'nom' => $nom,
                'slug' => Str::slug($nom),
                'description' => $description
            ]);
        }
    }
}
