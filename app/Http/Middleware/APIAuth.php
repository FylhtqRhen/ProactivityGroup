<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class APIAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $token = $request->headers->get('Authorization');
        try {
            User::authoriseByToken($token);
        } catch (\Throwable $authenticationException) {
            throw new ApiException('Ошибка авторизации', 402);
        }
        return $next($request);
    }
}
