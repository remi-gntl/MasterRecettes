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
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getTempsPreparationHeuresAttribute()
    {
        return floor($this->temps_preparation / 60);
    }

    public function getTempsPreparationMinutesAttribute()
    {
        return $this->temps_preparation % 60;
    }

    public function getTempsCuissonHeuresAttribute()
    {
        return floor($this->temps_cuisson / 60);
    }

    public function getTempsCuissonMinutesAttribute()
    {
        return $this->temps_cuisson % 60;
    }
}
