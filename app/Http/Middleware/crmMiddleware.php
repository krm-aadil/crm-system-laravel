<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class crmMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role, ['crm', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
