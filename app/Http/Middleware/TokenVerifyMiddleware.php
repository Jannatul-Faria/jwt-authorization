<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use JWTToken;
use Symfony\Component\HttpFoundation\Response;

class TokenVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $result = JWTToken::decodeToken($token);
        if ($result == 'Unauthorized') {
            return redirect('/login');
        }else{
            $request->headers->set('email', $result->email);
            $request->headers->set('id', $result->id);
            return $next($request);
        }
        
    }
}