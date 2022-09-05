<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceSettingModel extends Model
{
    protected $table            = 'invoice_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = InvoiceSettingModel::class;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id', 'key', 'value', 'position', 'header'];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules = [
        'key' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
