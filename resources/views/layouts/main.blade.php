<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titre ?? 'Bibliothèque de Recettes' }}</title>
    <meta name="description" content="{{ $description ?? 'Découvrez nos délicieuses recettes de cuisine' }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .category-card {
            transition: transform 0.3s;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .recipe-card {
            transition: transform 0.3s;
        }
        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-utensils me-2"></i>Recettes Gourmandes
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('recettes*') ? 'active' : '' }}" href="{{ route('recettes.index') }}">Recettes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Catégories</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('recettes.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Ajouter une recette
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="container mt-5 py-4 border-top">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; {{ date('Y') }} Bibliothèque de Recettes</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ url('/') }}" class="text-decoration-none">Accueil</a> |
                <a href="{{ route('recettes.index') }}" class="text-decoration-none">Recettes</a> |
                <a href="{{ route('categories.index') }}" class="text-decoration-none">Catégories</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>