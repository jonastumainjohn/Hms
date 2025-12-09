<?php

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
            'preventBackHistory'=>App\Http\Middleware\PreventBackHistory::class,
            'OnlySuperAdmin' => App\Http\Middleware\OnlySuperAdmin::class,
            'doctorMiddleware' => App\Http\Middleware\doctorMiddleware::class,
            'ReceptionistMiddleware' => App\Http\Middleware\ReceptionistMiddleware::class,
            'adminMiddleware' => App\Http\Middleware\adminMiddleware::class,
            'DoctorAdminMiddleware' => App\Http\Middleware\DoctorAdminMiddleware::class,
            'DoctorReceptMiddleware' => App\Http\Middleware\DoctorReceptMiddleware::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
