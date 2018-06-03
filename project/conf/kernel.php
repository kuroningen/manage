<?php

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    \project\conf\kernel\http::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    \project\conf\kernel\console::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    \project\conf\kernel\handler::class
);