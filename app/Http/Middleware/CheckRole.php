<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class CheckRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {
//         return $next($request);
//     }
// }





// App\Http\Middleware\CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // User is not authenticated, redirect to login
            return redirect('/login');
        }

        //$user = Auth::user();
        $user = $request->user();

        \Log::info('User Role: ' . $user->role);

        foreach ($roles as $role) {
            // Check if the user has the required role
            if ($user->role === $role) {
                return $next($request);
            }
        }

        // User does not have the required role, redirect to home
        return redirect('/login');
    }
}

