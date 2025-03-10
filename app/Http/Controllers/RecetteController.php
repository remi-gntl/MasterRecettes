<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RecetteController extends Controller
{
    public function index()
    {
        $recettes = Recette::with('categorie')->latest()->paginate(12);
        return view('recettes.index', compact('recettes'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('recettes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'temps_preparation' => 'nullable|integer|min:0',
            'temps_cuisson' => 'nullable|integer|min:0',
            'portions' => 'nullable|integer|min:1',
            'difficulte' => 'nullable|string|in:Facile,Moyen,Difficile',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['titre']);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recettes', 'public');
            $validated['image'] = $imagePath;
        }

        Recette::create($validated);

        return redirect()->route('recettes.index')
            ->with('success', 'Recette créée avec succès');
    }

    public function show(Recette $recette)
    {
        return view('recettes.show', compact('recette'));
    }

    public function edit(Recette $recette)
    {
        $categories = Categorie::all();
        return view('recettes.edit', compact('recette', 'categories'));
    }

    public function update(Request $request, Recette $recette)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'temps_preparation' => 'nullable|integer|min:0',
            'temps_cuisson' => 'nullable|integer|min:0',
            'portions' => 'nullable|integer|min:1',
            'difficulte' => 'nullable|string|in:Facile,Moyen,Difficile',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['titre']);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($recette->image) {
                Storage::disk('public')->delete($recette->image);
            }
            
            $imagePath = $request->file('image')->store('recettes', 'public');
            $validated['image'] = $imagePath;
        }

        $recette->update($validated);

        return redirect()->route('recettes.show', $recette)
            ->with('success', 'Recette mise à jour avec succès');
    }

    public function destroy(Recette $recette)
    {
        // Supprimer l'image associée si elle existe
        if ($recette->image) {
            Storage::disk('public')->delete($recette->image);
        }
        
        $recette->delete();

        return redirect()->route('recettes.index')
            ->with('success', 'Recette supprimée avec succès');
    }
}