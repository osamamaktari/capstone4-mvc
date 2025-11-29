<?php
namespace App\Models;
use App\Core\App;

class User {
    private $db;
    public function __construct() {
        $this->db = App::db();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
}
