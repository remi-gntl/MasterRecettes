@extends('layouts.app')

@section('title', 'Accueil - Répertoire de Recettes')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Bienvenue sur Cuisine Facile</h1>
        <p class="text-lg text-gray-600">Découvrez notre sélection de recettes délicieuses</p>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Catégories de recettes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $categorie)
                <a href="{{ route('categories.show', $categorie) }}" 
                   class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="bg-indigo-100 h-32 flex items-center justify-center">
                        <span class="text-2xl font-bold text-indigo-600">{{ $categorie->nom }}</span>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600">{{ Str::limit($categorie->description, 100) }}</p>
                        <p class="mt-2 text-sm text-indigo-600">{{ $categorie->recettes->count() }} recettes</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Recettes récentes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(App\Models\Recette::latest()->take(6)->get() as $recette)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    @if($recette->image)
                        <img src="{{ asset('storage/' . $recette->image) }}" 
                             alt="{{ $recette->titre }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">Pas d'image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">{{ $recette->titre }}</h3>
                        <p class="text-gray-600 mb-2">{{ Str::limit($recette->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-indigo-600">{{ $recette->categorie->nom }}</span>
                            <a href="{{ route('recettes.show', $recette) }}" 
                               class="text-indigo-600 hover:text-indigo-800">Voir la recette</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('recettes.index') }}" 
               class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Voir toutes les recettes
            </a>
        </div>
    </div>
@endsection