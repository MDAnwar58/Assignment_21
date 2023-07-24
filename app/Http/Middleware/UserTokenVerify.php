<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTokenVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $checkToken = JWTToken::verifyToken($token);
        if ($checkToken == "Unauthenticated") {
            return redirect('/login');
        } else {
            $request->headers->set('email', $checkToken);
            return $next($request);
        }
    }
}
