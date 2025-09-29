<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentModel extends Model {
    public function getAllArray() {
        $result = $this->db->table($this->table)->get();
        if (is_array($result)) {
            return $result;
        } elseif (is_object($result)) {
            return [$result];
        } else {
            return [];
        }
    }
    protected $table = 'students';
    protected $primary_key = 'id';

    public function all($with_deleted = false) {
        $result = $this->db->table($this->table)->get();
        if (is_array($result)) {
            return $result;
        } elseif (is_object($result)) {
            return [$result];
        } else {
            return [];
        }
    }
    public function get($id) {
        return $this->db->table($this->table)->where($this->primary_key, $id)->get();
    }
    public function insert($data) {
        return $this->db->table($this->table)->insert($data);
    }
    public function update($id, $data) {
        return $this->db->table($this->table)->where($this->primary_key, $id)->update($data);
    }
    public function delete($id) {
        return $this->db->table($this->table)->where($this->primary_key, $id)->delete();
    }
}
