<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestOrderModel extends Model
{
    protected $table            = 'request_orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = RequestOrderModel::class;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'request_description',
        'request_total',
        'request_status',
        'request_po_code',
        'user_id',
        'item_id',
        'alasan',
    ];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules = [
        'request_description' => 'required',
        'request_total'       => 'required',
        'request_status'      => 'required',
        'user_id'             => 'required',
        'item_id'             => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getAllOrder($id = null, $code = null)
    {
        if ($id === null && $code === null) {
            $this->select('request_orders.*,users.username,items.item_name,items.item_code');
            $this->join('items', 'items.id = request_orders.item_id');
            $this->join('users', 'users.id = request_orders.user_id');
            return $this->get()->getResult();
        }
    }

    public function getAllOrderWhere($item_id, $po)
    {
        $this->select('request_orders.*,users.username,items.item_name,items.item_code');
        $this->join('items', 'items.id = request_orders.item_id');
        $this->join('users', 'users.id = request_orders.user_id');
        $this->where('request_orders.item_id', $item_id);
        $this->where('request_orders.request_po_code', $po);
        $this->where('request_orders.request_status', '!=', 1);
        return $this->get()->getResult();
    }

    public function getAllOrderWherePenawaranCode($po)
    {
        $this->select('request_orders.*,users.username,items.item_name,items.item_code');
        $this->join('items', 'items.id = request_orders.item_id');
        $this->join('users', 'users.id = request_orders.user_id');
        $this->where('request_orders.request_po_code', $po);
        $this->where('request_orders.request_status', '!=', 1);
        return $this->get()->getResult();
    }
}
