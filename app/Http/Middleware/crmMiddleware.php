<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class crmMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role, ['crm', 'admin','user'])) {
            redirect()->route('login');
        }

        return $next($request);
    }
}
