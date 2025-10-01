<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

    private $user_store_file = APP_DIR . 'runtime' . DIRECTORY_SEPARATOR . 'users.json';

    public function __construct()
    {
        parent::__construct();
        $this->ensure_user_store();
    }

    public function login()
    {
        if ($this->io->method() === 'post') {
            $username = trim($this->io->post('username'));
            $password = trim($this->io->post('password'));

            $user = $this->find_user_by_username($username);
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

            if ($this->find_user_by_username($username)) {
                $this->call->view('auth_register', ['error' => 'Username already exists']);
                return;
            }

            $users = $this->read_users();
            $users[] = [
                'username' => $username,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 'user'
            ];
            $this->write_users($users);

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

    private function ensure_user_store()
    {
        $dir = dirname($this->user_store_file);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
        if (!file_exists($this->user_store_file)) {
            $default = [
                [
                    'username' => 'admin',
                    'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                    'role' => 'admin'
                ]
            ];
            file_put_contents($this->user_store_file, json_encode($default, JSON_PRETTY_PRINT));
        }
    }

    private function read_users()
    {
        $content = @file_get_contents($this->user_store_file);
        if ($content === FALSE || trim($content) === '') {
            return [];
        }
        $decoded = json_decode($content, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function write_users($users)
    {
        file_put_contents($this->user_store_file, json_encode($users, JSON_PRETTY_PRINT));
    }

    private function find_user_by_username($username)
    {
        foreach ($this->read_users() as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return $user;
            }
        }
        return null;
    }
}
?>

