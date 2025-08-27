<?php

$sessionPath = realpath(__DIR__ . '/../sessions');
session_save_path($sessionPath);


if (!is_writable(session_save_path())) {

    die('Session save path is not writable: ' . session_save_path());
}

    session_set_cookie_params([
        'lifetime' => 1800, 
        'path' => '/',
        'domain' => 'localhost', 
        'secure' => false, 
        'httponly' => true,
        'samesite' => 'Lax' 
    ] );



// Simple PSR-4-ish autoloader for App\*
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) === 0) {
        $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
        $file = __DIR__ . '/../app/' . $relative . '.php';
        if (file_exists($file)) require $file;
    }
});

// CORS headers
$allowedOrigins = [
    // "http://127.0.0.1:5500",
    "http://localhost:5500",
    "http://localhost:5173"
];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header("Access-Control-Allow-Credentials: true");
}

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Create router and include all routes
$router = new App\Core\Router();
require __DIR__ . '/../routes/api.php';

// Dispatch current request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

  