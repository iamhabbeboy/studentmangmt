<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class RestrictAccess
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
        if (!session::has('student_data')) {
            return redirect('/');
        }
        return $next($request);
    }
}
