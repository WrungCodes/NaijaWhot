<?php

namespace App\Exceptions;

use App\Exceptions\ExceptionsErrors;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class HandleError
{

    protected $execption;

    public function __construct(Exception $exception)
    {
        $this->execption = $exception;
    }

    public function execute()
    {
        return $this->GetExceptionInstance($this->execption);
    }

    private function GetExceptionInstance(Exception $exception)
    {
        $exceptionErrors = new ExceptionsErrors();

        switch ($exception) {
            case $exception instanceof ValidationException:
                return $exceptionErrors->ValidationException($exception);

            case $exception instanceof NotFoundHttpException:
                return $exceptionErrors->NotFoundHttpException($exception);

            case $exception instanceof UnauthorizedHttpException:
                return $exceptionErrors->UnauthorizedHttpException($exception);

            case $exception instanceof MethodNotAllowedHttpException:
                return $exceptionErrors->MethodNotAllowedHttpException($exception);

            case $exception instanceof HttpException:
                return $exceptionErrors->HttpException($exception);

            default:
                return $exceptionErrors->CustomException($exception);
        }
    }
}
