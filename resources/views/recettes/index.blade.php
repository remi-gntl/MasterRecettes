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
    <div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($recettes as $recette)
                @include('components.recette-card', ['recette' => $recette])
            @empty
                <p class="text-gray-500">Aucune recette pour le moment.</p>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    @if ($recettes->hasPages())
        <div class="mt-8">
            {{ $recettes->links() }}
        </div>
    @endif
</div>
@endsection