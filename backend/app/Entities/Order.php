<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Order Entity
 * 
 * Represents a single order in the system.
 * Entities provide a clean object-oriented way to work with database records.
 * 
 * Benefits of using Entity:
 * - Type safety: Can define attribute types
 * - Data casting: Automatically convert dates, numbers, etc.
 * - Mutators/Accessors: Transform data on get/set
 * - Clean code: $order->customer_name instead of $order['customer_name']
 */
class Order extends Entity
{
    /**
     * Default Attributes
     * These are the default values when creating a new order
     */
    protected $attributes = [
        'user_id'          => null,
        'order_number'     => null,
        'customer_name'    => null,
        'customer_email'   => null,
        'customer_phone'   => null,
        'shipping_address' => null,
        'total_amount'     => 0.00,
        'status'           => 'pending',
        'payment_status'   => 'unpaid',
        'notes'            => null,
    ];

    /**
     * Date Fields
     * These will be automatically converted to DateTime objects
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Casts
     * Automatically cast these fields to specified types
     */
    protected $casts = [
        'user_id'      => 'integer',
        'total_amount' => 'float',
    ];

    /**
     * Datamap
     * Maps database field names to entity property names
     * (Optional - only needed if you want different names)
     */
    protected $datamap = [];

    /**
     * Accessor: Get formatted total amount
     * 
     * Usage: $order->formatted_total
     * Returns: "$1,234.56"
     */
    public function getFormattedTotal(): string
    {
        return '$' . number_format($this->attributes['total_amount'], 2);
    }

    /**
     * Accessor: Get status badge color
     * 
     * Usage: $order->status_color
     * Returns: Color class for status badge
     */
    public function getStatusColor(): string
    {
        $colors = [
            'pending'    => 'yellow',
            'processing' => 'blue',
            'shipped'    => 'purple',
            'delivered'  => 'green',
            'cancelled'  => 'red',
        ];

        return $colors[$this->attributes['status']] ?? 'gray';
    }

    /**
     * Accessor: Get payment status badge color
     * 
     * Usage: $order->payment_color
     * Returns: Color class for payment badge
     */
    public function getPaymentColor(): string
    {
        return $this->attributes['payment_status'] === 'paid' ? 'green' : 'red';
    }

    /**
     * Accessor: Check if order can be cancelled
     * 
     * Usage: $order->can_cancel
     * Returns: true if order can be cancelled
     */
    public function getCanCancel(): bool
    {
        return in_array($this->attributes['status'], ['pending', 'processing']);
    }

    /**
     * Accessor: Check if order is completed
     * 
     * Usage: $order->is_completed
     */
    public function getIsCompleted(): bool
    {
        return $this->attributes['status'] === 'delivered';
    }
}