<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'is_active' => 'boolean',
    ];

    // Accessor for full name
    public function getFullName()
    {
        $middle = $this->attributes['middle_name'] ? ' ' . $this->attributes['middle_name'] . ' ' : ' ';
        return $this->attributes['first_name'] . $middle . $this->attributes['last_name'];
    }

    // Mutator for password hashing
    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    // Helper to check if user is admin
    public function isAdmin(): bool
    {
        return $this->attributes['type'] === 'admin';
    }

    // Helper to check if user is active
    public function isActive(): bool
    {
        return (bool) $this->attributes['is_active'];
    }
}