<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->StudentModel = new StudentModel();
    }

    public function index()
    {
    $data['students'] = $this->StudentModel->getAllArray();
        $this->call->view('student/view', $data);
    }

    public function create()
    {
        if($this->io->method() == 'post') {
            $name = $this->io->post('name');
            $email = $this->io->post('email');
            $data = [ 'name' => $name, 'email' => $email ];
            $this->StudentModel->insert($data);
            redirect('/student');
        } else {
            $this->call->view('student/create');
        }
    }

    public function update($id)
    {
        if($this->io->method() == 'post') {
            $name = $this->io->post('name');
            $email = $this->io->post('email');
            $data = [ 'name' => $name, 'email' => $email ];
            $this->StudentModel->update($id, $data);
            redirect('/student');
        } else {
            $data['student'] = $this->StudentModel->get($id);
            $this->call->view('student/update', $data);
        }
    }

    public function delete($id)
    {
        $this->StudentModel->delete($id);
        redirect('/student');
    }
}
