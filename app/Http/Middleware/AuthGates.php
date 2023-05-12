<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Closure;

class AuthGates
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
        $permissions = Auth::user()->permissions()->get();
        foreach ($permissions as $permission)
            Gate::define($permission->name, function () {
                return true;
            });
        }
        return $next($request);
    }
}

