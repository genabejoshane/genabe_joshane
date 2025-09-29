<?php
// UserModel for user CRUD and pagination

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function getPaginated($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $result = $this->db->table($this->table)->limit($perPage)->offset($offset)->get();
        if (is_array($result)) {
            return $result;
        } elseif (is_object($result)) {
            return [$result];
        } else {
            return [];
        }
    }

    public function countAll()
    {
        return $this->db->table($this->table)->count();
    }

    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function find($id, $with_deleted = false)
    {
        // If $with_deleted is supported, add logic here. Otherwise, ignore for now.
        return $this->db->table($this->table)->where($this->primary_key, $id)->get();
    }

    public function update($id, $data)
    {
        return $this->db->table($this->table)->where($this->primary_key, $id)->update($data);
    }

    public function delete($id)
    {
        return $this->db->table($this->table)->where($this->primary_key, $id)->delete();
    }
}
