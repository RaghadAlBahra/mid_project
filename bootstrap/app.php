<?php

use App\Http\Middleware\checkSuperAdmin;
use App\Http\Middleware\CheeckApiCustomerAccess;
use App\Http\Middleware\CheeckDashboardAccess;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'dashboard_access'=>CheeckDashboardAccess::class,
            'api_customer'=>CheeckApiCustomerAccess::class,
            'super_admin'=>checkSuperAdmin::class
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();


