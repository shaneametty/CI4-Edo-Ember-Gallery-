<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Order extends Entity
{
    protected $attributes = [
        'user_id'        => null,
        'product_id'     => null,
        'quantity'       => 1,
        'total_price'    => 0.00,
        'order_status'   => 'Pending',
        'payment_status' => 'Unpaid',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
