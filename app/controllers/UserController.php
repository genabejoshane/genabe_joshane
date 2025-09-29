<?php
// Prevent direct access
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct() {
        parent::__construct();
    require_once __DIR__ . '/../../models/UserModel.php';
    require_once __DIR__ . '/../../scheme/helpers/pagination_helper.php';
    $this->UserModel = new UserModel();
    }

    public function index() {
    // pagination_helper already required in constructor
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $totalUsers = $this->UserModel->countAll();
        $data['users'] = $this->UserModel->getPaginated($page, $perPage);
    $data['pagination'] = function_exists('paginate') ? paginate($totalUsers, $perPage, $page, '/user/view?page=') : '';
        $this->call->view('user/view', $data);
    }

    public function create() {
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

    public function update($id) {
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
            $data['user'] = $this->UserModel->get($id);
            $this->call->view('user/update', $data);
        }
    }

    public function delete($id) {
        if($this->io->method() == 'post') {
            $this->UserModel->delete($id);
            redirect('/user/view');
        } else {
            $data['user'] = $this->UserModel->get($id);
            $this->call->view('user/delete', $data);
        }
    }
}
