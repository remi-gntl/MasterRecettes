<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\{
    CategorieController,
    RecetteController
};


Route::get('/', [CategorieController::class, 'index'])->name('home');


Route::resource('categories', CategorieController::class);
Route::resource('recettes', RecetteController::class);