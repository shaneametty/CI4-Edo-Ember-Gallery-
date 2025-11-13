<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Product extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'price'        => 'float',
        'stock'        => 'integer',
        'is_available' => 'boolean',
    ];

    // Helper to get formatted price
    public function getFormattedPrice()
    {
        return '$' . number_format($this->attributes['price'], 2);
    }

    // Helper to check if product is in stock
    public function isInStock(): bool
    {
        return $this->attributes['stock'] > 0;
    }

    // Helper to check if product is available
    public function isAvailable(): bool
    {
        return (bool) $this->attributes['is_available'];
    }

    // Helper to get category badge color
    public function getCategoryColor(): string
    {
        return match($this->attributes['category']) {
            'artwork' => 'primary',
            'artbook' => 'secondary',
            'merchandise' => 'green-500',
            default => 'gray-500'
        };
    }
}