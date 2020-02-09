<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshToken
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
        $header = 'authorization';

        $prefix = 'Bearer';

        $token = '';

        if (!isset($request->header()[$header][0])) {
            throw new UnauthorizedHttpException('No Token passed'); //TODO Impliement Config Errors
        }

        $header = $request->header()[$header][0];

        if ($header && preg_match('/' . $prefix . '\s*(\S+)\b/i', $header, $matches)) {
            $token = $matches[1];
        }

        try {
            $request->merge(['refresh_token' => JWTAuth::parseToken()->refresh($token)]);
        } catch (JWTException $e) {
            throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());
        }

        return $next($request);
    }
}
