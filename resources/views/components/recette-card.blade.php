<a href="{{ route('recettes.show', $recette->slug) }}" class="block bg-white rounded-lg shadow-md overflow-hidden shadow-hover group">
    <div class="relative overflow-hidden">
        @if($recette->image)
            <img src="{{ asset('storage/' . $recette->image) }}" 
                 alt="{{ $recette->titre }}" 
                 class="w-full h-48 object-cover zoom-image">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">Image non disponible</span>
            </div>
        @endif
        <div class="absolute bottom-0 left-0 right-0 p-3 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <span class="bg-indigo-600 text-white text-xs font-medium px-2 py-1 rounded">{{ $recette->categorie->nom }}</span>
            @if($recette->difficulte)
                <span class="bg-gray-700 text-white text-xs font-medium px-2 py-1 rounded ml-1">{{ $recette->difficulte }}</span>
            @endif
        </div>
    </div>
    <div class="p-4">
        <h3 class="text-xl font-semibold mb-2">{{ $recette->titre }}</h3>
        <p class="text-gray-600 mb-2">{{ Str::limit($recette->description, 80) }}</p>
        
        <p class="text-sm text-gray-500 mb-2">
            <i class="fa-solid fa-user mr-1"></i>
            Par {{ $recette->user ? $recette->user->name : 'Inconnu' }}
        </p>

        <div class="card-hover-info">
            @if($recette->temps_preparation || $recette->temps_cuisson)
                <div class="flex flex-wrap gap-2 text-sm text-gray-500">
                    @if($recette->temps_preparation)
                        <span class="flex items-center">
                            <i class="fa-solid fa-clock mr-1"></i>
                            Préparation: 
                            @php
                                $heures = floor($recette->temps_preparation / 60);
                                $minutes = $recette->temps_preparation % 60;
                            @endphp
                            @if($heures > 0)
                                {{ $heures }}h{{ $minutes > 0 ? ' ' . $minutes . 'min' : '' }}
                            @else
                                {{ $minutes }}min
                            @endif
                        </span>
                    @endif
                    @if($recette->temps_cuisson)
                        <span class="flex items-center">
                            <i class="fa-solid fa-fire mr-1"></i>
                            Cuisson: 
                            @php
                                $heures = floor($recette->temps_cuisson / 60);
                                $minutes = $recette->temps_cuisson % 60;
                            @endphp
                            @if($heures > 0)
                                {{ $heures }}h{{ $minutes > 0 ? ' ' . $minutes . 'min' : '' }}
                            @else
                                {{ $minutes }}min
                            @endif
                        </span>
                    @endif
                </div>
            @endif
        </div>
        
        <div class="mt-3 flex justify-between items-center">
            <span class="text-sm text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Voir la recette</span>
            <span class="text-indigo-600 arrow-icon">→</span>
        </div>
    </div>
</a>