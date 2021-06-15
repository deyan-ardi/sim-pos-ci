<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Member extends BaseController
{
	public function index()
	{
		return view('Admin/page/members');
	}
}