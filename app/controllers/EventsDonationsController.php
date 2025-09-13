<?php
namespace App\Controllers;

use App\Models\EventsDonations;

class EventsDonationsController{
     

      public function index()
    {
        $model = new EventsDonations();
        $allData = $model->all();
        echo json_encode($allData);
    }
}
