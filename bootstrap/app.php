<?php

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isStaff;
use App\Http\Middleware\isGuest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            // 'nama' => alamat
            'isStaff' => isStaff::class,
            'isGuest' => isGuest::class,
            'isAdmin' => isAdmin::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
