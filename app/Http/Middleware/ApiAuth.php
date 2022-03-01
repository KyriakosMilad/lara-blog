<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
use Throwable;

class ApiAuth
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
        $token = $request->bearerToken();

        if (!$token) {
            abort(400, "Bad request: no bearer token was found in the header");
        }

        try {
            $jwt = JWT::decode($token, new Key(env("APP_KEY"), 'HS256'));
            $data = (array)$jwt;
        } catch (Throwable $e) {
            abort(401, "Unauthorized: non-valid token was provided");
        }

        $user = User::whereEmail($data['email']);

        if (!$user) {
            abort(401, "Unauthorized: non-valid token was provided");
        }

        // register authenticated user in the container
        app()['auth_user'] = $user;

        return $next($request);
    }
}
