<a href="{{ route('recettes.show', $recette->slug) }}" class="block hover:shadow-lg transition duration-300">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($recette->image)
            <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->titre }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                Image non disponible
            </div>
        @endif
        
        <div class="p-4">
            <h3 class="text-lg font-semibold">{{ $recette->titre }}</h3>
            
            <p class="text-gray-600 mt-2">{{ Str::limit($recette->description, 100) }}</p>
            
            <div class="mt-4 flex justify-between items-center">
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $recette->categorie->nom }}</span>
                <span class="text-blue-600 hover:text-blue-800">Voir la recette</span>
            </div>
        </div>
    </div>
</a>