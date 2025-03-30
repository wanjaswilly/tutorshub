<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        # check if the user is admin
        if(Auth::user()->isAdmin())
        {
            return $next($request);
        }

        # redirect with error
        return redirect('home', 304)->with('error', 'You must be an admin to continue');
    }
}
