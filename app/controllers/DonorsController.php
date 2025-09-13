<?php
namespace App\Controllers;

use App\Models\Donors;

class DonorsController {

    public function index()
    {
        $model = new Donors();
        $all = $model->all();
        echo json_encode($all);
    }

    // public function find($id)
    // {
    //     $model = new Donors();
    //     $donor = $model->find($id);
    //     echo json_encode($donor);
    // }
public function find()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'ID is required']);
        return;
    }

    $model = new Donors();
    $donor = $model->find($id);

    echo json_encode($donor);
}






    public function create()

    {
        //      header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        // header("Access-Control-Allow-Headers: Content-Type, Authorization");
        // header("Content-Type: application/json; charset=UTF-8");
        $data = json_decode(file_get_contents("php://input"), true);
        $model = new Donors();
        $id = $model->create($data);
        echo json_encode(['id' => $id, 'message' => 'Donor created successfully']);
    }

    // public function update($id)
    // {
    //     $data = json_decode(file_get_contents("php://input"), true);
    //     $model = new Donors();
    //     $model->update($id, $data);
    //     echo json_encode(['message' => 'Donor updated successfully']);
    // }
    public function update()
{
    $data = json_decode(file_get_contents("php://input"), true);

    
    $id = $data['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'ID is required']);
        return;
    }

    $model = new Donors();
    $model->update($id, $data);

    echo json_encode(['message' => 'Donor updated successfully']);
}


    // public function delete($id)
    // {
    //     $model = new Donors();
    //     $model->delete($id); 
    //     echo json_encode(['message' => 'Donor deleted successfully (soft delete)']);
    // }
public function delete()
{
    $id = $_GET['id'] ?? null; 
    if (!$id) {
        http_response_code(400);
        echo json_encode(['message' => 'ID is required']);
        return;
    }

    $model = new Donors();
    $model->delete($id); 
    echo json_encode(['message' => 'Donor deleted successfully (soft delete)']);
}



}
