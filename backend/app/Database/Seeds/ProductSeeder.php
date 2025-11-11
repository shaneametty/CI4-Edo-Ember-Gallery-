<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Artworks
            [
                'name'         => '727',
                'description'  => 'A vibrant contemporary piece by Takashi Murakami featuring his signature colorful style.',
                'price'        => 15000.00,
                'category'     => 'artwork',
                'artist'       => 'Takashi Murakami',
                'image_url'    => 'https://i.pinimg.com/736x/ac/8c/79/ac8c790b5b99c2d8ae52bd4f87f4062e.jpg',
                'stock'        => 1,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'Lady Murasaki Writing at Her Desk',
                'description'  => 'Traditional Japanese artwork depicting the famous author in classical Edo style.',
                'price'        => 8500.00,
                'category'     => 'artwork',
                'artist'       => 'Tosa Mitsuoki',
                'image_url'    => 'https://i.pinimg.com/736x/0b/f7/31/0bf73170624ab7a124adef98ebf4461d.jpg',
                'stock'        => 1,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'Dots Obsession',
                'description'  => 'An immersive installation piece showcasing infinite patterns and contemporary expression.',
                'price'        => 25000.00,
                'category'     => 'artwork',
                'artist'       => 'Yayoi Kusama',
                'image_url'    => 'https://i.pinimg.com/1200x/dd/36/39/dd3639c5b1a79caf949a5b641705a8f2.jpg',
                'stock'        => 1,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],

            // Artbooks
            [
                'name'         => 'Symbols of Japan by Merrily Baird',
                'description'  => 'A comprehensive guide to traditional Japanese symbols and their meanings.',
                'price'        => 45.00,
                'category'     => 'artbook',
                'artist'       => 'Merrily Baird',
                'image_url'    => 'https://m.media-amazon.com/images/I/81NxXiPzQ1L._AC_UF1000,1000_QL80_.jpg',
                'stock'        => 25,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'MERCURY by Entei Ryu',
                'description'  => 'Sculptural works showcasing dynamic movement and modern artistic expression.',
                'price'        => 85.00,
                'category'     => 'artbook',
                'artist'       => 'Entei Ryu',
                'image_url'    => 'https://japanese-creative-books.com/wp-content/uploads/2025/07/MERCURY-Entei-Ryu-Sculptural-Works-757x1024.jpg.webp',
                'stock'        => 15,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'My Hero Academia Ultra Artworks',
                'description'  => 'Official artbook featuring character designs and illustrations from the popular manga series.',
                'price'        => 65.00,
                'category'     => 'artbook',
                'artist'       => 'Kohei Horikoshi',
                'image_url'    => 'https://japanresell.fr/cdn/shop/files/my-hero-academia-ultra-artworks-893922.jpg?v=1745328958&width=1024',
                'stock'        => 30,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'The Artwork of Berserk',
                'description'  => 'A stunning collection of artwork from the legendary dark fantasy manga series.',
                'price'        => 95.00,
                'category'     => 'artbook',
                'artist'       => 'Miura Kentaro',
                'image_url'    => 'https://japanresell.fr/cdn/shop/products/art-book-officiel-the-artwork-of-berserk-berserk-exhibition-220146.jpg?v=1678786386&width=1024',
                'stock'        => 20,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],

            // Merchandise
            [
                'name'         => 'Edo Ember Gallery Tote Bag',
                'description'  => 'Canvas tote bag featuring our signature flame emblem and gallery logo.',
                'price'        => 25.00,
                'category'     => 'merchandise',
                'artist'       => null,
                'image_url'    => null,
                'stock'        => 50,
                'is_available' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('products')->insertBatch($data);
    }
}
