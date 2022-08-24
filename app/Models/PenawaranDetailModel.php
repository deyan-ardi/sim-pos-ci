<?php

namespace App\Models;

use CodeIgniter\Model;

class PenawaranDetailModel extends Model
{
	protected $table            = 'penawaran_details';
	protected $primaryKey       = 'id';
	protected $useAutoIncrement = true;
	protected $insertID         = 0;
	protected $returnType       = PenawaranDetailModel::class;
	protected $useSoftDeletes   = false;
	protected $allowedFields    = [
		'detail_total', 'detail_quantity', 'user_id', 'item_id', 'penawaran_id',
	];

	// Dates
	protected $useTimestamps = true;
	protected $dateFormat    = 'datetime';
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = false;

	// Validation
	protected $validationRules = [
		'detail_total'    => 'required',
		'detail_quantity' => 'required',
		'user_id'         => 'required',
		'item_id'         => 'required',
		'penawaran_id'         => 'required',
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
	public function getAllPenawaranDetail($penawaran_id)
	{
		$this->select('penawaran_details.*,items.item_name,items.item_code,items.item_sale');
		$this->join('items', 'items.id = penawaran_details.item_id');
		$this->where('penawaran_details.penawaran_id', $penawaran_id);

		return $this->get()->getResult();
	}
}
