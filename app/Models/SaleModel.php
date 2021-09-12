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
		'sale_code','sale_ket' ,'sale_total', 'sale_status', 'sale_pay', 'sale_discount', 'sale_profit', 'user_id', 'member_id', 'deleted_at'
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
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getAllSale($sale_id = null, $date_dari = null, $date_sampai = null, $ket = null)
	{
		if ($sale_id != null && $date_dari == null) {
			$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
			$this->join('members', 'members.id = sales.member_id');
			$this->join('users', 'users.id = sales.user_id');
			$this->where('sales.id', $sale_id);
			return $this->get()->getResult();
		} else if ($sale_id == null && $date_dari != null) {
			if ($ket == "M") {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
				$this->join('members', 'members.id = sales.member_id');
				$this->join('users', 'users.id = sales.user_id');
				$this->where("DATE_FORMAT(sales.updated_at,'%Y-%m')", $date_dari);
				return $this->get()->getResult();
			} else if ($ket == "Y") {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
				$this->join('members', 'members.id = sales.member_id');
				$this->join('users', 'users.id = sales.user_id');
				$this->where("DATE_FORMAT(sales.updated_at,'%Y')", $date_dari);
				return $this->get()->getResult();
			} else if ($ket == "D") {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
				$this->join('members', 'members.id = sales.member_id');
				$this->join('users', 'users.id = sales.user_id');
				$this->where("DATE_FORMAT(sales.updated_at,'%Y-%m-%d')", $date_dari);
				return $this->get()->getResult();
			} else if ($ket == "C") {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
				$this->join('members', 'members.id = sales.member_id');
				$this->join('users', 'users.id = sales.user_id');
				$this->where("sales.updated_at >=", $date_dari);
				$this->where("sales.updated_at <=", $date_sampai);
				return $this->get()->getResult();
			}
		} else {
			$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
			$this->join('members', 'members.id = sales.member_id');
			$this->join('users', 'users.id = sales.user_id');
			return $this->get()->getResult();
		}
	}
	
	public function getAllOrderWhere(){
		$this->select('users.username,sales.*,sale_details.detail_quantity,item_categories.category_name,items.item_name,items.item_code');
		$this->join('sale_details','sale_details.sale_id = sales.id');
		$this->join('items', 'items.id = sale_details.item_id');
		$this->join('item_categories', 'item_categories.id = items.category_id');
		$this->join('users', 'users.id = sales.user_id');
		$this->where('sales.sale_status', 1);
		return $this->get()->getResult();
	}

	public function getAllSaleWhere($ket){
		if($ket == "General"){
			$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
			$this->join('members', 'members.id = sales.member_id');
			$this->join('users', 'users.id = sales.user_id');
			$this->where('sales.sale_ket','General');
			return $this->get()->getResult();
		}else{
			$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,sales.*');
			$this->join('members', 'members.id = sales.member_id');
			$this->join('users', 'users.id = sales.user_id');
			$this->where('sales.sale_ket', 'Project');
			return $this->get()->getResult();
		}
	}
}
