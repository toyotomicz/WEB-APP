<?php
namespace App\Models;

class AdminManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createAdmin($username, $email, $password) {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Create array of parameters
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role_id' => 3
        ];
    
        // Use named parameters in the SQL query
        $sql = "INSERT INTO users (username, email, password, role_id) 
                VALUES (:username, :email, :password, :role_id)";
        
        // Use the query method from MyDatabase class which handles preparation and execution
        return $this->db->query($sql, $params);
    }

    public function createCook($username, $email, $password) {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Create array of parameters
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role_id' => 1
        ];
    
        // Use named parameters in the SQL query
        $sql = "INSERT INTO users (username, email, password, role_id) 
                VALUES (:username, :email, :password, :role_id)";
        
        // Use the query method from MyDatabase class which handles preparation and execution
        return $this->db->query($sql, $params);
    }
}