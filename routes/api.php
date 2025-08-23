<?php

use App\Core\Router;
use App\Controllers\UsersControllers;
use App\Controllers\ProjectsController;
use App\Controllers\AnalyticsController;
use App\Controllers\EventsDonationsController;
use App\Controllers\DonorsController;


$router=new Router();

// $router->get('/capstone4-mvc/public/auth',[UsersControllers::class,'index']);
// $router->get('/capstone4-mvc/public/auth/login',[UsersControllers::class,'login']);
// $router->post('/capstone4-mvc/public/auth',[UsersControllers::class,'login']);
$router->get('/capstone4-mvc/public/projects',[ProjectsController::class,'index']);
$router->get('/capstone4-mvc/public/Analytics',[AnalyticsController::class,'index']);
$router->get('/capstone4-mvc/public/EventsDonations',[EventsDonationsController::class,'index']);
$router->get('/capstone4-mvc/public//donors', [DonorsController::class, 'index']);
$router->put('/capstone4-mvc/public/donors', [DonorsController::class, 'update']);
$router->post('/capstone4-mvc/public/donors', [DonorsController::class, 'create']);
$router->delete('/capstone4-mvc/public/donors', [DonorsController::class, 'delete']);


