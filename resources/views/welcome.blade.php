@extends('layouts.main')

@section('content')
    <!-- Bannière / Hero section -->
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">{{ $titre }}</h1>
            <p class="col-md-8 fs-4">{{ $description }}</p>
            <a href="{{ route('recettes.index') }}" class="btn btn-primary btn-lg">Voir toutes les recettes</a>
        </div>
    </div>

    <!-- Section des catégories -->
    <section class="mb-5">
        <h2 class="mb-4">Catégories de recettes</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($categories as $categorie)
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $categorie->nom }}</h3>
                            <p class="card-text">{{ $categorie->description ?? 'Découvrez toutes les recettes de cette catégorie.' }}</p>
                            <div class="text-end">
                                <a href="{{ route('categories.show', $categorie) }}" class="btn btn-outline-primary">Voir les recettes</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Aucune catégorie n'a été créée pour le moment.
                        <a href="{{ route('categories.create') }}" class="alert-link">Créer une catégorie</a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Section des recettes récentes -->
    @if(isset($recettesRecentes) && $recettesRecentes->count() > 0)
        <section class="mb-5">
            <h2 class="mb-4">Recettes récentes</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($recettesRecentes as $recette)
                    <div class="col">
                        <div class="card h-100 recipe-card">
                            @if($recette->image)
                                <img src="{{ asset('storage/' . $recette->image) }}" class="card-img-top" alt="{{ $recette->titre }}">
                            @else
                                <div class="bg-secondary text-white d-flex justify-content-center align-items-center card-img-top">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $recette->titre }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-folder me-1"></i>{{ $recette->categorie->nom }}
                                    </small>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($recette->temps_preparation)
                                            <small title="Temps de préparation"><i class="fas fa-clock me-1"></i>{{ $recette->temps_preparation }} min</small>
                                        @endif
                                    </div>
                                    <a href="{{ route('recettes.show', $recette) }}" class="btn btn-sm btn-primary">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('recettes.index') }}" class="btn btn-outline-primary">Voir toutes les recettes</a>
            </div>
        </section>
    @endif

    <!-- Appel à l'action -->
    <section class="text-center p-5 bg-light rounded-3">
        <h2>Vous avez une recette à partager ?</h2>
        <p class="lead">Contribuez à notre bibliothèque en ajoutant vos propres créations culinaires.</p>
        <a href="{{ route('recettes.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle me-2"></i>Ajouter une recette
        </a>
    </section>
@endsection