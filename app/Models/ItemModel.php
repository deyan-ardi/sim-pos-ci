<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
	protected $table                = 'items';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = ItemModel::class;
	protected $useSoftDeletes       = false;
	protected $allowedFields        = [
		'item_image', 'item_code', 'item_name','item_before_sale','item_discount', 'item_profit', 'item_merk', 'item_type', 'item_weight', 'item_length', 'item_width', 'item_height', 'item_hpp', 'item_stock', 'item_sale', 'item_description', 'category_id', 'supplier_id', 'deleted_at','item_warehouse_a', 'item_warehouse_b', 'item_warehouse_c', 'item_warehouse_d'
	];
	// Dates
	protected $useTimestamps        = true;

	// Validation
	protected $validationRules      = [
		'item_image' => 'required',
		'item_code' => 'required|max_length[50]',
		'item_name' => 'required',
		'item_hpp' => 'required',
		'item_warehouse_a' => 'required',
		'item_warehouse_b' => 'required',
		'item_warehouse_c' => 'required',
		'item_warehouse_d' => 'required',
		'item_stock' => 'required',
		'item_profit' => 'required',
		'item_before_sale' => 'required',
		'item_sale' => 'required',
		'category_id' => 'required',
		'supplier_id' => 'required'
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getAllItem($id = null,$supplier_id = null)
	{
		if ($id == null && $supplier_id == null) {
			$this->select('items.*,suppliers.supplier_name,item_categories.category_name');
			$this->join('item_categories', 'item_categories.id = items.category_id');
			$this->join('suppliers', 'suppliers.id = items.supplier_id');
			return $this->get()->getResult();
		}else if($id == null && $supplier_id != null){
			$this->select('items.*,suppliers.supplier_name,item_categories.category_name');
			$this->join('item_categories', 'item_categories.id = items.category_id');
			$this->join('suppliers', 'suppliers.id = items.supplier_id');
			$this->where('supplier_id',$supplier_id);
			return $this->get()->getResult();
		}else{
			$this->select('items.*,suppliers.supplier_name,item_categories.category_name');
			$this->join('item_categories', 'item_categories.id = items.category_id');
			$this->join('suppliers', 'suppliers.id = items.supplier_id');
			$this->where('items.id', $id);
			return $this->get()->getResult();
		}
	}
}