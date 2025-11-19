<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * OrderItemsModel
 * 
 * Handles database operations for the order_items table.
 * Each record represents one product in an order.
 * 
 * Example: Order #EDO-001 might have 3 order_items:
 * - 1x Artwork "Lady Murasaki" @ $15,000
 * - 2x Artbook "Symbols of Japan" @ $85 each
 * - 1x Merchandise "Edo Tote Bag" @ $25
 */
class OrderItemsModel extends Model
{
    protected $table            = 'order_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false; // Order items don't need soft delete
    protected $protectFields    = true;
    
    /**
     * Allowed Fields
     * Note: We store product name/category at time of purchase
     * because products might change later
     */
    protected $allowedFields = [
        'order_id',
        'product_id',
        'product_name',      // Snapshot of product name
        'product_category',  // Snapshot of category
        'quantity',
        'price',            // Price at time of purchase
        'subtotal',         // quantity × price
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get Items for an Order
     * 
     * @param int $orderId The order ID
     * @return array Array of order items
     */
    public function getOrderItems($orderId)
    {
        return $this->where('order_id', $orderId)->findAll();
    }

    /**
     * Get Items with Product Details
     * 
     * Joins with products table to get current product info
     * (useful for admin view to see if product still exists)
     * 
     * @param int $orderId The order ID
     * @return array Array of items with product details
     */
    public function getItemsWithProducts($orderId)
    {
        $builder = $this->db->table('order_items');
        $builder->select('order_items.*, products.stock as current_stock');
        $builder->join('products', 'products.id = order_items.product_id', 'left');
        $builder->where('order_items.order_id', $orderId);
        
        return $builder->get()->getResult();
    }
}