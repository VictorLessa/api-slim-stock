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

class User
{
    private $app;
    /**
     * Undocumented function
     * @param [object] $container
     */

    public function __construct($app) {
        $this->app = $app;
    }

    public function home ($req, $res, $args) {
        return $res->write('teste');
    }

    public function singUp($req, $res, $args) {
        $result = new \App\Services\User($this->app, $req);
        return $res->write($result->singUp());
    }
}
