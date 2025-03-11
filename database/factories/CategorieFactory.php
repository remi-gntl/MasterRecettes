<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition(): array
    {
        // Retournez uniquement les catégories que vous voulez avoir
        $nom = $this->faker->unique()->randomElement(['Entrées', 'Plats', 'Desserts', 'Extras']);
        
        return [
            'nom' => $nom,
            'slug' => Str::slug($nom),
            'description' => $this->faker->paragraph(),
        ];
    }
}
