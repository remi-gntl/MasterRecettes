<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Recette;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recette>
 */
class RecetteFactory extends Factory
{
    protected $model = Recette::class;

    public function definition(): array
    {
        $titre = $this->faker->unique()->words(3, true);

        return [
            'titre' => ucfirst($titre),
            'slug' => Str::slug($titre),
            'description' => $this->faker->paragraph(),
            'ingredients' => implode("\n", $this->faker->sentences(mt_rand(5, 10))),
            'instructions' => implode("\n", $this->faker->paragraphs(mt_rand(3, 6))),
            'temps_preparation' => $this->faker->numberBetween(5, 60),
            'temps_cuisson' => $this->faker->numberBetween(0, 120),
            'portions' => $this->faker->numberBetween(1, 10),
            'difficulte' => $this->faker->randomElement(['Facile', 'Moyen', 'Difficile']),
            'image' => null,
            'categorie_id' => Categorie::factory(),
        ];
    }
}
