<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titre ?? 'Livre de Recettes' }}</title>
    <meta name="description" content="{{ $description ?? 'Votre livre de recettes en ligne' }}">
    
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    
    <!-- Styles personnalisés -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    @include('components.navbar')
    
    <!-- Messages de notification -->
    @if(session('success'))
        <div class="container mx-auto px-4 py-3">
            @include('components.alert', [
                'type' => 'success',
                'message' => session('success')
            ])
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-4 py-3">
            @include('components.alert', [
                'type' => 'error',
                'message' => session('error')
            ])
        </div>
    @endif
    
    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-8 flex-grow">
        @if(isset($titre) && !request()->is('/'))
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">{{ $titre }}</h1>
                @if(isset($description))
                    <p class="text-gray-600 mt-2">{{ $description }}</p>
                @endif
            </div>
        @endif
        
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Scripts -->
    @vite('resources/js/app.js')
</body>
</html>