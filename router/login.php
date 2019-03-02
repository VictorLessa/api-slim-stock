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
    $this->post('user', function($req, $res, $args) {
        $this->logger->addInfo("/api/user Cadastro user");
        $controller = new \App\Controllers\User($this, $req);
        $controller->singUp($res, $args);
    });
    $this->patch('user/{id:[0-9]+}', function($req, $res, $args) {
       $this->logger->addInfo('/api/user update user');
       $controller = new \App\Controllers\User($this, $req);
       $controller->updateUser($res, $args);
    });
});