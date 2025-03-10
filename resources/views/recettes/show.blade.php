@extends('layouts.app')

@section('title', $recette->titre)

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $recette->titre }}</h1>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">
                    {{ $recette->categorie->nom }}
                </span>
            </div>
            
            @if($recette->image)
                <img src="{{ asset('storage/' . $recette->image) }}" 
                     alt="{{ $recette->titre }}" 
                     class="w-full h-64 object-cover rounded-lg mb-6">
            @endif
            
            <div class="text-gray-600 mb-6">
                {{ $recette->description }}
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Temps de préparation</p>
                    <p class="font-semibold">{{ $recette->temps_preparation ?? 'Non spécifié' }} min</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Temps de cuisson</p>
                    <p class="font-semibold">{{ $recette->temps_cuisson ?? 'Non spécifié' }} min</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Difficulté</p>
                    <p class="font-semibold">{{ $recette->difficulte ?? 'Non spécifiée' }}</p>
                </div>
            </div>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3">Ingrédients</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    {!! nl2br(e($recette->ingredients)) !!}
                </div>
            </div>
            
            <div>
                <h2 class="text-xl font-semibold mb-3">Instructions</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    {!! nl2br(e($recette->instructions)) !!}
                </div>
            </div>
            
            <div class="mt-8 flex gap-4">
                <a href="{{ route('recettes.edit', $recette) }}" 
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Modifier cette recette
                </a>
                <form action="{{ route('recettes.destroy', $recette) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Autres recettes que vous pourriez aimer</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(App\Models\Recette::where('categorie_id', $recette->categorie_id)
                        ->where('id', '!=', $recette->id)
                        ->inRandomOrder()
                        ->take(3)
                        ->get() as $autreRecette)
                @include('components.recette-card', ['recette' => $autreRecette])
            @endforeach
        </div>
    </div>
@endsection