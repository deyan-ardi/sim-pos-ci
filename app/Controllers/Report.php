<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Report extends BaseController
{
	public function index()
	{

		return view('Admin/page/report_payment');
	}
}
