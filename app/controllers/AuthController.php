<?php
namespace App\Controllers;
use App\Models\User;

class AuthController {


    // public function login() {
    //     session_start();
    //     $data = json_decode(file_get_contents("php://input"), true);
    //     $email = $data['email'] ?? '';
    //     $password = $data['password'] ?? '';

    //     $userModel = new User();
    //     $user = $userModel->findByEmail($email);

    //     if ($user && password_verify($password, $user['password'])) {
    //         //  Authentication Successed
    //         $_SESSION['user_id'] = $user['id'];
    //         $_SESSION['role'] = $user['role'];

    //         // 
    //         setcookie("PHPSESSID", session_id(), time() + 1800, "/", "", false, true);

    //         echo json_encode([
    //             "success" => true,
    //             "role" => $user['role'],
    //             "message" => "Login Successfully"
    //         ]);
    //     } else {
    //         echo json_encode([
    //             "success" => false,
    //             "message" => "Something wrong with email or password"
    //         ]);
    //     }
    // }
    // في بداية دالة login()
public function login() {

    // session_set_cookie_params([
    //     'lifetime' => 1800, 
    //     'path' => '/',
    //     'domain' => 'localhost', 
    //     'secure' => false, 
    //     'httponly' => true,
    //     'samesite' => 'Lax' 
    // ] );

    session_start();



    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $userModel = new User();
    $user = $userModel->findByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];


        echo json_encode([
            "success" => true,
            "role" => $user['role'],
            "message" => "Login Successfully"
        ]);
    } else {
   
    }
}


    // (Authorization)
    public function checkSession() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            echo json_encode([
                "authenticated" => true,
                "user_id" => $_SESSION['user_id'],
                "role" => $_SESSION['role']
            ]);
        } else {
            echo json_encode(["authenticated" => false]);
        }
    }


    public function logout() {
        session_start();
        session_destroy();
        setcookie("PHPSESSID", "", time() - 1800, "/");
        echo json_encode(["success" => true]);
    }
}
