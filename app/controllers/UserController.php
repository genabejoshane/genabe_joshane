<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
           $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
           $limit = 10; // Number of users per page
           $offset = ($page - 1) * $limit;

           $data['users'] = $this->UserModel->getPaginated($limit, $offset);
           $total_users = $this->UserModel->count();


        // Load Pagination library
        $pagination = new \Pagination();
        $pagination->initialize($total_users, $limit, $page, 'user', 5);
        $data['pagination'] = $pagination->paginate();

           $this->call->view('user/view', $data);
    }
    public function create()
    {
        if($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            $data = [
                'username' => $username,
                'email' => $email
            ];

            $this->UserModel->insert($data);
            redirect('/');
            
        }else {
            $this->call->view('user/create');
        }
    }
    public function update($id)
    {

    $data['user'] = $this->UserModel->find($id);

    if ($this->io->method() == 'post') {    
        $data = [
            'username' => $this->io->post('username'),
            'email'    => $this->io->post('email')
        ];

        $this->UserModel->update($id, $data);

        redirect('/');
    } else {
        $this->call->view('user/update', $data);
    }
    }
    public function delete($id)
    {
        $this->UserModel->delete($id);
        redirect('/');
    }
}