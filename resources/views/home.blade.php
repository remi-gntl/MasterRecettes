@extends('layouts.app')

@section('title', 'Accueil - Répertoire de Recettes')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Bienvenue sur Master Recettes</h1>
        <p class="text-lg text-gray-600">Toutes les recettes de Mamie dans ton appli</p>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Type de recettes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          @foreach($categories as $categorie)
          <div class="relative rounded-lg shadow-md overflow-hidden group">
            <a href="{{ route('categories.show', $categorie) }}" class="absolute inset-0 z-10"></a>
            
            <div class="h-40 overflow-hidden">
                @if($categorie->image)
                    <img src="{{ asset('storage/' . $categorie->image) }}" 
                         alt="{{ $categorie->nom }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="bg-indigo-100 h-full w-full flex items-center justify-center">
                        <span class="text-2xl font-bold text-indigo-600">{{ $categorie->nom }}</span>
                    </div>
                @endif
            </div>
            
            <div class="bg-white p-3 border-t">
                <h3 class="text-lg font-bold text-indigo-600 text-center">{{ $categorie->nom }}</h3>
            </div>
            
            <!-- Overlay au survol -->
            <div class="absolute inset-0 bg-white bg-opacity-90 opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center p-4">
                <h3 class="text-xl font-bold text-indigo-600 mb-2">{{ $categorie->nom }}</h3>
                <p class="text-gray-600 mb-2">{{ $categorie->description }}</p>
                <div class="mt-1">
                    <span class="px-3 py-1 text-xs bg-blue-500 text-white rounded-full">
                        {{ $categorie->recettes->count() }} recettes
                    </span>
                </div>
            </div>
        </div>
      @endforeach
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Les dernières recettes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(App\Models\Recette::latest()->take(6)->get() as $recette)
            @include('components.recette-card', ['recette' => $recette])
            @endforeach
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('recettes.index') }}" 
               class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Voir toutes les recettes
            </a>

            <a href="{{ route('recettes.create') }}" 
               class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Ajouter une recette
            </a>
        </div>
    </div>
@endsection
