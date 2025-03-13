<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recette;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index() 
    {
        $user = Auth::user();
        $recettes = Recette::where('user_id', $user->id)
                            ->with('categorie')
                            ->latest()
                            ->paginate(6);

        return view ('profile.index', compact('user', 'recettes'));
    }

    public function edit() 
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'=>'required|string|max:50',
            'username'=>'required|string|max:50|unique:users,username,'.$user->id,
            'email'=>'required|string|max:75|unique:users,email,'.$user->id,
        ]);

        $user->update($validated);

        $success = 'Profil mis à jour avec succès';
        return redirect()->route('profile.index')->withSuccess($success);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'=> ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('Le mot de passe actuel est incorrect');
                }
            }],
            'password'=>['required','string','min:8','confirmed'],
        ]);

        auth()->user()->update([
            'password'=> Hash::make($request->password),
        ]);

        $success = ('Votre mot de passe a été modifié avec succès.');
        return redirect()->route('profile.edit')->withSuccess($success);
    }

    public function destroy(Request $request)
{
    $request->validate([
        'password' => ['required', function ($attribute, $value, $fail) {
            if (!Hash::check($value, auth()->user()->password)) {
                $fail('Le mot de passe est incorrect');
            }
        }],
    ]);

    $user = auth()->user();

    Auth::logout();
    $user->delete();

    return redirect('/')->with('success', 'Votre compte a été supprimé avec succès.');
}
}
