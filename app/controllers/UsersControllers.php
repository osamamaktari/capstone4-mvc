<?php

namespace App\Controllers;

use App\Models\Users;

class UsersControllers{

  public function index() {
        echo "User Home page";
     
    }


function login(){
       
   

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
require __DIR__ . '/../views/auth/login.php';
        return;
    }

    $userModel = new Users();
    $user = $userModel->login($email, $password);

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
    echo "successfully logged in";
        // header('Location: /dashboard');
        // exit;
         require __DIR__ . '/../views/auth/index.php';
    ;
    } else {
        $err= "Invalid email or password.";
        
require __DIR__ . '/../views/auth/failed.php';
    }
}
}

