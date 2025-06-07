<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // Primero validar si está autenticado
        if (!Auth::check()) {
            return redirect('login');
        }

        // Luego validar si es admin
        if (!Auth::user()->admin) {
            // Aquí puedes redirigir o abortar con código 403
            return redirect('/login')->with('error', 'No tienes permisos para acceder a esta sección');
            // O
            // abort(403, 'No autorizado');
        }

        return $next($request);
    }
}
