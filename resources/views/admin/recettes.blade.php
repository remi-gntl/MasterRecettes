@extends('layouts.app')

@section('title', 'Gestion des recettes')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Gestion des recettes</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline">← Retour au dashboard</a>
        </div>
        
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="flex justify-end p-4">
                <a href="{{ route('recettes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    <i class="fas fa-plus mr-1"></i> Ajouter une recette
                </a>
            </div>
            
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">ID</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Titre</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Catégorie</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Auteur</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Date de création</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recettes as $recette)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $recette->id }}</td>
                            <td class="px-4 py-3">{{ $recette->titre }}</td>
                            <td class="px-4 py-3">{{ $recette->categorie->nom ?? 'Non catégorisé' }}</td>
                            <td class="px-4 py-3">{{ $recette->user->name ?? 'Inconnu' }}</td>
                            <td class="px-4 py-3">{{ $recette->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <a href="{{ route('recettes.edit', $recette) }}" class="text-blue-600" title="Modifier">
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.recettes.destroy', $recette) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="button" 
                                            onclick="openModal('{{route ('admin.recettes.destroy', $recette)}}')"
                                            class="text-red-600" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="px-4 py-3">
                {{ $recettes->links() }}
            </div>
        </div>
    </div>


        <!-- Modale de confirmation de suppression -->
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