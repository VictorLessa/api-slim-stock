<?php
/**
 * Created by PhpStorm.
 * User: Lessa
 * Date: 03/03/2019
 * Time: 10:10
 */

namespace App\Services;



class Stock
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }


    public function setStock($req, $args)
    {
        if (isset($args['id'])) {
        } else {
            $params = json_decode($req->getBody());
            $lastId = $this->app->db->table('stock')
                ->insertGetId(
                    [
                        'name' => $params->name,
                        'quantity' => $params->quantity,
                        'price' => $params->price,
                        'details' => $params->details
                    ]
                );
            $result = $this->app->db->table('details_parts')
                ->insert(
                    [
                        'stock_id' => $lastId,
                        'description' => $params->description
                    ]
                );
            return $result;
        }
    }

    public function quantityStock($req, $args)
    {

    }

    public function deleteStock($req, $args)
    {
        $id = $args['id'];
        $params = json_decode($req->getBody());
        $this->app->db->table('details_parts')
            ->where('stock_id', $id)
            ->delete();
        $result = $this->app->db->table('stock')
            ->where('id', $id)
            ->delete();
        return $result;

    }
}