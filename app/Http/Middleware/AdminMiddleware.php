<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Vérifier si l'utilisateur est administrateur
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Accès interdit. Réservé aux administrateurs.');
        }

        return $next($request);
    }
}