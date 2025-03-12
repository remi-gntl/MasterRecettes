@extends('layouts.app')

@section('title', 'Ajouter une recette')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Ajouter une nouvelle recette</h1>
        
        <form action="{{ route('recettes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="titre" class="block text-gray-700 font-medium mb-2">Titre</label>
                <input type="text" name="titre" id="titre" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       value="{{ old('titre') }}" required>
                @error('titre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Temps de préparation</label>
                    <div class="flex space-x-2">
                        <div class="w-1/2">
                            <input type="number" name="temps_preparation_heures" id="temps_preparation_heures" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                   value="{{ old('temps_preparation_heures', $recette->temps_preparation_heures ?? 0) }}" min="0" placeholder="Heures">
                            <label for="temps_preparation_heures" class="text-sm text-gray-500">Heures</label>
                        </div>
                        <div class="w-1/2">
                            <input type="number" name="temps_preparation_minutes" id="temps_preparation_minutes" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                   value="{{ old('temps_preparation_minutes', $recette->temps_preparation_minutes ?? 0) }}" min="0" max="59" placeholder="Minutes">
                            <label for="temps_preparation_minutes" class="text-sm text-gray-500">Minutes</label>
                        </div>
                    </div>
                    @error('temps_preparation_heures')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('temps_preparation_minutes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Temps de cuisson</label>
                    <div class="flex space-x-2">
                        <div class="w-1/2">
                            <input type="number" name="temps_cuisson_heures" id="temps_cuisson_heures" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                   value="{{ old('temps_cuisson_heures', $recette->temps_cuisson_heures ?? 0) }}" min="0" placeholder="Heures">
                            <label for="temps_cuisson_heures" class="text-sm text-gray-500">Heures</label>
                        </div>
                        <div class="w-1/2">
                            <input type="number" name="temps_cuisson_minutes" id="temps_cuisson_minutes" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                   value="{{ old('temps_cuisson_minutes', $recette->temps_cuisson_minutes ?? 0) }}" min="0" max="59" placeholder="Minutes">
                            <label for="temps_cuisson_minutes" class="text-sm text-gray-500">Minutes</label>
                        </div>
                    </div>
                    @error('temps_cuisson_heures')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('temps_cuisson_minutes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="portions" class="block text-gray-700 font-medium mb-2">Nombre de portions</label>
                    <input type="number" name="portions" id="portions" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           value="{{ old('portions') }}" min="1">
                    @error('portions')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="difficulte" class="block text-gray-700 font-medium mb-2">Difficulté</label>
                    <select name="difficulte" id="difficulte" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Sélectionner</option>
                        <option value="Facile" {{ old('difficulte') == 'Facile' ? 'selected' : '' }}>Facile</option>
                        <option value="Moyen" {{ old('difficulte') == 'Moyen' ? 'selected' : '' }}>Moyen</option>
                        <option value="Difficile" {{ old('difficulte') == 'Difficile' ? 'selected' : '' }}>Difficile</option>
                    </select>
                    @error('difficulte')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <label for="categorie_id" class="block text-gray-700 font-medium mb-2">Catégorie</label>
                <select name="categorie_id" id="categorie_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach(App\Models\Categorie::all() as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="ingredients" class="block text-gray-700 font-medium mb-2">Ingrédients (un par ligne)</label>
                <textarea name="ingredients" id="ingredients" rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>{{ old('ingredients') }}</textarea>
                @error('ingredients')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="instructions" class="block text-gray-700 font-medium mb-2">Instructions</label>
                <textarea name="instructions" id="instructions" rows="8"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>{{ old('instructions') }}</textarea>
                @error('instructions')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Image</label>
                <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="updateFileName(this)">
                
                <label for="image" class="px-4 py-2 bg-indigo-600 text-white rounded-md cursor-pointer hover:bg-indigo-700 inline-block">
                    Choisir une image
                </label>
                
                <span id="file-name" class="ml-2 text-gray-600"></span>
            
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('recettes.index') }}" 
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">
                    Annuler
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Créer la recette
                </button>
            </div>
        </form>
    </div>

    <script>
    function updateFileName(input) {
        const fileName = input.files.length > 0 ? input.files[0].name : "Aucun fichier sélectionné";
        document.getElementById("file-name").textContent = fileName;
    }
    </script>
@endsection