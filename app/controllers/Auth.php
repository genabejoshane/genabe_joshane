<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

    public function login()
    {
        if ($this->io->method() === 'post') {
            $username = trim($this->io->post('username'));
            $password = trim($this->io->post('password'));

            $user = $this->User_model->find_by_username($username);
            if ($user && password_verify($password, $user['password_hash'])) {
                $this->session->set_userdata([
                    'auth_logged_in' => TRUE,
                    'auth_username' => $user['username'],
                    'auth_role' => $user['role'] ?? 'user',
                ]);
                redirect(site_url('student/all'));
            } else {
                $data['error'] = 'Invalid credentials';
                $this->call->view('auth_login', $data);
                return;
            }
        }

        $this->call->view('auth_login');
    }

    public function register()
    {
        if ($this->io->method() === 'post') {
            $username = trim($this->io->post('username'));
            $password = trim($this->io->post('password'));

            if ($username === '' || $password === '') {
                $this->call->view('auth_register', ['error' => 'Username and password are required']);
                return;
            }

            if ($this->User_model->find_by_username($username)) {
                $this->call->view('auth_register', ['error' => 'Username already exists']);
                return;
            }

            $this->User_model->create_user($username, password_hash($password, PASSWORD_DEFAULT), 'user');

            $this->session->set_userdata([
                'auth_logged_in' => TRUE,
                'auth_username' => $username,
                'auth_role' => 'user',
            ]);
            redirect(site_url('student/all'));
            return;
        }

        $this->call->view('auth_register');
    }

    public function logout()
    {
        $this->session->unset_userdata(['auth_logged_in', 'auth_username', 'auth_role']);
        redirect(site_url('/'));
    }
}
?>

