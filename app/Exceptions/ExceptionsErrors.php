<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ExceptionsErrors
{
    public function HttpException(HttpException $exception)
    {
        return response()->json([
            'status' => $exception->getStatusCode(),
            'message' => $exception->getMessage(),
        ], $exception->getStatusCode());
    }

    public function CustomException($exception)
    {
        return response()->json([
            'status' => $exception->getStatusCode(),
            'message' => $exception->getMessage(),
            'data' => [],
        ], $exception->getStatusCode());
    }

    public function ValidationException(ValidationException $exception)
    {
        return response()->json([
            'status' =>  $exception->validator->status,
            'message' => 'Validation Error',
            'validationErrors' => $exception->validator->errors(),
        ],  $exception->validator->status);
    }

    public function NotFoundHttpException(NotFoundHttpException $exception)
    {
        return response()->json([
            'status' => $exception->getStatusCode(),
            'message' =>  $exception->getMessage(),
        ], $exception->getStatusCode());
    }

    public function UnauthorizedHttpException(UnauthorizedHttpException $exception)
    {
        return response()->json([
            'status' => $exception->getStatusCode(),
            'message' => $exception->getMessage(),
            'data' => [],
        ], $exception->getStatusCode());
    }

    public function MethodNotAllowedHttpException(MethodNotAllowedHttpException $exception)
    {
        return response()->json([
            'status' => $exception->getStatusCode(),
            'message' => $exception->getMessage(),
            'data' => [],
        ], $exception->getStatusCode());
    }
}
