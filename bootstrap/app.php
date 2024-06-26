<?php

use App\Http\Middleware\homeMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\isAdminMiddleware;
use App\Http\Middleware\isEditorMiddleware;
use App\Http\Middleware\isUserMiddleware;
use App\Http\Middleware\isLoggedMiddleware;
use App\Http\Middleware\isUnLoggedMiddleware;
use App\Http\Middleware\workManagementMiddleware;
use App\Http\Middleware\changeInfoMiddleware;
use App\Http\Middleware\isStaffMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => isAdminMiddleware::class,
            'isEditor' => isEditorMiddleware::class,
            'isUser' => isUserMiddleware::class,
            'isLogged' => isLoggedMiddleware::class,
            'home' => homeMiddleware::class,
            'isUnlogged' => isUnloggedMiddleware::class,
            'workManager' => workManagementMiddleware::class,
            'changeInfo' => changeInfoMiddleware::class,
            'isStaff' => isStaffMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
