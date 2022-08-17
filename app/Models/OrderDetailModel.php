<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table            = 'order_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = OrderDetailModel::class;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'detail_quantity', 'user_id', 'order_id', 'item_id', 'receiving_total', 'progress_total', 'status_order','receiving_remark',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = false;

    // Validation
    protected $validationRules = [
        'receiving_total' => 'required',
        'progress_total'  => 'required',
        'status_order'    => 'required',
        'detail_quantity' => 'required',
        'user_id'         => 'required',
        'order_id'        => 'required',
        'item_id'         => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getAllOrder($supplier_id = null)
    {
        if ($supplier_id !== null) {
            $this->select('order_details.*,items.item_name,items.item_code,items.item_hpp,items.item_before_sale,items.item_sale,users.username');
            $this->join('items', 'items.id = order_details.item_id');
            $this->join('users', 'users.id = order_details.user_id');
            $this->where('order_id', $supplier_id);

            return $this->get()->getResult();
        }
    }

    public function getAllOrderWhere($id)
    {
        $this->select('order_details.*,items.item_name,items.item_code,items.item_hpp,items.item_before_sale,items.item_sale,users.username');
        $this->join('items', 'items.id = order_details.item_id');
        $this->join('users', 'users.id = order_details.user_id');
        $this->where('order_details.id', $id);
        return $this->get()->getResult();
    }
}
