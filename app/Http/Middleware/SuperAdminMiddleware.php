<?php

namespace App\Http\Middleware;

use App\Helpers\Find;
use App\UserType;
use Closure;

class SuperAdminMiddleware
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
        if ((Find::findAuthUser($request))->user_type_id != UserType::SUPER_ADMIN_USER) {
            abort(HTTP_UNAUTHORIZED, "Unautorized");
        }

        return $next($request);
    }
}
