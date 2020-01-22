<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Auth;
class JobPostMiddleware
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
        $user = $request->user();
        if($user->membership_expired < Carbon::now() || $user->remaining_job <=0){
            return redirect()->guest(route('employer.plan'));
        }
        return $next($request);
    }
}
