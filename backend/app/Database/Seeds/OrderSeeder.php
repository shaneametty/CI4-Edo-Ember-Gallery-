<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'        => 2,
                'product_id'     => 1,
                'quantity'       => 1,
                'total_price'    => 15000.00,
                'order_status'   => 'Completed',
                'payment_status' => 'Paid',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'user_id'        => 3,
                'product_id'     => 5,
                'quantity'       => 2,
                'total_price'    => 170.00,
                'order_status'   => 'Pending',
                'payment_status' => 'Unpaid',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'user_id'        => 2,
                'product_id'     => 8,
                'quantity'       => 3,
                'total_price'    => 75.00,
                'order_status'   => 'Completed',
                'payment_status' => 'Paid',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-9 days')),
            ],
        ];

        $this->db->table('orders')->insertBatch($data);
    }
}
