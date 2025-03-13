@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Mon profil</h1>
            <a href="{{ route('profile.edit') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Modifier mon profil
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600">Nom</p>
                <p class="font-medium">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-gray-600">Nom d'utilisateur</p>
                <p class="font-medium">{{ $user->username }}</p>
            </div>
            <div>
                <p class="text-gray-600">Email</p>
                <p class="font-medium">{{ $user->email }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Mes recettes</h2>
            <a href="{{ route('recettes.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                Ajouter une recette
            </a>
        </div>
        
        @if($recettes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recettes as $recette)
                    <div class="relative">
                        @include('components.recette-card', ['recette' => $recette])
                        <div class="absolute top-2 right-2 flex space-x-2 z-10">
                            <a href="{{ route('recettes.edit', $recette->slug) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded-full">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form action="{{ route('recettes.destroy', $recette->slug) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-full">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $recettes->links() }}
            </div>  
        @else
            <div class="bg-gray-100 rounded-lg p-6 text-center">
                <p class="text-2xl font-semibold text-gray-600">Vous n'avez pas de recettes</p>
            </div>
        @endif
    </div>
</div>
@endsection