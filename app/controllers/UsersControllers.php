<?php

namespace App\Controllers;

use App\Models\User;

function showloginForm(){

    require __DIR__ . '/../views/auth/login.php';
}

function login(){

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
        return;
    }

    $userModel = new User();
    $user = $userModel->login($email, $password);

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: /dashboard');
        exit;
    } else {
        $err= "Invalid email or password.";
        
         require __DIR__ . '/../views/auth/login.php';
    }
}