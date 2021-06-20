<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
	protected $table                = 'orders';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = OrderModel::class;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'order_code','order_total_quantity','order_total_item','user_id','supplier_id','order_status'
	];

	// Dates
	protected $useTimestamps        = true;

	// Validation
	protected $validationRules      = [
		'order_code' => 'required',
		'order_total_quantity' => 'required',
		'order_total_item' => 'required',
		'order_status' => 'required',
		'user_id' => 'required',
		'supplier_id' => 'required'
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getAllOrder($id = null, $code = null){
		if($id == null && $code == null){
			$this->select('orders.*,users.username,suppliers.supplier_name,suppliers.supplier_contact,suppliers.supplier_description');
			$this->join('suppliers','suppliers.id = orders.supplier_id');
			$this->join('users','users.id = orders.user_id');
			return $this->get()->getResult();
		} else if($id == null && $code != null) {
            $this->select('orders.*,users.username,suppliers.supplier_name,suppliers.supplier_contact,suppliers.supplier_description');
            $this->join('suppliers', 'suppliers.id = orders.supplier_id');
            $this->join('users', 'users.id = orders.user_id');
            $this->where('orders.order_code', $code);
			return $this->limit(1)->orderBy('created_at','supplier_DESC')->get()->getResult();
        }  else{
			$this->select('orders.*,users.username,suppliers.supplier_name,suppliers.supplier_contact,suppliers.supplier_description');
			$this->join('suppliers', 'suppliers.id = orders.supplier_id');
			$this->join('users', 'users.id = orders.user_id');
			$this->where('orders.id',$id);
			return $this->get()->getResult();
		}
	}
}
