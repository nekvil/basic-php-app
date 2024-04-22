<?php

require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/config/MySQLDatabase.php';

class UserModel {
    
    private $pdo;

    public function __construct() {
        $this->pdo = MySQLDatabase::connect();
    }

    public function createUser($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);
        return $stmt->rowCount() > 0;
    }

    public function getUsers() {
        $stmt = $this->pdo->query("SELECT id, name, email, password, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->rowCount() > 0;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
