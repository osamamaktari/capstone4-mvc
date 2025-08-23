<?php
namespace App\Models;

use App\Core\App;

class Volunteers {
    private $db;

    public function __construct() {
        $this->db = App::db();
    }

   
    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM volunteers WHERE isDeleted = 0 ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function allWithDeleted() {
        $stmt = $this->db->prepare("SELECT * FROM volunteers ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM volunteers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO volunteers (name, email, status, tasksCompleted, eventsAttended, isDeleted) 
                                    VALUES (:name, :email, :status, :tasksCompleted, :eventsAttended, 0)");
        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'tasksCompleted' => $data['tasksCompleted'],
            'eventsAttended' => $data['eventsAttended']
        ]);
        return $this->db->lastInsertId();
    }


    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE volunteers 
                                    SET name=:name, email=:email, status=:status, 
                                        tasksCompleted=:tasksCompleted, eventsAttended=:eventsAttended 
                                    WHERE id=:id");
        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'tasksCompleted' => $data['tasksCompleted'],
            'eventsAttended' => $data['eventsAttended'],
            'id' => $id
        ]);
    }

    public function softDelete($id) {
        $stmt = $this->db->prepare("UPDATE volunteers SET isDeleted = 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }


    public function restore($id) {
        $stmt = $this->db->prepare("UPDATE volunteers SET isDeleted = 0 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
