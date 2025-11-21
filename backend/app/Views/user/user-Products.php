<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Our Products']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header'); ?>

    <section class="px-10 py-16">

        <h1 class="text-4xl font-bold text-[var(--secondary)] mb-2">Our Products</h1>
        <p class="text-[var(--neutral)]/80 mb-10">Browse our collection of artworks, artbooks, and merchandise!</p>

        <?php
        $products = [
            ['name' => '727', 'description' => 'A vibrant contemporary piece by Takashi Murakami featuring his signature colorful style.', 'price' => 15000, 'image_url' => 'https://i.pinimg.com/736x/ac/8c/79/ac8c790b5b99c2d8ae52bd4f87f4062e.jpg'],
            ['name' => 'Lady Murasaki Writing at Her Desk', 'description' => 'Traditional Japanese artwork depicting the famous author in classical Edo style.', 'price' => 8500, 'image_url' => 'https://i.pinimg.com/736x/0b/f7/31/0bf73170624ab7a124adef98ebf4461d.jpg'],
            ['name' => 'Dots Obsession', 'description' => 'An immersive installation piece showcasing infinite patterns and contemporary expression.', 'price' => 25000, 'image_url' => 'https://i.pinimg.com/1200x/dd/36/39/dd3639c5b1a79caf949a5b641705a8f2.jpg'],
            ['name' => 'Symbols of Japan by Merrily Baird', 'description' => 'A comprehensive guide to traditional Japanese symbols and their meanings.', 'price' => 45, 'image_url' => 'https://m.media-amazon.com/images/I/81NxXiPzQ1L._AC_UF1000,1000_QL80_.jpg'],
            ['name' => 'MERCURY by Entei Ryu', 'description' => 'Sculptural works showcasing dynamic movement and modern artistic expression.', 'price' => 85, 'image_url' => 'https://japanese-creative-books.com/wp-content/uploads/2025/07/MERCURY-Entei-Ryu-Sculptural-Works-757x1024.jpg.webp'],
            ['name' => 'My Hero Academia Ultra Artworks', 'description' => 'Official artbook featuring character designs and illustrations from the popular manga series.', 'price' => 65, 'image_url' => 'https://japanresell.fr/cdn/shop/files/my-hero-academia-ultra-artworks-893922.jpg?v=1745328958&width=1024'],
            ['name' => 'The Artwork of Berserk', 'description' => 'A stunning collection of artwork from the legendary dark fantasy manga series.', 'price' => 95, 'image_url' => 'https://japanresell.fr/cdn/shop/products/art-book-officiel-the-artwork-of-berserk-berserk-exhibition-220146.jpg?v=1678786386&width=1024'],
            ['name' => 'Edo Ember Gallery Tote Bag', 'description' => 'Canvas tote bag featuring our signature flame emblem and gallery logo.', 'price' => 25, 'image_url' => null]
        ];
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach ($products as $p): ?>
                <div class="relative bg-[var(--accent)] border border-[var(--secondary)] rounded-2xl shadow-lg overflow-hidden h-[420px] flex flex-col justify-between hover:shadow-[0_0_15px_var(--secondary)] transition">

                    <div class="absolute inset-0 border-2 border-[var(--primary)] rounded-2xl opacity-20 pointer-events-none"></div>

                    <?php if (!empty($p['image_url'])): ?>
                        <div class="h-48 bg-cover bg-center" style="background-image: url('<?= esc($p['image_url']) ?>');"></div>
                    <?php endif; ?>

                    <div class="p-6 flex flex-col justify-between flex-grow text-[var(--neutral)] relative z-10">
                        <div>
                            <h3 class="text-xl font-bold text-[var(--secondary)] mb-2"><?= esc($p['name']) ?></h3>
                            <p class="text-[var(--neutral)]/80 mb-4"><?= esc($p['description']) ?></p>
                            <p class="text-[var(--primary)] font-semibold mb-6">₱<?= number_format($p['price'], 2) ?></p>
                        </div>

                        <a href="#"
                            class="border-2 border-[var(--primary)] text-[var(--primary)] font-semibold py-2 px-4 rounded-lg text-center hover:bg-[var(--primary)] hover:text-[var(--accent)] transition">
                            Add to Cart
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </section>
</body>

</html>