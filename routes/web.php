<?php
use App\Controllers\UsersControllers;
use App\Core\Router;

$router=new Router();

$router->get('/capstone4-mvc/public/auth',[UsersControllers::class,'index']);
$router->get('/capstone4-mvc/public/auth/login',[UsersControllers::class,'login']);
$router->post('/capstone4-mvc/public/auth',[UsersControllers::class,'login']);

