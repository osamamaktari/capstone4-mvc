<?php

namespace App\Models;

use App\Core\App;

class User{
    private $db;
  
    public function __construct() {
        $this->db = App::db();
    }

    function getUser($email) {

        $stm=$this->db->prepare("SELECT * FROM users WHERE email=:email");
        $stm->execute(['email' => $email]);
        return $stm->fetch();

    }

    function login($email, $password) {

$user=$this->getUser($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}