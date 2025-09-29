<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * Automatically generated via CLI.
 */
class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

        // Fetch users with pagination
        public function getPaginated($limit, $offset)
        {
            return $this->db->table($this->table)
                ->limit($limit, $offset)
                ->get_all();
        }
}