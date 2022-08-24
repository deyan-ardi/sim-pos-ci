<?php

namespace App\Models;

use CodeIgniter\Model;

class PenawaranModel extends Model
{
	protected $table            = 'penawarans';
	protected $primaryKey       = 'id';
	protected $useAutoIncrement = true;
	protected $insertID         = 0;
	protected $returnType       = PenawaranModel::class;
	protected $useSoftDeletes   = false;
	protected $allowedFields    = [
		'penawaran_code', 'penawaran_ket', 'penawaran_handling', 'penawaran_total', 'penawaran_status', 'penawaran_pay', 'penawaran_discount', 'penawaran_profit', 'user_id', 'member_id', 'deleted_at',
	];

	// Dates
	protected $useTimestamps = true;

	// Validation
	protected $validationRules = [
		'penawaran_code'     => 'required',
		'penawaran_status'   => 'required',
		'penawaran_total'    => 'required',
		'penawaran_pay'      => 'required',
		'penawaran_discount' => 'required',
		'penawaran_profit'   => 'required',
		'user_id'       => 'required',
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getAllPenawaran($sale_id = null, $date_dari = null, $date_sampai = null, $ket = null)
	{
		if ($sale_id !== null && $date_dari === null) {
			$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,penawarans.*');
			$this->join('members', 'members.id = penawarans.member_id');
			$this->join('users', 'users.id = penawarans.user_id');
			$this->where('penawarans.id', $sale_id);

			return $this->get()->getResult();
		}
		if ($sale_id === null && $date_dari !== null) {
			if ($ket === 'M') {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,penawarans.*');
				$this->join('members', 'members.id = penawarans.member_id');
				$this->join('users', 'users.id = penawarans.user_id');
				$this->where("DATE_FORMAT(penawarans.updated_at,'%Y-%m')", $date_dari);

				return $this->get()->getResult();
			}
			if ($ket === 'Y') {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,penawarans.*');
				$this->join('members', 'members.id = penawarans.member_id');
				$this->join('users', 'users.id = penawarans.user_id');
				$this->where("DATE_FORMAT(penawarans.updated_at,'%Y')", $date_dari);

				return $this->get()->getResult();
			}
			if ($ket === 'D') {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,penawarans.*');
				$this->join('members', 'members.id = penawarans.member_id');
				$this->join('users', 'users.id = penawarans.user_id');
				$this->where("DATE_FORMAT(penawarans.updated_at,'%Y-%m-%d')", $date_dari);

				return $this->get()->getResult();
			}
			if ($ket === 'C') {
				$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,penawarans.*');
				$this->join('members', 'members.id = penawarans.member_id');
				$this->join('users', 'users.id = penawarans.user_id');
				$this->where('penawarans.updated_at >=', $date_dari);
				$this->where('penawarans.updated_at <=', $date_sampai);

				return $this->get()->getResult();
			}
		} else {
			$this->select('users.username, members.member_name,members.member_code,members.member_discount,members.member_contact,members.member_description,penawarans.*');
			$this->join('members', 'members.id = penawarans.member_id');
			$this->join('users', 'users.id = penawarans.user_id');

			return $this->get()->getResult();
		}
	}
}
