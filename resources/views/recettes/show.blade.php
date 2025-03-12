@extends('layouts.app')

@section('title', $recette->titre)

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <!-- En-tête avec image de fond et titre superposé -->
        <div class="relative">
            @if($recette->image)
                <div class="w-full h-96 bg-gray-100">
                    <img src="{{ asset('storage/' . $recette->image) }}" 
                         alt="{{ $recette->titre }}" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Dégradé pour assurer la lisibilité du texte -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-60"></div>
            @endif
            
            <!-- Titre et catégorie sur l'image -->
            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm mb-2 inline-block">
                    {{ $recette->categorie->nom }}
                </span>
                <h1 class="text-3xl font-bold">{{ $recette->titre }}</h1>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Description -->
            <div class="text-gray-700 mb-8 text-lg leading-relaxed">
                {{ $recette->description }}
            </div>
            
            <!-- Informations clés -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-indigo-50 p-4 rounded-lg text-center">
                    <p class="text-indigo-500 font-medium mb-1">Préparation</p>
                    <p class="text-xl font-bold text-gray-800">
                        @if($recette->temps_preparation)
                            @php
                                $heures = floor($recette->temps_preparation / 60);
                                $minutes = $recette->temps_preparation % 60;
                            @endphp
                            @if($heures > 0)
                                {{ $heures }}h{{ $minutes > 0 ? ' ' . $minutes . 'min' : '' }}
                            @else
                                {{ $minutes }}min
                            @endif
                        @else
                        Non renseignée
                        @endif
                    </p>
                </div>
                <div class="bg-indigo-50 p-4 rounded-lg text-center">
                    <p class="text-indigo-500 font-medium mb-1">Cuisson</p>
                    <p class="text-xl font-bold text-gray-800">
                        @if($recette->temps_cuisson)
                            @php
                                $heures = floor($recette->temps_cuisson / 60);
                                $minutes = $recette->temps_cuisson % 60;
                            @endphp
                            @if($heures > 0)
                                {{ $heures }}h{{ $minutes > 0 ? ' ' . $minutes . 'min' : '' }}
                            @else
                                {{ $minutes }}min
                            @endif
                        @else
                            Non renseignée
                        @endif
                    </p>
                </div>
                <div class="bg-indigo-50 p-4 rounded-lg text-center">
                    <p class="text-indigo-500 font-medium mb-1">Difficulté</p>
                    <p class="text-xl font-bold text-gray-800">{{ $recette->difficulte ?? 'Non renseignée' }}</p>
                </div>
            </div>
            
            <!-- Contenu principal en deux colonnes sur desktop -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Ingrédients -->
                <div>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-shopping-basket mr-2 text-indigo-500"></i> Ingrédients
                    </h2>
                    <div class="bg-gray-50 p-5 rounded-lg shadow-inner">
                        {!! nl2br(e($recette->ingredients)) !!}
                    </div>
                </div>
                
                <!-- Instructions -->
                <div>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-utensils mr-2 text-indigo-500"></i> Instructions
                    </h2>
                    <div class="bg-gray-50 p-5 rounded-lg shadow-inner">
                        {!! nl2br(e($recette->instructions)) !!}
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="mt-10 flex flex-wrap gap-4 border-t pt-6">
                <a href="{{ route('recettes.edit', $recette) }}" 
                   class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center">
                    <i class="fas fa-edit mr-2"></i> Modifier
                </a>
                <form action="{{ route('recettes.destroy', $recette) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="button" 
                        onclick="openModal('{{ route('recettes.destroy', $recette) }}')" 
                        class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center">
                        <i class="fas fa-trash-alt mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Recettes similaires -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-heart mr-2 text-indigo-500"></i> Recettes similaires
        </h2>
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