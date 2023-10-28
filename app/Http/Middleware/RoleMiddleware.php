<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
          // Vérifie si l'utilisateur est authentifié
          if (auth()->check()) {
            // Vérifie si le rôle de l'utilisateur fait partie des rôles autorisés pour cette route
            $userRole = auth()->user()->role->name;
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        // Redirige l'utilisateur vers une page d'erreur ou une autre page appropriée en cas d'accès non autorisé
        return redirect('/login'); 
    }
}
