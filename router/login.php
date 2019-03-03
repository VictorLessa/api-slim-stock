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
    $this->get('user', function ($req, $res, $args) {
        $Login = new \App\Controllers\User($this);
        return $Login->getUser($req, $res, $args);
    });

    $this->get('user/{id:[0-9]+}', function ($req, $res, $args) {
        $Login = new \App\Controllers\User($this);
        return $Login->getUser($req, $res, $args);
    });

    $this->post('user', function($req, $res, $args) {
        $this->logger->addInfo("/api/user Cadastro user");
        $controller = new \App\Controllers\User($this);
        return $controller->singUp($req, $res, $args);
    });

    $this->patch('user/{id:[0-9]+}', function($req, $res, $args) {
       $this->logger->addInfo('/api/user update user');
       $controller = new \App\Controllers\User($this);
       return $controller->updateUser($req, $res, $args);
    });

    $this->delete('user/{id:[0-9]+}', function ($req, $res, $args) {
        $controller = new \App\Controllers\User($this);
        return $controller->deleteUser($req, $res, $args);
    });
});