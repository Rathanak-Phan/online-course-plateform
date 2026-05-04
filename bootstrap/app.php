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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'course_access' => \App\Http\Middleware\CheckCourseAccess::class,
        ]);

        $middleware->redirectUsersTo(function () {
            $user = auth()->user();
            if ($user->hasRole('admin')) {
                return route('admin.dashboard');
            } elseif ($user->hasRole('instructor')) {
                return route('instructor.dashboard');
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
