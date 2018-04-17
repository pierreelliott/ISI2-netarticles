<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Autorisation
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
        // Pas réussi à mettre en place la redirection pour la connexion
        // Il vaudrait mieux utiliser le système de connexion intégré à Laravel
        $redirect = str_replace("/public/", "", $request->getRequestUri());
        // ===============================
        if (Session::get('id') == 0) {
            return redirect('/getLogin?from='.$redirect);
        }

        return $next($request);
    }
}
