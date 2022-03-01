<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = app()['auth_user'];
        if ($user->role_id != User::ADMIN_ROLE_ID) {
            abort(403);
        }
        return $next($request);
    }
}
