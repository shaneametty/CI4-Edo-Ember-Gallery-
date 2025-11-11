<?php
$productsToSupply = [
    [
        "sku" => "ART001",
        "name" => "727",
        "stock" => 1,
        "location" => "Gallery Storage"
    ],
    [
        "sku" => "ART002",
        "name" => "Lady Murasaki Writing at Her Desk",
        "stock" => 1,
        "location" => "Gallery Storage"
    ],
    [
        "sku" => "AB001",
        "name" => "Symbols of Japan by Merrily Baird",
        "stock" => 25,
        "location" => "Warehouse A"
    ],
    [
        "sku" => "AB002",
        "name" => "MERCURY by Entei Ryu",
        "stock" => 15,
        "location" => "Warehouse B"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<?= view('components/head', ['title' => '🔥 Admin Dashboard']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin') ?>

    <main class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300">
                <p class="text-[var(--secondary)] text-sm font-semibold">Users</p>
                <p class="text-[var(--neutral)] text-2xl font-bold mt-2">1,245</p>
            </div>
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300">
                <p class="text-[var(--secondary)] text-sm font-semibold">Products</p>
                <p class="text-[var(--neutral)] text-2xl font-bold mt-2"><?= count($productsToSupply) ?></p>
            </div>
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300">
                <p class="text-[var(--secondary)] text-sm font-semibold">Revenue</p>
                <p class="text-[var(--neutral)] text-2xl font-bold mt-2">$12,345</p>
            </div>
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300">
                <p class="text-[var(--secondary)] text-sm font-semibold">Visitors</p>
                <p class="text-[var(--neutral)] text-2xl font-bold mt-2">8,910</p>
            </div>
        </div>

        <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 animate-fadeInUp">
            <h2 class="text-[var(--neutral)] font-semibold text-xl mb-4">Products to Supply</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-separate border-spacing-y-2">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-[var(--secondary)]">SKU</th>
                            <th class="px-4 py-2 text-[var(--secondary)]">Product Name</th>
                            <th class="px-4 py-2 text-[var(--secondary)]">Stock</th>
                            <th class="px-4 py-2 text-[var(--secondary)]">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productsToSupply as $product) : ?>
                            <tr class="bg-[#262626] rounded-lg mb-2">
                                <td class="px-4 py-2"><?= $product['sku'] ?></td>
                                <td class="px-4 py-2"><?= $product['name'] ?></td>
                                <td class="px-4 py-2"><?= $product['stock'] ?></td>
                                <td class="px-4 py-2"><?= $product['location'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <?= view('components/footer'); ?>
</body>

</html>