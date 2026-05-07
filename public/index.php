<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Path to the Laravel app root (one level up on local, absolute path on server)
$appPath = file_exists('/home/kasszdus/nigat-jobs/vendor/autoload.php')
    ? '/home/kasszdus/nigat-jobs'
    : __DIR__ . '/..';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $appPath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $appPath . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $appPath . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
