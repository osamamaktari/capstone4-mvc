<?php
namespace App\Controllers;

use App\Models\Volunteers;

class VolunteersController {


    public function index() {
        $model = new Volunteers();
        $all = $model->all();
        echo json_encode($all);
    }


    public function allWithDeleted() {
        $model = new Volunteers();
        $all = $model->allWithDeleted();
        echo json_encode($all);
    }


    public function find() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID is required']);
            return;
        }

        $model = new Volunteers();
        $volunteer = $model->find($id);
        echo json_encode($volunteer);
    }

    // ✅ إضافة متطوع
    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);
        $model = new Volunteers();
        $id = $model->create($data);
        echo json_encode(['id' => $id, 'message' => 'Volunteer created successfully']);
    }


    public function update() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID is required']);
            return;
        }

        $model = new Volunteers();
        $model->update($id, $data);
        echo json_encode(['message' => 'Volunteer updated successfully']);
    }


    public function delete() {
        $id = $_GET['id'] ?? null; 
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID is required']);
            return;
        }

        $model = new Volunteers();
        $model->softDelete($id);
        echo json_encode(['message' => 'Volunteer deleted successfully (soft delete)']);
    }


    public function restore() {
        $id = $_GET['id'] ?? null; 
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID is required']);
            return;
        }

        $model = new Volunteers();
        $model->restore($id);
        echo json_encode(['message' => 'Volunteer restored successfully']);
    }
}
