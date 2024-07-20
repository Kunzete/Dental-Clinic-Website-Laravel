<?php

use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\AdminRedirect;
use App\Http\Middleware\DoctorAuthenticate;
use App\Http\Middleware\DoctorRedirect;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.guests' => AdminAuthenticate::class,
            'admin.auths' => AdminRedirect::class,
            'doctor.guests' => DoctorAuthenticate::class,
            'doctor.auths' => DoctorRedirect::class
        ]);
        $middleware->redirectTo(
            guests:'/account/login',
            users: '/account/dashboard'
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
