@extends('layouts.app') 
@section ('title', 'Toutes les recettes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Vos Recettes</h1>

    {{-- Bouton pour ajouter une nouvelle recette --}}
    <div class="mb-6">
        <a href="{{ route('recettes.create') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Ajouter une Recette
        </a>
    </div>

    {{-- Grille des recettes --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($recettes as $recette)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                {{-- Image de la recette --}}
                @if ($recette->image)
                    <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->titre }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Image non disponible</span>
                    </div>
                @endif

                {{-- Contenu de la carte --}}
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $recette->titre }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($recette->description, 100) }}</p>

                    {{-- Catégorie --}}
                    <p class="text-sm text-gray-500 mb-2">
                        <span class="font-medium">Catégorie :</span> {{ $recette->categorie->nom }}
                    </p>

                    {{-- Difficulté --}}
                    <p class="text-sm text-gray-500 mb-2">
                        <span class="font-medium">Difficulté :</span> {{ $recette->difficulte }}
                    </p>

                    {{-- Temps de préparation et cuisson --}}
                    <p class="text-sm text-gray-500 mb-4">
                        <span class="font-medium">Temps :</span> 
                        {{ $recette->temps_preparation }} min (préparation) / 
                        {{ $recette->temps_cuisson }} min (cuisson)
                    </p>

                    {{-- Bouton pour voir la recette --}}
                    <a href="{{ route('recettes.show', $recette->slug) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Voir la Recette
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if ($recettes->hasPages())
        <div class="mt-8">
            {{ $recettes->links() }}
        </div>
    @endif
</div>
@endsection