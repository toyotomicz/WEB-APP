<?php
namespace App\Models;


class ChefManager {
    private $db;

    public function __construct(MyDatabase $db) {
        $this->db = $db;
    }

    public function createChef($username, $email, $password) {
        $stmt = $this->db->query("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'chef')");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
}
