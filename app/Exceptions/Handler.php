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
    public function register()
    {
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                if (!$request->user() || !$request->user()->hasVerifiedEmail()) {
                    return response()->json([
                        'message' => 'Your email address is not verified.',
                    ], 403);
                }
                return response()->json([
                    'message' => 'Validation errors',
                    'errors' => $e->validator->errors()
                ], 422);
            }
        });
    }
}
