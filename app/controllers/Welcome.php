<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Welcome extends Controller {
	public function index() {
		require_once __DIR__ . '/../../scheme/helpers/pagination_helper.php';
		require_once __DIR__ . '/../models/UserModel.php';
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perPage = 10;
		$userModel = new \app\models\UserModel();
		$totalUsers = $userModel->countAll();
		$data['users'] = $userModel->getPaginated($page, $perPage);
		$data['pagination'] = paginate($totalUsers, $perPage, $page, '/welcome?page=');
		$this->call->view('welcome_page', $data);
	}
}
?>