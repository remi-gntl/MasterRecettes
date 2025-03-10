<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition(): array
    {
        $nom = $this->faker->unique()->randomElement(['Entrées', 'Plats', 'Desserts', 'Boissons', 'Soupes', 'Salades']);
        
        return [
            'nom' => $nom,
            'slug' => Str::slug($nom),
            'description' => $this->faker->paragraph(),
        ];
    }
}
