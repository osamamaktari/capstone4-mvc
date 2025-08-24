<?php

use App\Core\Router;
use App\Controllers\UsersControllers;
use App\Controllers\ProjectsController;
use App\Controllers\AnalyticsController;
use App\Controllers\EventsDonationsController;
use App\Controllers\DonorsController;
use App\Controllers\VolunteersController;


$router=new Router();

$router->get('/capstone4-mvc/public/projects',[ProjectsController::class,'index']);

$router->get('/capstone4-mvc/public/Analytics',[AnalyticsController::class,'index']);

$router->get('/capstone4-mvc/public/EventsDonations',[EventsDonationsController::class,'index']);

$router->get('/capstone4-mvc/public//donors', [DonorsController::class, 'index']);
$router->put('/capstone4-mvc/public/donors', [DonorsController::class, 'update']);
$router->post('/capstone4-mvc/public/donors', [DonorsController::class, 'create']);
$router->delete('/capstone4-mvc/public/donors', [DonorsController::class, 'delete']);

$router->get('/capstone4-mvc/public/Volunteers',[VolunteersController::class,'index']);
$router->get('/capstone4-mvc/public/Volunteers',[VolunteersController::class,'allWithDeleted']);
$router->post('/capstone4-mvc/public/Volunteers',[VolunteersController::class,'create']);
$router->put('/capstone4-mvc/public/Volunteers',[VolunteersController::class,'update']);
$router->delete('/capstone4-mvc/public/Volunteers',[VolunteersController::class,'delete']);
$router->patch('/capstone4-mvc/public/Volunteers/restore',[VolunteersController::class,'restore']);




