<?php
namespace App\Controllers;
use App\Models\User;
use Firebase\JWT\JWT; 
use Firebase\JWT\Key; 

class AuthController {
private $secretKey = 'd7c1be3c87f40bf50522b7dc4de5498887def699c27cd06e1fef113fa9209100';
public function login() {

    

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

//token jwt
public function generateToken() {
    session_start(); 

 
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401 ); // Unauthorized
        echo json_encode(["message" => "You must be logged in to generate a token."]);
        return;
    }

 
    $payload = [
        'iss' => "http://localhost",
        'iat' => time( ),
        'exp' => time() + 1800,  
        'data' => [
            'user_id' => $_SESSION['user_id'],
            'role' => $_SESSION['role']
        ]
    ];

    $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

    echo json_encode([
        "success" => true,
        "token" => $jwt
    ]);
}


}






