<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\{
    CategorieController,
    RecetteController
};


Route::get('/', [CategorieController::class, 'index'])->name('home');


Route::get('categories', [CategorieController::class, 'index'])->name('index');
Route::get('/categories/{categorie:slug}', [CategorieController::class, 'show'])->name('categories.show');

Route::resource('recettes', RecetteController::class);
Route::get('/recettes/{recette:slug}', [RecetteController::class, 'show'])->name('recettes.show');



