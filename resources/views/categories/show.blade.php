@extends('layouts.app')

@section('title', $categorie->nom)

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $categorie->nom }}</h1>
            
            @if($categorie->description)
                <div class="text-gray-600 mb-6">
                    {{ $categorie->description }}
                </div>
            @endif
            
            <div class="mt-8 flex gap-4">
                <a href="{{ route('categories.edit', $categorie) }}" 
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Modifier cette catégorie
                </a>
                <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                        Supprimer
                    </button>
                </form>
            </div>
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