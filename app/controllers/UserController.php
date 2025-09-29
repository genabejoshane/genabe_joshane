<?php
// UserController for create, edit, update, delete

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        require_once __DIR__ . '/../../app/models/UserModel.php';
        $this->UserModel = new UserModel();
    }

    // List users with pagination
    public function index()
    {
    require_once __DIR__ . '/../../scheme/helpers/pagination_helper.php';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $totalUsers = $this->UserModel->countAll();
        $data['users'] = $this->UserModel->getPaginated($page, $perPage);
        $data['pagination'] = paginate($totalUsers, $perPage, $page, '/user/view?page=');
        $this->call->view('user/view', $data);
    }

    // Create user
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
            redirect('/user/view');
        } else {
            $this->call->view('user/create');
        }
    }

    // Edit user form
    public function edit($id)
    {
        $user = $this->UserModel->find($id);
        if ($user === null) {
            redirect('/user/view');
        }
        $this->call->view('user/update', ['user' => $user]);
    }

    // Update user
    public function update($id)
    {
        if($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $data = [
                'username' => $username,
                'email' => $email
            ];
            $this->UserModel->update($id, $data);
            redirect('/user/view');
        } else {
            $user = $this->UserModel->find($id);
            if ($user === null) {
                redirect('/user/view');
            }
            $this->call->view('user/update', ['user' => $user]);
        }
    }

    // Delete user
    public function delete($id)
    {
        $this->UserModel->delete($id);
        redirect('/user/view');
    }
}
