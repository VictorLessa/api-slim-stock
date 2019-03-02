<?php
/**
 * Created by PhpStorm.
 * User: Victor Lessa
 * Site https://victorlessa.me
 * Date: 01/03/2019
 * Time: 21:59
 */

require __DIR__ . './vendor/autoload.php';

session_start();

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

// Run app
$app->run();
