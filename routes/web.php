<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\{
    CategorieController,
    RecetteController,
    AuthController,
    ProfileController,
    AdminController
};

// Route d'accueil
Route::get('/', [CategorieController::class, 'index'])->name('home');

// Routes pour les catégories
Route::get('categories', [CategorieController::class, 'index'])->name('index');
Route::get('/categories/{categorie:slug}', [CategorieController::class, 'show'])->name('categories.show');

// Routes pour les recettes - liste générale
Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');

// Routes pour les utilisateurs non connectés
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Routes pour les utilisateurs connectés
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Routes pour création de recettes (doit être AVANT la route show)
    Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create');
    Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');

    // Routes pour le profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route pour afficher une recette spécifique (doit être APRÈS /recettes/create)
Route::get('/recettes/{recette}', [RecetteController::class, 'show'])->name('recettes.show');

// Routes pour modification/suppression de recettes (doivent être APRÈS la route show)
Route::middleware('auth')->group(function () {
    Route::get('/recettes/{recette}/edit', [RecetteController::class, 'edit'])->name('recettes.edit');
    Route::put('/recettes/{recette}', [RecetteController::class, 'update'])->name('recettes.update');
    Route::delete('/recettes/{recette}', [RecetteController::class, 'destroy'])->name('recettes.destroy');
});

// Routes pour l'administration
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::put('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});