<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Category extends BaseController
{
	public function index()
	{
		return view('Admin/page/categories');
	}
}