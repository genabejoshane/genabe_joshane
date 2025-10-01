<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {

    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function find_by_username($username)
    {
        return $this->db->table($this->table)
            ->where('username', $username)
            ->get();
    }

    public function create_user($username, $password_hash, $role = 'user')
    {
        return $this->db->table($this->table)->insert([
            'username' => $username,
            'password_hash' => $password_hash,
            'role' => $role,
        ]);
    }
}
?>

