<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * Handle unauthenticated requests.
     */
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
{
    // Check if the request expects JSON
    if ($request->expectsJson()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    // If not expecting JSON, fallback to default login redirect
    return redirect()->guest(route('login'));
}

}
