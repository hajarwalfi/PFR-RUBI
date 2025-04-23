<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    public function handle(Request $request, Closure $next, string $role, ?string $condition = null): Response
    {
        $user = $request->user();

        if (!$user || !$user->hasRole($role)) {
            abort(403, 'Unauthorized action.');
        }

        if ($condition === 'admin' && $user->id !== 1) {
            abort(403, 'Unauthorized. Only the main administrator can access this area.');
        }

        return $next($request);
    }
}
