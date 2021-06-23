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
		'sale_code', 'sale_total','sale_status','sale_pay', 'sale_discount', 'sale_profit', 'user_id', 'member_id', 'deleted_at'
	];

	// Dates
	protected $useTimestamps        = true;
	// Validation
	protected $validationRules      = [
		'sale_code' => 'required',
		'sale_status' => 'required',
		'sale_total' => 'required',
		'sale_pay' => 'required',
		'sale_discount' => 'required',
		'sale_profit' => 'required',
		'user_id' => 'required',
		'member_id' => 'required'
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
	
	public function getAllSale($sale_id = null){
		if($sale_id != null){
			$this->select('members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
			$this->join('members','members.id = sales.member_id');
			$this->where('sales.id',$sale_id);
			return $this->get()->getResult();
		}else{
			$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
			$this->join('members', 'members.id = sales.member_id');
			$this->join('users', 'users.id = sales.user_id');
			return $this->get()->getResult();
		}
	}
}