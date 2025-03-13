<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\{
    CategorieController,
    RecetteController,
    AuthController,
    ProfileController
};


Route::get('/', [CategorieController::class, 'index'])->name('home');


Route::get('categories', [CategorieController::class, 'index'])->name('index');
Route::get('/categories/{categorie:slug}', [CategorieController::class, 'show'])->name('categories.show');


Route::resource('recettes', RecetteController::class);
Route::get('/recettes/{recette:slug}', [RecetteController::class, 'show'])->name('recettes.show');


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create');
    Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');
    Route::get('/recettes/{recette}/edit', [RecetteController::class, 'edit'])->name('recettes.edit');
    Route::put('/recettes/{recette}', [RecetteController::class, 'update'])->name('recettes.update');
    Route::delete('/recettes/{recette}', [RecetteController::class, 'destroy'])->name('recettes.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    //routes pour admin
});