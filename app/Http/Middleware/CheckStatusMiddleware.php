<?php

namespace App\Http\Middleware;

use Closure;

class CheckStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth_user();
        if(!$user->status){
          abort(401,'Your account now not activate');
        }
        return $next($request);
    }
}
