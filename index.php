<?php
/**
 * Created by PhpStorm.
 * User: Victor Lessa
 * Site https://victorlessa.me
 * Date: 01/03/2019
 * Time: 21:59
 */

require 'vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
// Instantiate the app
$settings = require __DIR__ . './config/settings.php';
$c = new \Slim\Container($settings);


$app = new \Slim\App($c);

// Set up dependencies
require __DIR__ . './config/dependencies.php';
require __DIR__ . './config/handler.php';

// Register middleware
require __DIR__ . './config/middleware.php';

//
require __DIR__ . './Services/User.php';

// Register routes
require __DIR__ . './router/login.php';
require __DIR__ . './router/stock.php';

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// Run app
$app->run();
