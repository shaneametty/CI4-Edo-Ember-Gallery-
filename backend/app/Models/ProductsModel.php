<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\Product';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'description',
        'price',
        'category',
        'artist',
        'image_url',
        'stock',
        'is_available',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'     => 'required|min_length[3]|max_length[255]',
        'price'    => 'required|decimal',
        'category' => 'required|in_list[artwork,artbook,merchandise]',
        'stock'    => 'required|integer',
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'Product name is required.',
        ],
        'price' => [
            'required' => 'Price is required.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
}