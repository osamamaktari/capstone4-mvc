<?php
namespace App\Core;
use App\Controllers;

final class Router
{
    
    private array $routes = ['GET' => [], 'POST' => [],'PATCH'=>[]];

    public function get(string $path, $handler): void  { $this->routes['GET'][$this->norm($path)]  = $handler; }
    public function post(string $path, $handler): void { $this->routes['POST'][$this->norm($path)] = $handler; }
    public function put(string $path, $handler): void  {$this->routes['PUT'][$this->norm($path)] = $handler;}
    public function delete(string $path, $handler):void { $this->routes['DELETE'][$this->norm($path)] = $handler;}
    public function options(string $path, $handler): void {$this->routes['OPTIONS'][$this->norm($path)] = $handler;}
    public function patch(string $path, $handler):void { $this->routes['PATCH'][$this->norm($path)] = $handler;}


    public function dispatch(string $method, string $uri): void
    {


        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH,OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json; charset=UTF-8");
          
  




        $path = $this->norm(parse_url($uri, PHP_URL_PATH) ?: '/');

        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        if (is_array($handler)) {
            [$class, $action] = $handler;
            (new $class())->$action();
        } else {
            $handler();
        }
    }

    private function norm(string $p): string
    {
        $p = rtrim($p, '/');
        return $p === '' ? '/' : $p;
    }


    
}
