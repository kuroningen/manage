<?php

///*
//|--------------------------------------------------------------------------
//| Loads the .env file
//|--------------------------------------------------------------------------
//|
//| We will load first our .env file before everything else :)
//|
//*/
//array_map(function($sEnv) {
//    $sEnv = trim($sEnv);
//    if (strlen($sEnv) === 0) {
//        return;
//    }
//    putenv($sEnv);
//}, explode("\n", file_get_contents(__DIR__ . '/../../project/.env')));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new \project\conf\kernel\application(
    dirname(__DIR__) . '/'
);

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

require $app->basePath('../project/conf/kernel.php');

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
