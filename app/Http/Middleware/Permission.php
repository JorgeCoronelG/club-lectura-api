<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next, ...$rolIds): Response
    {
        $rolId = auth()->user()->rol_id;

        if (!in_array($rolId, $rolIds)) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
