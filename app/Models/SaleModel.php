<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
	protected $table                = 'sales';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = SaleModel::class;
	protected $useSoftDeletes       = false;
	protected $allowedFields        = [
		'sale_code', 'sale_total', 'sale_discount', 'sale_profit', 'user_id', 'member_id', 'deleted_at'
	];

	// Dates
	protected $useTimestamps        = true;
	// Validation
	protected $validationRules      = [
		'sale_code' => 'required',
		'sale_total' => 'required',
		'sale_discount' => 'required',
		'sale_profit' => 'required',
		'user_id' => 'required',
		'member_id' => 'required'
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}