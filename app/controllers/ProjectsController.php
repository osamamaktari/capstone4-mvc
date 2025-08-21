<?php

namespace App\Controllers;

use App\Models\Projects;

class ProjectsController{
    
  

    
    public function index()
    {
        $project  = new Projects();
        $modelprojects =$project->all();
         header("Access-Control-Allow-Origin: *");
         header("Content-Type: application/json;CHARSET=UTF-8");
        echo json_encode( $modelprojects);
    
    }

}

