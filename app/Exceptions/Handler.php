<?php

namespace App\Exceptions;

use App\Exceptions\HandleError;
use App\Exceptions\HandleErrors;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        Log::error($exception);

        if ($exception instanceof ValidationException) {
            return $this->invalidJson($request, $exception);
        }

        if ($exception instanceof TokenExpiredException) {
            return response()->json([
                'status' => CODE_BLACKLISTED_USER,
                'message' => "Token Expired",
                'error' => $exception->getMessage(),
            ], CODE_BLACKLISTED_USER);
        }

        if ($exception instanceof TokenInvalidException) {
            return response()->json([
                'status' => HTTP_UNAUTHORIZED,
                'message' => "Invalid Token",
                'error' => $exception->getMessage(),
            ], HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof JWTException) {
            return response()->json([
                'status' => HTTP_EXPECTATION_FAILED,
                'message' => "No Token Provided",
                'error' => $exception->getMessage(),
            ], HTTP_EXPECTATION_FAILED);
        }

        try {
            return (new HandleError($exception))->execute();
        } catch (\Throwable $th) {
            return parent::render($request, $exception);
        }

        // if (!empty($exception->getMessage())) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => "server error",
        //         'error' => $exception->getMessage(),
        //     ], 500);
        // }

        return parent::render($request, $exception);
    }
}
