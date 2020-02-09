<?php

namespace App\Http\Middleware;

use App\Helpers\Find;
use App\UserType;
use Closure;

class AdminMiddleware
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
        $user_type_id = (Find::findAuthUser($request))->user_type_id;

        if ($user_type_id == UserType::ADMIN_USER || $user_type_id == UserType::SUPER_ADMIN_USER) {
            return $next($request);
        }
        abort(HTTP_UNAUTHORIZED, "Unautorized");
    }
}
