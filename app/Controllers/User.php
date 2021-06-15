<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
	public function index()
	{
		return view('Admin/page/users');
	}
}