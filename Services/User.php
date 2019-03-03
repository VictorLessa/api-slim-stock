<?php
/**
 * Created by PhpStorm.
 * User: Lessa
 * Date: 02/03/2019
 * Time: 10:21
 */
namespace App\Services;
use PDO;
use Illuminate\Database\Query\Builder;

class User
{
    private $app;
    private $name;
    private $age;
    private $password;
    private $email;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getUser($req, $args) {
        if (isset($args['id'])) {
            $id = $args['id'];
            $result = $this->app->db->table('user')
                ->where('id', $id)
                ->get();
            return $result;
        } else {
            $result = $this->app->db->table('user')->get();
            return $result;
        }
    }

    public function singUp ($req) {
        $params = json_decode($req->getBody());
        $result = $this->app->db->table('user')
            ->insert(
                [
                    'name' => $params->name ,
                    'age' => $params->age,
                    'password' => $params->password,
                    'email' => $params->email
                ]);
        return $result;
    }

    public function updateUser ($req, $args) {
        $id = $args['id'];
        $params = json_decode($req->getBody());
        $result = $this->app->db->table('user')
            ->where('id', $id)
            ->update(
                [
                    'name' => $params->name ,
                    'age' => $params->age,
                    'password' => $params->password,
                    'email' => $params->email
                ]
            );
        return $result;
    }

    public function deleteUser($req, $args) {
        $id = $args['id'];
        $result = $this->app->db->table('user')
            ->where('id', $id)
            ->delete();
        return $result;
    }
}