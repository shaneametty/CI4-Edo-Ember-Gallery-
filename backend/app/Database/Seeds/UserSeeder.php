<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'first_name'  => 'Admin',
                'middle_name' => null,
                'last_name'   => 'User',
                'email'       => 'admin@edoembergallery.com',
                'password'    => password_hash('admin123', PASSWORD_DEFAULT),
                'type'        => 'admin',
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'  => 'John',
                'middle_name' => 'A',
                'last_name'   => 'Doe',
                'email'       => 'user@edoembergallery.com',
                'password'    => password_hash('user123', PASSWORD_DEFAULT),
                'type'        => 'user',
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'first_name'  => 'Jane',
                'middle_name' => null,
                'last_name'   => 'Smith',
                'email'       => 'jane@edoembergallery.com',
                'password'    => password_hash('user123', PASSWORD_DEFAULT),
                'type'        => 'user',
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('users')->insertBatch($data);
    }
}
