<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * OrderSeeder
 * 
 * Seeds the database with sample orders and order items.
 * This matches the NEW order structure with order_number, customer info, etc.
 * 
 * Creates 3 sample orders:
 * 1. Large artwork order - $15,000
 * 2. Multiple artbooks - $170
 * 3. Merchandise bundle - $75
 */
class OrderSeeder extends Seeder
{
    public function run()
    {
        // ==========================================
        // Order 1: High-value artwork purchase
        // ==========================================
        $order1Id = $this->db->table('orders')->insert([
            'user_id'          => 2, // Assumes user ID 2 exists
            'order_number'     => 'EDO-001',
            'customer_name'    => 'Sakura Tanaka',
            'customer_email'   => 'sakura.tanaka@example.com',
            'customer_phone'   => '+81 90-1234-5678',
            'shipping_address' => '1-2-3 Shibuya, Shibuya-ku, Tokyo 150-0002, Japan',
            'total_amount'     => 15000.00,
            'status'           => 'delivered',
            'payment_status'   => 'paid',
            'notes'            => 'Handle with extreme care - museum quality artwork',
            'created_at'       => date('Y-m-d H:i:s', strtotime('-10 days')),
            'updated_at'       => date('Y-m-d H:i:s', strtotime('-5 days')),
        ]);
        $order1Id = $this->db->insertID();

        // Order 1 Items
        $this->db->table('order_items')->insertBatch([
            [
                'order_id'         => $order1Id,
                'product_id'       => 1, // Assumes product ID 1 exists
                'product_name'     => 'Lady Murasaki Writing at Her Desk',
                'product_category' => 'artwork',
                'quantity'         => 1,
                'price'            => 15000.00,
                'subtotal'         => 15000.00,
                'created_at'       => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at'       => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
        ]);

        // ==========================================
        // Order 2: Pending artbook order
        // ==========================================
        $order2Id = $this->db->table('orders')->insert([
            'user_id'          => 3,
            'order_number'     => 'EDO-002',
            'customer_name'    => 'Kenji Watanabe',
            'customer_email'   => 'kenji.w@example.com',
            'customer_phone'   => '+81 80-9876-5432',
            'shipping_address' => '45 Nakameguro Street, Meguro-ku, Tokyo 153-0061, Japan',
            'total_amount'     => 170.00,
            'status'           => 'processing',
            'payment_status'   => 'paid',
            'notes'            => 'Gift wrap requested',
            'created_at'       => date('Y-m-d H:i:s', strtotime('-3 days')),
            'updated_at'       => date('Y-m-d H:i:s', strtotime('-1 day')),
        ]);
        $order2Id = $this->db->insertID();

        // Order 2 Items (multiple artbooks)
        $this->db->table('order_items')->insertBatch([
            [
                'order_id'         => $order2Id,
                'product_id'       => 5,
                'product_name'     => 'Symbols of Japan by Merrily Baird',
                'product_category' => 'artbook',
                'quantity'         => 2,
                'price'            => 85.00,
                'subtotal'         => 170.00,
                'created_at'       => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at'       => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
        ]);

        // ==========================================
        // Order 3: Merchandise order
        // ==========================================
        $order3Id = $this->db->table('orders')->insert([
            'user_id'          => 2,
            'order_number'     => 'EDO-003',
            'customer_name'    => 'Sakura Tanaka',
            'customer_email'   => 'sakura.tanaka@example.com',
            'customer_phone'   => '+81 90-1234-5678',
            'shipping_address' => '1-2-3 Shibuya, Shibuya-ku, Tokyo 150-0002, Japan',
            'total_amount'     => 75.00,
            'status'           => 'delivered',
            'payment_status'   => 'paid',
            'notes'            => null,
            'created_at'       => date('Y-m-d H:i:s', strtotime('-15 days')),
            'updated_at'       => date('Y-m-d H:i:s', strtotime('-12 days')),
        ]);
        $order3Id = $this->db->insertID();

        // Order 3 Items (merchandise bundle)
        $this->db->table('order_items')->insertBatch([
            [
                'order_id'         => $order3Id,
                'product_id'       => 8,
                'product_name'     => 'Edo Tote Bag',
                'product_category' => 'merchandise',
                'quantity'         => 3,
                'price'            => 25.00,
                'subtotal'         => 75.00,
                'created_at'       => date('Y-m-d H:i:s', strtotime('-15 days')),
                'updated_at'       => date('Y-m-d H:i:s', strtotime('-15 days')),
            ],
        ]);

        echo "✓ Created 3 orders with items\n";
        echo "  - EDO-001: $15,000.00 (delivered)\n";
        echo "  - EDO-002: $170.00 (processing)\n";
        echo "  - EDO-003: $75.00 (delivered)\n";
    }
}
