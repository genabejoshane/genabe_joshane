<?php
class Auth extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('User_model');
    }

    public function login() {
        if ($this->io->post()) {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $user = $this->User_model->get_by_username($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $username;
                redirect('author');
            } else {
                $data['error'] = 'Invalid credentials';
                $this->call->view('login', $data);
            }
        } else {
            $this->call->view('login');
        }
    }

    public function register() {
        if ($this->io->post()) {
            $username = $this->io->post('username');
            $password = password_hash($this->io->post('password'), PASSWORD_DEFAULT);
            $user = $this->User_model->get_by_username($username);
            if ($user) {
                $data['error'] = 'Username already exists.';
                $this->call->view('register', $data);
            } else {
                $this->User_model->create(['username' => $username, 'password' => $password]);
                redirect('auth/login');
            }
        } else {
            $this->call->view('register');
        }
    }

    public function logout() {
        session_destroy();
        redirect('auth/login');
    }
}
