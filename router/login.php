<?php
/**
 * Created by PhpStorm.
 * User: Lessa
 * Date: 01/03/2019
 * Time: 22:05
 */


use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->group('/api/', function() {
    $this->get('login', function ($req, $res, $args) {
        $Login = new \App\Controllers\User($this);
        $Login->home($req, $res, $args);
    });
    $this->post('singUp', function($req, $res, $args) {
        $this->logger->addInfo("/api/singUp Cadastro user");
        $controller = new \App\Controllers\User($this);
        $controller->singUp($req, $res, $args);
    });

});