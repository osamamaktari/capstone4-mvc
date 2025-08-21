<?php

namespace App\Models;

use App\Core\App;

class Projects{
    private $db;

 public function __construct() {
        $this->db = App::db();
    }
    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM projects");
        return $stmt->fetchAll();
    }
}
