<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Répertoire de Recettes')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow sticky top-0">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">Master Recettes</a>
            
            <div class="space-x-4">
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
                <a href="{{ route('recettes.create') }}" class="text-gray-700 hover:text-indigo-600">Ajouter une recette</a>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">
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

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <p class="text-center">&copy; {{ date('Y') }} Master Recettes - By Rémi GENTIL</p>
        </div>
    </footer>
</body>
</html>