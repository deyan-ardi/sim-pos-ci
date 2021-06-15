<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
	protected $table                = 'suppliers';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = Supplier::class;
	protected $useSoftDeletes       = true;
	protected $allowedFields        = [
		'supplier_name', 'supplier_contact', 'supplier_description', 'deleted_at'
	];

	// Dates
	protected $useTimestamps        = true;
	// Validation
	protected $validationRules      = [
		'supplier_name' => 'required',
		'supplier_contact' => 'required',
		'supplier_description' => 'required',
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}