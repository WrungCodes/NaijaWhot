<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;

class EncryptResponse
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
        $response = $next($request);

        // $unencryptedData = $response->getData();

        // $encryptedData = Crypt::encryptString(json_encode($unencryptedData));

        // $response->setData($encryptedData);

        return $response;
    }

    private function undo($unencryptedData, $response)
    {
        $encryptedData = "eyJpdiI6IjZqVW14V2RNVWJQcWgzSzFcL3c2WElRPT0iLCJ2YWx1ZSI6IkFMVkFxa2FWbWYwQTV6N1VqdUJSTm10akNhWjF3eW42V01kWUlza1Bqb2ZEM05oXC96c09QQXV5b0xLcFd2aVlreDZDSDhTNEVJTk9cL2Y5XC9ydHNRb0hqemlXK3VXMUg1VWtJWXRLYXI0ZTlFPSIsIm1hYyI6IjBiOGQ4MzBjZGNiMjQ0MzAzOTlmMjYyZjVmMzU1OGUwY2M4ZjgxM2IzZDFlMzJiOTk3NWZlOTE2OThlNDM4ZDYifQ==";

        $response->setData(json_decode(Crypt::decryptString($encryptedData)));

        return  $response;
    }

    private function hashUrl($request)
    {
        $url = Crypt::decryptString($request->signature);

        $request->headers->set('X_REWRITE_URL', $url);

        return $request;
    }
}
