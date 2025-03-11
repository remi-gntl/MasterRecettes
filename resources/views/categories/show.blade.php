@extends('layouts.app')

@section('title', $categorie->nom)

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ 'Les '.$categorie->nom }}</h1>
            
            @if($categorie->description)
                <div class="text-gray-600 mb-6">
                    {{ $categorie->description }}
                </div>
            @endif
        </div>
    </div>
    
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recettes dans cette catégorie</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($categorie->recettes as $recette)
                @include('components.recette-card', ['recette' => $recette])
            @empty
                <p class="text-gray-500">Aucune recette dans cette catégorie pour le moment.</p>
            @endforelse
        </div>
    </div>
@endsection