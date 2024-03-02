<?php

namespace App\Controllers;

use App\Models\CommonModel;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    private $model;

    function __construct() {
        $this->model = new CommonModel();
    }

    public function index($id = null)
    {
        // When no id is given, all data will be selected, else particular row will be.
        if($id == null) {
            $fetchRecord = $this->model->selectRecord('user');
            $result = [
                "status" => 201,
                "data" => $fetchRecord
            ];
        }
        else {
            $fetchRecord = $this->model->selectRow('user', ["id" => $id]);
            if(!empty($fetchRecord)) {
                $result = [
                    "status" => 201,
                    "data" => $fetchRecord
                ];
            }
            else {
                $result = [
                    "status" => 404,
                    "data" => "Not found"
                ];
            }
        }

        return $this->respond($result);
    }

    public function delete($id) {
        // Checking if data exists
        $selectData = $this->model->selectRow('user', ["id" => $id]);

        if(!empty($selectData)) {
            $delete = $this->model->deleteData('user', ["id" => $id]);

            if($delete) {
                $result = [
                    "status" => 201,
                    "Delete" => "Deleted Successfully"
                ];
            }
            else {
                $result = [
                    "status" => 404,
                    "Delete" => "Deleted couldn't be deleted"
                ];
            }
        }
        else {
            $result = [
                "status" => 404,
                "Delete" => "No record found"
            ];
        }

        return $this->respond($result);
    }

    public function status($id, $status) {
        // Checking if data exists
        $selectData = $this->model->selectRow('user', ["id" => $id]);

        if(!empty($selectData)) {
            if($status == 'Active') {
                $action = "Inactive";
            }
            else {
                $action = "Active";
            }
            $data = [
                "status" => $action
            ];
            $updateStatus = $this->model->updateData("user", ["id" => $id],$data);
            if($updateStatus) {
                $result = [
                    "status" => 201,
                    "data" => "Updated status successfully"
                ];
            }
            else {
                $result = [
                    "status" => 404,
                    "data" => "Could not update status"
                ];
            }
        }
        else {
            $result = [
                "status" => 404,
                "Delete" => "No record found"
            ];
        }

        return $this->respond($result);
    }

    // In CodeIgniter we don't need Request as parameter to the function. Because request post data can be accessed globally.
    public function update($id) {
        // Checking if data exists
        $selectData = $this->model->selectRow('user', ["id" => $id]);

        if(!empty($selectData)) {

            $data = [
                "id" => $this->request->getPost('id'),
                "name" => $this->request->getPost('name'),
                "email" => $this->request->getPost('email'),
                "title" => $this->request->getPost('title'),
                'updated_date' => date('Y-m-d H:i:s'),
                "status" => $this->request->getPost('status'),
            ];

            $updateStatus = $this->model->updateData("user", ["id" => $id],$data);
            if($updateStatus) {
                $result = [
                    "status" => 201,
                    "data" => "Updated data successfully"
                ];
            }
            else {
                $result = [
                    "status" => 404,
                    "data" => "Could not update data"
                ];
            }
        }
        else {
            $result = [
                "status" => 404,
                "Delete" => "No record found"
            ];
        }

        return $this->respond($result);
    }

    public function create() {
        $data = [
            "name" => $this->request->getPost('name'),
            "email" => $this->request->getPost('email'),
            "title" => $this->request->getPost('title'),
            "creation_date" => date('Y-m-d H:i:s'),
        ];

        $dataInserted = $this->model->insertData('user', $data);

        if($dataInserted) {
            $result = [
                "status" => 201,
                "data" => "Data created successfully"
            ];
        }
        else {
            $result = [
                "status" => 404,
                "data" => "Data could not be created"
            ];
        }

        return $this->respond($result);
    }
}