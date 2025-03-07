<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\{
    CategorieController,
    RecetteController
};


Route::get('/', function () {
    return view('welcome');
});


Route::resource('categories', CategorieController::class);
Route::resource('recettes', RecetteController::class);