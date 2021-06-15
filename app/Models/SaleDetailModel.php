<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleDetailModel extends Model
{
	protected $table                = 'sale_details';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = SaleDetail::class;
	protected $useSoftDeletes       = false;
	protected $allowedFields        = [
		'detail_total', 'detail_quantity', 'user_id', 'item_id', 'sale_id'
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = false;

	// Validation
	protected $validationRules      = [
		'detail_total' => 'required',
		'detail_quantity' => 'required',
		'user_id' => 'required',
		'item_id' => 'required',
		'sale_id' => 'required',
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}