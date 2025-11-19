<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * OrdersModel
 * 
 * Handles database operations for the orders table.
 * This model uses soft deletes and timestamps.
 * 
 * Key Features:
 * - Soft deletes: Orders are marked as deleted, not actually removed
 * - Auto-generates order numbers (EDO-XXX format)
 * - Includes method to fetch order with all items
 */
class OrdersModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object'; // Returns objects for easier property access
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    
    /**
     * Allowed Fields
     * These are the fields that can be mass-assigned
     */
    protected $allowedFields = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'total_amount',
        'status',
        'payment_status',
        'notes',
    ];

    // Timestamp Configuration
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation Rules (optional - can also validate in controller)
    protected $validationRules = [
        'user_id'        => 'required|integer',
        'customer_name'  => 'required|min_length[3]|max_length[255]',
        'customer_email' => 'required|valid_email',
        'total_amount'   => 'required|decimal',
        'status'         => 'required|in_list[pending,processing,shipped,delivered,cancelled]',
        'payment_status' => 'required|in_list[unpaid,paid]',
    ];

    protected $validationMessages = [
        'customer_email' => [
            'valid_email' => 'Please provide a valid email address',
        ],
    ];

    /**
     * Before Insert Callback
     * Automatically generates order number before inserting
     * 
     * @param array $data Data being inserted
     * @return array Modified data with order number
     */
    protected $beforeInsert = ['generateOrderNumber'];

    protected function generateOrderNumber(array $data)
    {
        // Only generate if not already set
        if (!isset($data['data']['order_number'])) {
            // Get the last order ID
            $lastOrder = $this->orderBy('id', 'DESC')->first();
            $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
            
            // Format: EDO-001, EDO-002, etc.
            $data['data']['order_number'] = 'EDO-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        }
        
        return $data;
    }

    /**
     * Get Order with Items
     * 
     * Fetches a single order along with all its order items.
     * This is useful for displaying order details page.
     * 
     * @param int $orderId The order ID
     * @return object|null Order object with items property, or null if not found
     */
    public function getOrderWithItems($orderId)
    {
        // Get the order
        $order = $this->find($orderId);
        
        if (!$order) {
            return null;
        }

        // Get order items
        $orderItemsModel = new \App\Models\OrderItemsModel();
        $order->items = $orderItemsModel->where('order_id', $orderId)->findAll();

        return $order;
    }

    /**
     * Get Orders with User Info
     * 
     * Fetches orders joined with user information.
     * Useful for displaying orders list with customer details.
     * 
     * @param int $limit Number of orders to fetch (default: all)
     * @return array Array of orders with user info
     */
    public function getOrdersWithUsers($limit = null)
    {
        $builder = $this->db->table('orders');
        $builder->select('orders.*, users.first_name, users.last_name, users.email as user_email');
        $builder->join('users', 'users.id = orders.user_id', 'left');
        $builder->where('orders.deleted_at', null);
        $builder->orderBy('orders.id', 'DESC');
        
        if ($limit) {
            $builder->limit($limit);
        }
        
        return $builder->get()->getResult();
    }
}