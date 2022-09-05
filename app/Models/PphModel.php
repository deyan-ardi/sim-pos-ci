<?php

namespace App\Models;

use CodeIgniter\Model;

class PphModel extends Model
{
    protected $table            = 'pphs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = PphModel::class;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id', 'pph_value'];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules = [
        'pph_value' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAllPPh()
    {
        return $this->select('*')->get()->getResult();
    }
}
