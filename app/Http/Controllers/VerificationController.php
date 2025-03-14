<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($id, $token)
    {
        $user = User::findOrFail($id);

        if($user->verification_token !== $token) {
            return redirect()->route('home')->with('error','Le lien de vérification est invalide.');
        }

        $user->email_verified = true;
        $user->verification_token = null;
        $user->save();

        return redirect()->route('home')->with('success', 'Votre adresse e-mail a été vérifiée avec succès.');
    }
}
