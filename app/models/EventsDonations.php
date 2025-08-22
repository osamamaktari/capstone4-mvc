<?php
namespace App\Models;

use App\Core\App;

class EventsDonations{

  private $db;

  public function __construct() {
        $this->db = App::db();
    }

    public function all()
{
    $data = [];

 
    $stmt = $this->db->prepare("SELECT * FROM events");
    $stmt->execute();
    $data['events'] = $stmt->fetchAll();

   
    $stmt = $this->db->prepare("SELECT * FROM donations");
    $stmt->execute();
    $data['donations'] = $stmt->fetchAll();

    return $data;
}


}