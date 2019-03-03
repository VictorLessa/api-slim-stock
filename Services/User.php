<?php
/**
 * Created by PhpStorm.
 * User: Lessa
 * Date: 02/03/2019
 * Time: 10:21
 */
namespace App\Services;
use PDO;
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

    public function bindParam ($req, $stmt) {
        $params = json_decode($req->getBody());
        $stmt->bindParam('name', $params->name);
        $stmt->bindParam('password', $params->password);
        $stmt->bindParam('age', $params->age);
        $stmt->bindParam('email', $params->email);
        $stmt->execute();
    }

    public function getUser($req, $args) {
        if (isset($args['id'])) {
            $id = $args['id'];
            $sql = "SELECT * FROM user where id = {$id}";
            $stmt = $this->app->db->query($sql);
            $stmt->execute();
            $result = $stmt->fetchALL(PDO::FETCH_OBJ);
            return $result;
        } else {
            $sql = "SELECT * FROM user";
            $stmt = $this->app->db->query($sql);
            $stmt->execute();
            $result = $stmt->fetchALL(PDO::FETCH_OBJ);
            return $result;
        }
    }

    public function singUp ($req) {
        $sql = "INSERT INTO user (name, age, password, email) VALUES (:name, :age, :password, :email)";
        $stmt = $this->app->db->prepare($sql);
        $result = $this->bindParam($req, $stmt);
        return $result;
    }

    public function updateUser ($req, $args) {
        $id = $args['id'];
        $sql = "UPDATE user set name = :name, age = :age, password = :password, email = :email where id = {$id}";
        $stmt = $this->app->db->prepare($sql);
        $result = $this->bindParam($req, $stmt);
        return $result;
    }

    public function deleteUser($req, $args) {
        $id = $args['id'];
        $sql = "DELETE FROM user where id = {$id}";
        $stmt = $this->app->db->prepare($sql);
        $result = $this->bindParam($req, $stmt);
        return $result;
    }
}