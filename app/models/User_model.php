<?php
class User_model extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_username($username) {
        return $this->db->table($this->table)->where('username', $username)->get();
    }

    public function create($data) {
        return $this->db->table($this->table)->insert($data);
    }
}
