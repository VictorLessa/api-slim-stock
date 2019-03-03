<?php
/**
 * Created by PhpStorm.
 * User: Lessa
 * Date: 02/03/2019
 * Time: 10:21
 */
namespace App\Services;
use PDO;
use PDOException;
class User
{
    private $app;
    private $name;
    private $age;
    private $password;
    private $email;

    public function __construct($app, $req) {
        $params = json_decode($req->getbody());
        $this->app = $app;
        $this->name = $params->name;
        $this->age= $params->age;
        $this->password= $params->password;
        $this->email= $params->email;
    }

    public function bindParam ($stmt) {
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('password', $this->password);
        $stmt->bindParam('age', $this->age);
        $stmt->bindParam('email', $this->email);
        $stmt->execute();
    }

    public function singUp () {
        $sql = "INSERT INTO user (name, age, password, email) VALUES (:name, :age, :password, :email)";
        $stmt = $this->app->db->prepare($sql);
        $result = $this->bindParam($stmt);
        return $result;
    }

    public function updateUser ($args) {
        $id = $args['id'];
        $sql = "UPDATE user set name = :name, age = :age, password = :password, email = :email where id = {$id}";
        $stmt = $this->app->db->prepare($sql);
        $result = $this->bindParam($stmt);
        return $result;

    }
}