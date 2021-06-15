<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
	protected $table                = 'items';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = Item::class;
	protected $useSoftDeletes       = true;
	protected $allowedFields        = [
		'item_code', 'item_name', 'item_description', 'category_id', 'supplier_id', 'deleted_at'
	];
	// Dates
	protected $useTimestamps        = true;

	// Validation
	protected $validationRules      = [
		'item_code' => 'required|max_length[15]',
		'item_name' => 'required',
		'item_description' => 'required',
		'category_id' => 'required',
		'supplier_id' => 'required'
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}