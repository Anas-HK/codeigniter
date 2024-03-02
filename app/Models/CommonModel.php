<?php
namespace App\Models;

use CodeIgniter\Model;

class CommonModel extends Model {

    public function insertData($table, $data) {
        $builder = $this->db->table($table);
        $builder->insert($data);
        return true;
    }

    // Can't use update as name because it has different predefined meaning
    public function updateData($table, $where, $data)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($table, $where) {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->delete();
        return true;
    }

    // If there's no field than array will be blank.
    public function selectRecord($table, $where = array()) {
        $builder = $this->db->table($table);
        $builder->where($where);
        $result = $builder->get();
        return $result->getResult();
    }

    // Will only give single record
    public function selectRow($table, $where = array()) {
        $builder = $this->db->table($table);
        $builder->where($where);
        $result = $builder->get();
        return $result->getRow();
    }
}