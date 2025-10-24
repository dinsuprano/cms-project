<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LogRequest;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployerMiddleware;
use App\Http\Middleware\JobSeekerMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware->append(LogRequest::class);
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'employer' => EmployerMiddleware::class,
            'jobseeker' => JobSeekerMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
