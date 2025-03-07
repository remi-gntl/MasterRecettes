<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'ingredients',
        'instructions',
        'temps_preparation',
        'temps_cuisson',
        'portions',
        'difficulte',
        'image',
        'categorie_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
