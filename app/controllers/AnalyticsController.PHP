<?php

namespace App\Controllers;

use App\Models\Analytics;

class AnalyticsController{

    public function index()
{
    $model  = new Analytics(); 
    $allData = $model->all(); 
    echo json_encode($allData);
}

}