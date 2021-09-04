<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
	protected $table                = 'members';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = MemberModel::class;
	protected $useSoftDeletes       = false;
	protected $allowedFields        = [
		'member_name','member_code', 'member_contact','member_discount', 'member_description', 'member_email', 'deleted_at'
	];

	// Dates
	protected $useTimestamps        = true;
	// Validation
	protected $validationRules      = [
		'member_code' => 'required',
		'member_name' => 'required',
		'member_contact' => 'required',
		'member_email' => 'required',
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}