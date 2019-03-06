<?php
/**
 * Created by PhpStorm.
 * User: Lessa
 * Date: 03/03/2019
 * Time: 10:03
 */
namespace App\Controllers;
use PDOException;
class Stock
{
    private $app;
    private $services;

    public function __construct($app)
    {
        $this->app = $app;
        $this->services = new \App\Services\Stock($this->app);
    }

    public function Error($e)
    {
        throw new \Exception($e->getMessage(), 500);
    }

    public function getStock($req, $res, $args)
    {
        try{
            $result = $this->services->getStock($req, $args);
            return $res->withJson(['Result' => $result], 200)
                ->withHeader('Content-type', 'application/json');
        }catch(PDOException $e){

        }
    }

    public function setStock($req, $res, $args)
    {
        try {
            $result = $this->services->setStock($req, $args);
            return $res->withJson(['Result' => $result], 200)
                ->withHeader('Content-type', 'application/json');
        }catch(PDOException $e){
            $this->Error($e);
        }
    }

    public function updateStock($req, $res, $args)
    {
        try {
            $result = $this->services->updateStock($req, $args);
            return $res->withJson(['Result' => $result], 200)
                ->withHeader('Content-type', 'application/json');
        }catch(PDOException $e){
            $this->Error($e);
        }
    }

    public function deleteStock($req, $res, $args)
    {
        try {
            $result = $this->services->deleteStock($req, $args);
            return $res->withJson(['Result' => $result], 200)
                ->withHeader('Content-type', 'application/json');
        }catch(PDOException $e){
            $this->Error($e);
        }
    }

}