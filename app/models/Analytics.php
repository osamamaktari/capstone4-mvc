<?php

namespace App\Models;

use App\Core\App;

class Analytics{

   private $db;

  public function __construct() {
        $this->db = App::db();
    }

    // Fetch all analytics data from multiple tables
public function all()
{
    $data = [];

    // donor_growth
    $stmt = $this->db->prepare("SELECT * FROM donor_growth");
    $stmt->execute();
    $data['donor_growth'] = $stmt->fetchAll();

    // donation_by_age
    $stmt = $this->db->prepare("SELECT * FROM donation_by_age");
    $stmt->execute();
    $data['donation_by_age'] = $stmt->fetchAll();

    // donation_by_region
    $stmt = $this->db->prepare("SELECT * FROM donation_by_region");
    $stmt->execute();
    $data['donation_by_region'] = $stmt->fetchAll();

    // visitor_stats
    $stmt = $this->db->prepare("SELECT * FROM visitor_stats");
    $stmt->execute();
    $data['visitor_stats'] = $stmt->fetchAll();

    // top_visited_pages
    $stmt = $this->db->prepare("SELECT * FROM top_visited_pages");
    $stmt->execute();
    $data['top_visited_pages'] = $stmt->fetchAll();

    return $data;
}



}