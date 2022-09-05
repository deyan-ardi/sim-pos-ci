<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = 'suppliers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = SupplierModel::class;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'id', 'supplier_name', 'supplier_contact', 'supplier_description', 'deleted_at', 'supplier_email', 'supplier_address',
    ];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules = [
        'supplier_name'        => 'required',
        'supplier_contact'     => 'required',
        'supplier_email'       => 'required',
        'supplier_address'     => 'required',
        'supplier_description' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
