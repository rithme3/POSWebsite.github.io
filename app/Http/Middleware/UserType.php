<?php

namespace App\Http\Middleware;

use Closure;

class UserType
{
  
    public function handle($request, Closure $next)
    {
        if (\Auth::check() && \Auth::user()->user_type_id == 1) {
            return $next($request);
        } else {
            return redirect()->route('no_permission');
        }
    }
}
