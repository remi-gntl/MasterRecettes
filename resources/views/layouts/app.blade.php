<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>@yield('title', 'Répertoire de Recettes')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-white shadow sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">Master Recettes</a>
        
            <div class="space-x-4">
                <div class="relative inline-block">
                    <div class="relative">
                        <input type="text" id="search-input" name="query" placeholder="Rechercher une recette..." 
                               class="px-3 py-1 pr-8 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        <i class="fas fa-search absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    </div>
                    <div id="search-results" class="absolute z-10 mt-1 w-64 bg-white shadow-lg rounded-md hidden"></div>
                </div>
        
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">Accueil</a>
                <div class="relative inline-block text-left group">
                    <button class="text-gray-700 hover:text-indigo-600">
                        Catégories
                    </button>
                    <div class="hidden group-hover:block absolute z-10 mt-0 w-48 rounded-md shadow-lg bg-white">
                        <div class="py-1">
                            @foreach(App\Models\Categorie::all() as $cat)
                                <a href="{{ route('categories.show', $cat) }}" 
                                   class="block px-4 py-2 text-gray-700 hover:bg-indigo-100">
                                    {{ $cat->nom }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="{{ route('recettes.index') }}" class="text-gray-700 hover:text-indigo-600">Toutes les recettes</a>
                
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Connexion</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600">Inscription</a>
                @else
                    <a href="{{ route('recettes.create') }}" class="text-gray-700 hover:text-indigo-600">Ajouter une recette</a>
                    
                    <div class="relative inline-block text-left group">
                        <button class="text-gray-700 hover:text-indigo-600">
                            {{ Auth::user()->username ?? Auth::user()->name }} <i class="fas fa-chevron-down text-xs ml-1"></i>
                        </button>
                        <div class="hidden group-hover:block absolute z-10 mt-0 w-48 rounded-md shadow-lg bg-white right-0">
                            <div class="py-1">
                                @if(Auth::user()->isAdmin())
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100">
                                        Administration
                                    </a>
                                @endif

                                @auth
                                    <a href="{{ route('profile.index') }}" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-indigo-100">Mon profil</a>
                                @endauth

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-indigo-100">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-auto">
        <div class="container mx-auto px-4">
            <p class="text-center">&copy; {{ date('Y') }} Master Recettes - By Rémi GENTIL</p>
        </div>
    </footer>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        if (query.length < 2) {
            searchResults.innerHTML = '';
            searchResults.classList.add('hidden');
            return;
        }
        
        // Faire une requête AJAX pour chercher les recettes
        fetch(`/api/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';
                searchResults.classList.remove('hidden');
                
                if (data.length === 0) {
                    searchResults.innerHTML = '<div class="p-3 text-gray-500">Aucun résultat trouvé</div>';
                    return;
                }
                
                data.forEach(recette => {
                    const resultItem = document.createElement('a');
                    resultItem.href = `/recettes/${recette.slug}`;
                    resultItem.className = 'block p-3 hover:bg-gray-100 border-b last:border-b-0';
                    
                    let imageHtml = '';
                    if (recette.image) {
                        imageHtml = `<img src="/storage/${recette.image}" alt="${recette.titre}" class="w-10 h-10 object-cover rounded mr-2">`;
                    }
                    
                    resultItem.innerHTML = `
                        <div class="flex items-center">
                            ${imageHtml}
                            <div>
                                <div class="font-medium">${recette.titre}</div>
                                <div class="text-xs text-gray-500">${recette.categorie.nom}</div>
                            </div>
                        </div>
                    `;
                    
                    searchResults.appendChild(resultItem);
                });
                
                // Ajouter un lien "Voir tous les résultats" si nécessaire
                if (data.length > 5) {
                    const viewAllLink = document.createElement('a');
                    viewAllLink.href = `/recettes/search?query=${encodeURIComponent(query)}`;
                    viewAllLink.className = 'block p-3 text-center text-indigo-600 hover:bg-gray-100 font-medium';
                    viewAllLink.textContent = 'Voir tous les résultats';
                    searchResults.appendChild(viewAllLink);
                }
            });
    });
    
    // Cacher les résultats quand on clique en dehors
    document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.classList.add('hidden');
        }
    });
});
</script>
@endpush
@stack('scripts')
</body>
</html>