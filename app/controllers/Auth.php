<?php
class Auth extends Controller {
    public function __construct() {
        parent::__construct();
        // No need to load User_model for hardcoded login
    }

    public function login() {
        if ($this->io->post()) {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['user'] = $username;
                redirect('author');
            } else {
                $data['error'] = 'Invalid credentials';
                echo '<pre>DEBUG: Auth login reached, invalid credentials</pre>';
                $this->call->view('login', $data);
            }
        } else {
            echo '<pre>DEBUG: Auth login reached, GET request</pre>';
            $this->call->view('login');
        }
    }


    public function logout() {
        session_destroy();
        redirect('auth/login');
    }
}
