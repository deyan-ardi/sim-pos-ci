<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
	public function __construct()
	{
		$this->m_user = new UserModel();
	}
	public function index()
	{
		$data = [
			"user" => $this->m_user->getUserRole(user()->id),
		];
		return view('Admin/page/index', $data);
	}
}