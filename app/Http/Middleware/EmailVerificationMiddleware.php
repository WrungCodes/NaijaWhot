<?php

namespace App\Http\Middleware;

use App\Helpers\Find;
use Closure;

class EmailVerificationMiddleware
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
        if (isset(Find::findAuthUser($request)->email_token)) {
            abort(HTTP_UNAUTHORIZED, "This Account is not verified");
        }
        return $next($request);
    }
}
