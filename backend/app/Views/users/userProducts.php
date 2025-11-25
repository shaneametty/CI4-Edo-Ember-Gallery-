<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Product Gallery']) ?>

<head>
    <?= view('components/head', ['title' => '🔥 Product Gallery']) ?>
</head>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Product Gallery</h1>
            <p class="text-[var(--neutral)]/70 mt-2">Explore our collection of artworks, artbooks, and merchandise</p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex gap-4 mb-8 overflow-x-auto">
            <button onclick="filterCategory('all')" 
                    class="category-filter active px-6 py-3 rounded-lg font-semibold transition duration-200 whitespace-nowrap"
                    data-category="all">
                All Products
            </button>
            <button onclick="filterCategory('artwork')" 
                    class="category-filter px-6 py-3 rounded-lg font-semibold transition duration-200 whitespace-nowrap"
                    data-category="artwork">
                Artworks
            </button>
            <button onclick="filterCategory('artbook')" 
                    class="category-filter px-6 py-3 rounded-lg font-semibold transition duration-200 whitespace-nowrap"
                    data-category="artbook">
                Artbooks
            </button>
            <button onclick="filterCategory('merchandise')" 
                    class="category-filter px-6 py-3 rounded-lg font-semibold transition duration-200 whitespace-nowrap"
                    data-category="merchandise">
                Merchandise
            </button>
        </div>

        <!-- Products Grid -->
        <?php if (empty($products)): ?>
            <!-- Empty State -->
            <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-12 border border-[var(--secondary)]/20 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-[var(--secondary)]/20 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-box-open text-[var(--secondary)] text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-[var(--neutral)] mb-3">No Products Available</h2>
                <p class="text-[var(--neutral)]/70 mb-6">Check back later for new items!</p>
            </div>
        <?php else: ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="productsGrid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card bg-[#1b1b1b] rounded-lg shadow-xl border border-[var(--secondary)]/20 overflow-hidden hover:border-[var(--secondary)]/40 transition duration-200"
                         data-category="<?= esc($product->category) ?>">
                        
                        <!-- Product Image -->
                        <div class="relative h-64 bg-[var(--secondary)]/10 overflow-hidden">
                            <?php if ($product->image_url): ?>
                                <img src="<?= esc($product->image_url) ?>" 
                                     alt="<?= esc($product->name) ?>"
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fa-solid fa-image text-[var(--secondary)] text-6xl"></i>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Category Badge -->
                            <?php
                            $categoryColors = [
                                'artwork' => 'primary',
                                'artbook' => 'secondary',
                                'merchandise' => 'green-500'
                            ];
                            $color = $categoryColors[$product->category] ?? 'gray-500';
                            ?>
                            <div class="absolute top-4 right-4">
                                <span class="bg-[var(--<?= $color ?>)]/90 text-white px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm">
                                    <?= ucfirst(esc($product->category)) ?>
                                </span>
                            </div>

                            <!-- Stock Status Badge -->
                            <?php if ($product->stock <= 5 && $product->stock > 0): ?>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-orange-500/90 text-white px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm">
                                        Only <?= $product->stock ?> left
                                    </span>
                                </div>
                            <?php elseif ($product->stock == 0): ?>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-red-500/90 text-white px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm">
                                        Out of Stock
                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-green-500/90 text-white px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm">
                                        In Stock
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-[var(--neutral)] mb-2">
                                <?= esc($product->name) ?>
                            </h3>

                            <?php if ($product->artist): ?>
                                <p class="text-[var(--neutral)]/60 text-sm mb-3">
                                    <i class="fa-solid fa-user mr-1"></i>
                                    by <?= esc($product->artist) ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($product->description): ?>
                                <p class="text-[var(--neutral)]/80 text-sm mb-4 line-clamp-3">
                                    <?= esc($product->description) ?>
                                </p>
                            <?php endif; ?>

                            <div class="flex items-center justify-between pt-4 border-t border-[var(--secondary)]/20">
                                <div>
                                    <p class="text-[var(--primary)] font-bold text-2xl">
                                        $<?= number_format($product->price, 2) ?>
                                    </p>
                                    <p class="text-[var(--neutral)]/60 text-xs">
                                        <i class="fa-solid fa-box mr-1"></i>
                                        <?= $product->stock ?> available
                                    </p>
                                </div>

                                <!-- No Order Button - Just Show Availability -->
                                <div class="text-right">
                                    <?php if ($product->stock > 0): ?>
                                        <span class="inline-flex items-center gap-2 text-green-500 text-sm font-semibold">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Available
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-2 text-red-500 text-sm font-semibold">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            Out of Stock
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?= view('components/footer'); ?>

    <style>
        .category-filter {
            background: var(--accent);
            border: 2px solid var(--secondary);
            color: var(--neutral);
        }
        
        .category-filter.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--neutral);
        }

        .category-filter:hover {
            background: var(--secondary)/20;
        }

        .category-filter.active:hover {
            background: var(--primary)/80;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        function filterCategory(category) {
            // Update active button
            document.querySelectorAll('.category-filter').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter products
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>