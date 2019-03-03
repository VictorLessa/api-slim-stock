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

    public function __construct($app, $req) {
        $this->app = $app;
        $this->services = new \App\Services\User($this->app, $req);
    }

    public function home ($res, $args) {
        return $res->write('teste');
    }

    public function singUp($res, $args) {
        try {
            $this->services->singUp();
        }catch (PDOException $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function updateUser($res, $args) {
        return $res->write($this->services->updateUser($args));
    }
}
