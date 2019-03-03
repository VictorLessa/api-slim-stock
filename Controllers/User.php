<?php
/**
 * Created by PhpStorm.
 * User: Lessa
 * Date: 01/03/2019
 * Time: 22:55
 */
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use PDO;
use PDOException;
class User
{
    private $app;
    private $services;
    /**
     * Undocumented function
     * @param [object] $container
     */

    public function __construct($app) {
        $this->app = $app;
        $this->services = new \App\Services\User($this->app);
    }

    public function Error($e) {
        throw new \Exception($e->getMessage(), 500);
    }

    public function getUser($req, $res, $args) {
        try {
            $result = $this->services->getUser($req, $args);
            return $res->withJson(['Result' => $result], 200)
                ->withHeader('Content-type', 'application/json');
        }catch(PDOException $e) {
            $this->Error($e);
        }
    }

    public function singUp($req, $res, $args) {
        try {
            $this->services->singUp($req);
            return $res->withJson(['Result' => 'Success'], 200)
                ->withHeader('Content-type', 'application/json');
        }catch (PDOException $e) {
            $this->Error($e);
        }
    }

    public function updateUser($req, $res, $args) {
        try {
            $this->services->updateUser($req, $args);
            return $res->withJson(['Result' => 'Success'], 200)
                ->withHeader('Content-type', 'application/json');
        }catch(PDOException $e) {
            $this->Error($e);
        }
    }

    public function deleteUser($req, $res, $args) {
        try {
            $this->services->deleteUser($req, $args);
            return $res->withJson(['Result' => 'Success'], 200)
                ->withHeader('Content-type', 'application/json');
        }catch(PDOException $e){
            $this->Error($e);
        }

    }
}
