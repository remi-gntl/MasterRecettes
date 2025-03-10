<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-yellow-600">
                        🍳 Vos Recettes
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('/') ? 'border-yellow-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                        Accueil
                    </a>
                    <div class="relative group">
                        <button class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('categories*') ? 'border-yellow-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            Catégories
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block z-10">
                            <div class="py-1">
                                @php
                                    $categories = \App\Models\Categorie::all();
                                @endphp
                                @foreach($categories as $categorie)
                                    <a href="{{ route('categories.show', $categorie) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ $categorie->nom }}
                                    </a>
                                @endforeach
                                <div class="border-t border-gray-100"></div>
                                <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Toutes les catégories
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('recettes.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('recettes*') && !request()->is('recettes/create') ? 'border-yellow-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                        Recettes
                    </a>
                    <a href="{{ route('recettes.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('recettes/create') ? 'border-yellow-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                        Ajouter une recette
                    </a>
                    <a href="{{ route('categories.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('categories/create') ? 'border-yellow-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                        Ajouter une catégorie
                    </a>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100" aria-expanded="false">
                    <span class="sr-only">Ouvrir le menu principal</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu hidden sm:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'bg-yellow-50 text-yellow-600' : 'text-gray-700 hover:bg-gray-50' }}">
                Accueil
            </a>
            
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium {{ request()->is('categories*') ? 'bg-yellow-50 text-yellow-600' : 'text-gray-700 hover:bg-gray-50' }}">
                    Catégories
                    <svg class="inline-block ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="pl-4 pb-2">
                    @php
                        $categories = \App\Models\Categorie::all();
                    @endphp
                    @foreach($categories as $categorie)
                        <a href="{{ route('categories.show', $categorie) }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-yellow-600">
                            {{ $categorie->nom }}
                        </a>
                    @endforeach
                    <a href="{{ route('categories.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-yellow-600">
                        Toutes les catégories
                    </a>
                </div>
            </div>
            
            <a href="{{ route('recettes.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('recettes*') && !request()->is('recettes/create') ? 'bg-yellow-50 text-yellow-600' : 'text-gray-700 hover:bg-gray-50' }}">
                Recettes
            </a>
            <a href="{{ route('recettes.create') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('recettes/create') ? 'bg-yellow-50 text-yellow-600' : 'text-gray-700 hover:bg-gray-50' }}">
                Ajouter une recette
            </a>
            <a href="{{ route('categories.create') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('categories/create') ? 'bg-yellow-50 text-yellow-600' : 'text-gray-700 hover:bg-gray-50' }}">
                Ajouter une catégorie
            </a>
        </div>
    </div>
</nav>

<script>
    // JavaScript pour le menu mobile
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>