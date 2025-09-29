<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
	public function __construct()
	{
		parent::__construct();
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
		$data['pagination'] = paginate($totalUsers, $perPage, $page, '/user/index?page=');
		$this->call->view('user/view', $data);
	}

	// Show create user form and handle submission
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
			redirect('/user/index');
		} else {
			$this->call->view('user/create');
		}
	}

	// Show update user form and handle submission
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
			redirect('/user/index');
		} else {
			$data['user'] = $this->UserModel->find($id);
			$this->call->view('user/update', $data);
		}
	}

	// Delete user
	public function delete($id)
	{
		$this->UserModel->delete($id);
		redirect('/user/index');
	}
}
