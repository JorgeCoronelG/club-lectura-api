<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param mixed ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws AuthenticationException
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            throw new AuthenticationException();
        }

        $existRole = false;

        foreach ($roles as $role) {
            foreach (auth()->user()->roles as $rol) {
                if ($rol->id === $role) {
                    $existRole = true;
                }
            }
        }

        if (!$existRole) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
