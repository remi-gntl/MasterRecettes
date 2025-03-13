<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recette;
use App\Models\Categorie;
use GrahamCampbell\ResultType\Success;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Statistiques de base pour le dashboard
        $stats = [
            'users_count' => User::count(),
            'recettes_count' => Recette::count(),
            'categories_count' => Categorie::count(),
        ];
        
        // Récupération des derniers utilisateurs (sans pagination pour commencer)
        $recent_users = User::latest()->take(5)->get();
        
        // Récupération des dernières recettes avec une protection contre les relations null
        $recent_recettes = Recette::with('categorie')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_recettes'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }


    public function toggleAdmin(User $user)
    {
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', $user->is_admin ? "L'utilisateur {$user->name} est maintenant administrateur" :
                                                            "Les droits d'administrateur ont été retirés à {$user->name}.");
    }

    public function destroyUser(User $user)
    {
        if(auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "L'utilisateur {$user->name} à été supprimé.");
    }
}