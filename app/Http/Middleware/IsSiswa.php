<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSiswa
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
        if (auth()->user()->peran == 2) {
            return $next($request);
        }

        return redirect('home')->with('error', "You don't have admin access.");
    }
}
