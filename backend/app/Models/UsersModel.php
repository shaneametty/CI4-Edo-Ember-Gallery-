<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\User';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'type',
        'is_active',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation - Separate rules for insert and update
    protected $validationRules      = [];
    
    protected $validationMessages   = [
        'email' => [
            'is_unique' => 'This email is already registered.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword', 'setInsertValidation'];
    protected $beforeUpdate   = ['hashPassword', 'setUpdateValidation'];

    /**
     * Set validation rules for INSERT operations
     */
    protected function setInsertValidation(array $data)
    {
        $this->validationRules = [
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name'  => 'required|min_length[2]|max_length[100]',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'password'   => 'required|min_length[6]',
            'type'       => 'required|in_list[admin,user]',
        ];
        
        return $data;
    }

    /**
     * Set validation rules for UPDATE operations
     */
    protected function setUpdateValidation(array $data)
    {
        // Get the ID being updated
        $id = $data['id'][0] ?? null;
        
        $this->validationRules = [
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name'  => 'required|min_length[2]|max_length[100]',
            'email'      => "required|valid_email|is_unique[users.email,id,{$id}]",
            // Password is optional on update
            'password'   => 'permit_empty|min_length[6]',
        ];
        
        return $data;
    }

    /**
     * Hash password before saving
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}