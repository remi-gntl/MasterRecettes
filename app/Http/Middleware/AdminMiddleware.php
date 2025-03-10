<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur n'est pas connecté ou n'est pas admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect()->route('home')
                ->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }
        
        return $next($request);
    }
}