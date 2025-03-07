<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recettes = Recette::with('categorie')->latest()->paginate(8);
        $data = [
            'titre' => 'Recettes',
            'description' => 'Liste de toutes les recettes',
            'recettes' => $recettes
        ];
        return view('recette.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        $data = [
            'titre' => 'Ajouter une recette',
            'description' => 'Créer une nouvelle recette',
            'categories' => $categories
        ];
        return view('recette.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:75',
            'categorie_id' => 'required|exists:categories,id',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'temps_preparation' => 'nullable|integer|min:0',
            'temps_cuisson' => 'nullable|integer|min:0',
            'portions' => 'nullable|integer',
            'difficulte' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',    
        ]);

        $recette = new Recette();
        $recette->titre = $request->titre;
        $recette->slug = Str::slug($request->titre);
        $recette->categorie_id = $request->categorie_id;
        $recette->ingredients = $request->ingredients;
        $recette->instructions = $request->instructions;
        $recette->temps_preparation = $request->temps_preparation;
        $recette->temps_cuisson = $request->temps_cuisson;
        $recette->portions = $request->portions;
        $recette->difficulte = $request->difficulte;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('recettes',$filename, 'public');
            $recette->image = $path;
        }

        $recette->save();
        
        $success = 'Recette créée avec succès.';
        return redirect()->route('recette.store')->withSuccess($success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recette $recette)
    {
        $data = [
            'titre' => $recette->titre,
            'description' => 'Détail de la recette ' . $recette->titre,
            'recette' => $recette
        ];
        return view('recettes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recette $recette)
    {
        $categories = Categorie::all();
        $data = [
            'titre' => 'Modifier la recette',
            'description' => 'Modifier la recette ' . $recette->titre,
            'recette' => $recette,
            'categories' => $categories
        ];
        return view('recettes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recette $recette)
    {
        $request->validate([
            'titre' => 'required|string|max:75',
            'categorie_id' => 'required|exists:categories,id',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'temps_preparation' => 'nullable|integer|min:0',
            'temps_cuisson' => 'nullable|integer|min:0',
            'portions' => 'nullable|integer',
            'difficulte' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $recette->titre = $request->titre;
        $recette->slug = Str::slug($request->titre);
        $recette->categorie_id = $request->categorie_id;
        $recette->ingredients = $request->ingredients;
        $recette->instructions = $request->instructions;
        $recette->temps_preparation = $request->temps_preparation;
        $recette->temps_cuisson = $request->temps_cuisson;
        $recette->portions = $request->portions;
        $recette->difficulte = $request->difficulte;

        if ($request->hasFile('image')) {
            // suppr l'ancienne image si elle existe
            if ($recette->image) {
                Storage::disk('public')->delete($recette->image);
            }
            
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('recettes', $filename, 'public');
            $recette->image = $path;
        }

        $recette->save();

        $success = 'Recette mise à jour avec succès.';
        return redirect()->route('recettes.index')->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recette $recette)
    {
        if ($recette->image) {
            Storage::disk('public')->delete($recette->image);
        }
        
        $recette->delete();

        $success = 'Recette supprimée avec succès.';
        return redirect()->route('recettes.index')->withSuccess($success);
    }
}
