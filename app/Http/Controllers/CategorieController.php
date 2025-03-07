<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        $data = [
            'titre'=> 'Catégories de recettes',
            'description'=>'Liste de toutes les catégories de recettes',
            'categories'=>$categories
        ];
        
        if (request()->is('/')) {
            return view('welcome', $data); // Vue de la page d'accueil
        }
        
        // Sinon, c'est l'index normal des catégories
        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Ajouter une catégorie',
            'description' => 'Créer une nouvelle catégorie de recettes'
        ];
        return view('categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required|string|max:20',
            'description'=>'nullable|string',
        ]);

        $categorie = new Categorie();
        $categorie->nom = $request->nom;
        $categorie->slug = Str::slug($request->nom);
        $categorie->description = $request->description;
        $categorie->save();

        $success = 'Catégorie créée avec succès.';
        return redirect()->route('categories.index')->withSuccess($success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        $recettes = $categorie->recettes()->latest()->paginate(6);
        $data = [
            'titre' => $categorie->nom,
            'description' => 'Recettes de la catégorie ' . $categorie->nom,
            'categorie' => $categorie,
            'recettes' => $recettes
        ];
        return view('categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        $data = [
            'titre'=> 'Modifier la catégorie',
            'description' => 'Modifier la catégorie' . $categorie->nom,
            'categorie'=> $categorie
        ];
        return view ('categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $categorie->nom = $request->nom;
        $categorie->slug = Str::slug($request->nom);
        $categorie->description = $request->description;
        $categorie->save();

        $success = 'Catégorie mise à jour avec succès.';
        return redirect()->route('categories.index')->withSuccess($success);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        $success = 'Catégorie supprimée avec succès.';
        return redirect()->route('categories.index')->withSuccess($success);
    }
}
