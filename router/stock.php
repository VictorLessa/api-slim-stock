<?php
/**
 * Created by PhpStorm.
 * User: Victor Lessa
 * Date: 03/03/2019
 * Time: 09:44
 */

$app->group('/api/', function () {
    $this->get('stock', function ($req, $res, $args) {
        $controller = new \App\Controllers\Stock($this);
        return $controller->getStock($req, $res, $args);
    });

   $this->post('stock', function ($req, $res, $args) {
       $controller = new \App\Controllers\Stock($this);
       return $controller->setStock($req, $res, $args);
   });

   $this->patch('stock/{id:[0-9]+}', function ($req, $res, $args) {
      $controller = new \App\Controllers\Stock($this);
      return $controller->updateStock($req, $res, $args);
   });

   $this->delete('stock/{id:[0-9]+}', function ($req, $res, $args) {
       $controller = new \App\Controllers\Stock($this);
       return $controller->deleteStock($req, $res, $args);
   });

});