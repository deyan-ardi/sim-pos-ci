<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemCategoryModel extends Model
{
    protected $table            = 'item_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = ItemCategoryModel::class;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id', 'category_name', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules = [
        'category_name' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
