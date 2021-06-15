<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Supplier extends BaseController
{
	public function index()
	{
		return view('Admin/page/suppliers');
	}

	public function report()
	{
		return view('Admin/page/supplier_report');
	}

	public function order()
	{
		return view('Admin/page/supplier_order');
	}
}