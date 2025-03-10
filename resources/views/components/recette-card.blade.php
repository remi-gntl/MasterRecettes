<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
    @if($recette->image)
        <img src="{{ asset('storage/' . $recette->image) }}" 
             alt="{{ $recette->titre }}" 
             class="w-full h-48 object-cover">
    @else
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-400">Pas d'image</span>
        </div>
    @endif
    <div class="p-4">
        <h3 class="text-xl font-semibold mb-2">{{ $recette->titre }}</h3>
        <p class="text-gray-600 mb-2">{{ Str::limit($recette->description, 100) }}</p>
        <div class="flex justify-between items-center">
            <span class="text-sm text-indigo-600">{{ $recette->categorie->nom }}</span>
            <a href="{{ route('recettes.show', $recette) }}" 
               class="text-indigo-600 hover:text-indigo-800">Voir la recette</a>
        </div>
    </div>
</div>