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

    public function getStock($req, $args)
    {
        var_dump($req->getUri()->getQuery()->name);
        $name = $args['name'];
        var_dump($name);
        $stock = $this->app->db::table('stock')
            ->where('name', 'like', $_GET['name'].'%')
            ->get();
        $teste;
        for($i = 0; $i < count($stock); $i++)
        {
            $result = $this->app->db::table('details_parts')
                ->where('stock_id', $stock[$i]->id)
                ->get();
            $stock[$i]->description = $result[0]->description;
        }
        return $stock;

    }
    public function setStock($req, $args)
    {
        if (isset($args['id'])) {
        } else {
            $params = json_decode($req->getBody());
            $lastId = $this->app->db::table('stock')
                ->insertGetId(
                    [
                        'name' => $params->name,
                        'quantity' => $params->quantity,
                        'price' => $params->price,
                        'details' => $params->details
                    ]
                );
            $result = $this->app->db::table('details_parts')
                ->insert(
                    [
                        'stock_id' => $lastId,
                        'description' => $params->description
                    ]
                );
            if ($result) {
                $this->app->db::commit();
            } else {
                $this->app->db::rollBack();
            }
            return $result;
        }
    }

    public function updateStock($req, $args)
    {
        $id = $args['id'];
        $this->app->db->table('stock')
            ->where('id', $id)
            ->update(
                [
                    'name' => $params->name,
                    'quantity' => $params->quantity,
                    'price' => $params->price,
                    'details' => $params->details
                ]
            );
        $result = $this->app->db->table('details_parts')
            ->where('id', $id)
            ->update(
                [
                    'description' => $params->name
                ]
            );
        if ($result) {
            $this->app->db::commit();
        } else {
            $this->app->db::rollBack();
        }
        return $result;
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