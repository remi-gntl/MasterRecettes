<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::with('recettes')->get();
        return view('home', compact('categories'));
    }

    public function show(Categorie $categorie)
    {
        $recettes = $categorie->recettes()->paginate(12);
        return view('categories.show', compact('categorie', 'recettes'));
    }

    public function create()
    {
        return back()->withError('Les catégories ne peuvent pas être modifiées');
    }
    
    public function store(Request $request)
    {
        return back()->withError('Les catégories ne peuvent pas être créées');
    }
    
    public function edit(Categorie $categorie)
    {
        return back()->withError('Les catégories ne peuvent pas être modifiées');
    }
    
    public function update(Request $request, Categorie $categorie)
    {
        return back()->withError('Les catégories ne peuvent pas être modifiées');
    }
    
    public function destroy(Categorie $categorie)
    {
        return back()->withError('Les catégories ne peuvent pas être supprimées');
    }
}