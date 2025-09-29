<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * Automatically generated via CLI.
 */
class UserModel extends Model {
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
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }
}