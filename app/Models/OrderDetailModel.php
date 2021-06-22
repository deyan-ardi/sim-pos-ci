<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
	protected $table                = 'order_details';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = OrderDetailModel::class;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'detail_quantity','user_id','order_id','item_id'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = false;

	// Validation
	protected $validationRules      = [
		'detail_quantity' => 'required',
		'user_id' => 'required',
		'order_id' => 'required',
		'item_id' => 'required',
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;


	public function getAllOrder($supplier_id = null)
	{
		if ($supplier_id != null) {
			$this->select('order_details.*,items.item_name,items.item_code,users.username');
			$this->join('items','items.id = order_details.item_id');
			$this->join('users', 'users.id = order_details.user_id');
			$this->where('order_id',$supplier_id);
			return $this->get()->getResult();
		}
	}
}
