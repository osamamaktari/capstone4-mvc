<?php

use App\Core\Router;
use App\Controllers\UsersControllers;
use App\Controllers\ProjectsController;
use App\Controllers\AnalyticsController;


$router=new Router();

$router->get('/capstone4-mvc/public/auth',[UsersControllers::class,'index']);
$router->get('/capstone4-mvc/public/auth/login',[UsersControllers::class,'login']);
$router->post('/capstone4-mvc/public/auth',[UsersControllers::class,'login']);
$router->get('/capstone4-mvc/public/projects',[ProjectsController::class,'index']);
$router->get('/capstone4-mvc/public/Analytics',[AnalyticsController::class,'index']);

