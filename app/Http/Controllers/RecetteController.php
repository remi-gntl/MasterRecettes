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

    // //fonction de recherche (searchbar dans navbar) (recherche traditionnelle qui recharge toute la page)
    // public function search(Request $request)
    // {
    //     $query = $request->input('search');

    //     // Si la recherche est vide, redirigez vers la liste des recettes
    //     if (empty($query)) {
    //         return back();
    //     }

    //     $recettes = Recette::where('titre', 'ILIKE', "%{$query}%")
    //         ->orWhere('description', 'ILIKE', "%{$query}%")
    //         ->with('categorie')
    //         ->paginate(12);

    //     return view('recettes.index', compact('recettes', 'search'));
    // }
//a mettre si on fait une recherche qui redirige sur une page et pas dynamique


    //Une recherche AJAX qui renvoie seulement des données JSON
    public function apiSearch(Request $request)
    {
        $query = $request->input('query');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $recettes = Recette::where('titre', 'ILIKE', "%{$query}%")
            ->orWhere('description', 'ILIKE', "%{$query}%")
            ->with('categorie')
            ->limit(6)
            ->get();

        return response()->json($recettes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'temps_preparation_heures' => 'nullable|integer|min:0',
            'temps_preparation_minutes' => 'nullable|integer|min:0|max:59',
            'temps_cuisson_heures' => 'nullable|integer|min:0',
            'temps_cuisson_minutes' => 'nullable|integer|min:0|max:59',
            'portions' => 'nullable|integer|min:1',
            'difficulte' => 'nullable|string|in:Facile,Moyen,Difficile',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $temps_preparation = 0;
        if ($request->filled('temps_preparation_heures')) {
            $temps_preparation += $request->temps_preparation_heures * 60;
        }
        if ($request->filled('temps_preparation_minutes')) {
            $temps_preparation += $request->temps_preparation_minutes;
        }
        $validated['temps_preparation'] = $temps_preparation > 0 ? $temps_preparation : null;

        $temps_cuisson = 0;
        if ($request->filled('temps_cuisson_heures')) {
            $temps_cuisson += $request->temps_cuisson_heures * 60;
        }
        if ($request->filled('temps_cuisson_minutes')) {
            $temps_cuisson += $request->temps_cuisson_minutes;
        }
        $validated['temps_cuisson'] = $temps_cuisson > 0 ? $temps_cuisson : null;


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
            'temps_preparation_heures' => 'nullable|integer|min:0',
            'temps_preparation_minutes' => 'nullable|integer|min:0|max:59',
            'temps_cuisson_heures' => 'nullable|integer|min:0',
            'temps_cuisson_minutes' => 'nullable|integer|min:0|max:59',
            'portions' => 'nullable|integer|min:1',
            'difficulte' => 'nullable|string|in:Facile,Moyen,Difficile',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $temps_preparation = 0;
        if ($request->filled('temps_preparation_heures')) {
            $temps_preparation += $request->temps_preparation_heures * 60;
        }
        if ($request->filled('temps_preparation_minutes')) {
            $temps_preparation += $request->temps_preparation_minutes;
        }
        $validated['temps_preparation'] = $temps_preparation > 0 ? $temps_preparation : null;

        $temps_cuisson = 0;
        if ($request->filled('temps_cuisson_heures')) {
            $temps_cuisson += $request->temps_cuisson_heures * 60;
        }
        if ($request->filled('temps_cuisson_minutes')) {
            $temps_cuisson += $request->temps_cuisson_minutes;
        }
        $validated['temps_cuisson'] = $temps_cuisson > 0 ? $temps_cuisson : null;



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
