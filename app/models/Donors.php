<?php
namespace App\Models;

use App\Core\App;


class Donors {
    private $db;

    public function __construct() {
        $this->db = App::db();
    }

    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM donors ORDER BY date DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM donors WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO donors (donor, amount, method, date, status) 
                                    VALUES (:donor, :amount, :method, :date, :status)");
        $stmt->execute([
            'donor' => $data['donor'],
            'amount' => $data['amount'],
            'method' => $data['method'],
            'date' => $data['date'],
            'status' => $data['status']
        ]);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE donors SET donor=:donor, amount=:amount, method=:method, date=:date, status=:status WHERE id=:id");
        return $stmt->execute([
            'donor' => $data['donor'],
            'amount' => $data['amount'],
            'method' => $data['method'],
            'date' => $data['date'],
            'status' => $data['status'],
            'id' => $id
        ]);
    }

    // public function delete($id) {
    //     $stmt = $this->db->prepare("DELETE FROM donors WHERE id = :id");
    //     return $stmt->execute(['id' => $id]);
    // }

    public function delete($id) {
    $stmt = $this->db->prepare("UPDATE donors SET deleted_at = NOW() WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
}
