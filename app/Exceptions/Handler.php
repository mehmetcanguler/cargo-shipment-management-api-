<?php

namespace App\Exceptions;

use App\Support\Helpers\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler
{
    public static function handle(Request $request, Throwable $exception)
    {
        return match (true) {
            $exception instanceof AuthenticationException => ApiResponse::error('Unauthenticated.', 401),

            $exception instanceof AuthorizationException => ApiResponse::error('Unauthorized.', 403),

            $exception instanceof BadRequestException => ApiResponse::error($exception->getMessage(), 400),

            $exception instanceof MethodNotAllowedHttpException => ApiResponse::error('Method Not Allowed.', 405),

            $exception instanceof ModelNotFoundException => ApiResponse::error('Item not found.', 404),

            $exception instanceof NotFoundHttpException => ApiResponse::error('Not Found.', 404),

            $exception instanceof ValidationException => ApiResponse::error($exception->getMessage(), 422, $exception->errors()),

            default => ApiResponse::error(
                config('app.debug') ? $exception->getMessage() : 'Internal Server Error.',
                500,
                config('app.debug') ? $exception->getTrace() : null
            ),
        };
    }
}
