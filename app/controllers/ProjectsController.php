<?php

namespace App\Controllers;

use App\Models\Projects;

class ProjectsController{
    
  

    
    public function index()
    {
        $project  = new Projects();
        $modelprojects =$project->all();
        echo json_encode( $modelprojects);
    
    }

}

