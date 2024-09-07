<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Authenticate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
         // Define global middleware groups
         $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // Define custom middleware groups
        $middleware->group('auth', [ Authenticate::class, ]);

        // Middleware aliases
        $middleware->alias([ 'auth:customer' => Authenticate::class,]);
        $middleware->alias([ 'auth:staff' => Authenticate::class,]);
        $middleware->alias([ 'auth:admin' => Authenticate::class,]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
