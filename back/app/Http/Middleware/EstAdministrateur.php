<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Joueurs et administrateurs partagent la table users : ce filtre réserve
 * l'interface d'administration aux seconds.
 */
class EstAdministrateur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            abort(403, "Accès réservé à l'administration.");
        }

        return $next($request);
    }
}
