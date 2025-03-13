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
                            <form action="{{ route('recettes.destroy', $recette) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                onclick="openModal('{{ route('recettes.destroy', $recette) }}')" 
                                class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-full">
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


<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-11/12 md:w-1/3">
        <h2 class="text-xl font-semibold mb-4">Confirmer la suppression</h2>
        <p class="text-gray-700 mb-6">Êtes-vous sûr de vouloir supprimer cette recette ?</p>
        <div class="flex justify-end gap-4">
            <button 
                onclick="closeModal()" 
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Annuler
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Fonction pour ouvrir la modale
    function openModal(formAction) {
        const modal = document.getElementById('confirmationModal');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = formAction; // Met à jour l'action du formulaire
        modal.classList.remove('hidden'); // Affiche la modale
    }

    // Fonction pour fermer la modale
    function closeModal() {
        const modal = document.getElementById('confirmationModal');
        modal.classList.add('hidden'); // Cache la modale
    }

    // Gère la soumission du formulaire
    document.getElementById('deleteForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Empêche la soumission par défaut
        closeModal(); // Ferme la modale
        this.submit(); // Soumet le formulaire
    });
</script>
@endsection