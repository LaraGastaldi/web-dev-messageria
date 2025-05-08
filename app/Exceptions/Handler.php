<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            if ($e->getCode() == 401) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }
            if ($e->getCode() == 403) {
                return response()->json([
                    'message' => 'Forbidden',
                ], 403);
            }
            if ($e->getCode() == 404) {
                return response()->json([
                    'message' => 'Not Found',
                ], 404);
            }
            if ($e->getCode() == 500 && !config('app.debug')) {
                return response()->json([
                    'message' => 'Internal Server Error',
                ], 500);
            }
        }
        return parent::render($request, $e);
    }
}