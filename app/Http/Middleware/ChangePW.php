<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ChangePW
{

    public function handle($request, Closure $next)
    {
        // $user = Auth::user();
        // if ($user->force_pw_change) {
            // return redirect(route('user.password'));
        // } else {
            return $next($request);
        // }
    }
}
