<!DOCTYPE html>
<html lang="en">

<?= view('components/head', ['title' => $title]) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin') ?>

    <main class="container mx-auto px-6 py-12">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[var(--neutral)] mb-2">Dashboard Overview</h1>
            <p class="text-[var(--secondary)]">Welcome back! Here's what's happening with your gallery.</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Users Card -->
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300 border-l-4 border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[var(--secondary)] text-sm font-semibold uppercase">Total Users</p>
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <p class="text-[var(--neutral)] text-3xl font-bold"><?= number_format($stats['total_users']) ?></p>
                <a href="<?= base_url('admin/users') ?>" class="text-xs text-[var(--primary)] hover:underline mt-2 inline-block">Manage Users →</a>
            </div>

            <!-- Total Products Card -->
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300 border-l-4 border-purple-500">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[var(--secondary)] text-sm font-semibold uppercase">Total Products</p>
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <p class="text-[var(--neutral)] text-3xl font-bold"><?= number_format($stats['total_products']) ?></p>
                <a href="<?= base_url('admin/products') ?>" class="text-xs text-[var(--primary)] hover:underline mt-2 inline-block">Manage Products →</a>
            </div>

            <!-- Total Revenue Card -->
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300 border-l-4 border-green-500">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[var(--secondary)] text-sm font-semibold uppercase">Total Revenue</p>
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-[var(--neutral)] text-3xl font-bold">$<?= number_format($stats['total_revenue'], 2) ?></p>
                <p class="text-xs text-[var(--secondary)] mt-2">From paid orders</p>
            </div>

            <!-- Total Orders Card -->
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 hover:scale-[1.03] transition duration-300 border-l-4 border-orange-500">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[var(--secondary)] text-sm font-semibold uppercase">Total Orders</p>
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <p class="text-[var(--neutral)] text-3xl font-bold"><?= number_format($stats['total_orders']) ?></p>
                <a href="<?= base_url('admin/orders') ?>" class="text-xs text-[var(--primary)] hover:underline mt-2 inline-block">Manage Orders →</a>
            </div>
        </div>

        <!-- Alerts Section -->
        <?php if ($stats['pending_orders'] > 0 || $stats['low_stock_count'] > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <!-- Pending Orders Alert -->
                <?php if ($stats['pending_orders'] > 0): ?>
                    <div class="bg-yellow-900/20 border border-yellow-500/50 rounded-xl p-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <h3 class="text-yellow-500 font-semibold mb-1">Pending Orders</h3>
                                <p class="text-[var(--secondary)] text-sm">You have <strong class="text-yellow-500"><?= $stats['pending_orders'] ?></strong> pending orders that need attention.</p>
                                <a href="<?= base_url('admin/orders?status=pending') ?>" class="text-xs text-yellow-500 hover:underline mt-2 inline-block">View Pending Orders →</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Low Stock Alert -->
                <?php if ($stats['low_stock_count'] > 0): ?>
                    <div class="bg-red-900/20 border border-red-500/50 rounded-xl p-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-red-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <h3 class="text-red-500 font-semibold mb-1">Low Stock Alert</h3>
                                <p class="text-[var(--secondary)] text-sm"><strong class="text-red-500"><?= $stats['low_stock_count'] ?></strong> products are running low on stock (5 or fewer items).</p>
                                <a href="#low-stock-section" class="text-xs text-red-500 hover:underline mt-2 inline-block">View Low Stock Products →</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
            <!-- Order Status Breakdown -->
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6">
                <h2 class="text-[var(--neutral)] font-semibold text-xl mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Order Status
                </h2>
                <div class="space-y-3">
                    <?php
                    $statusColors = [
                        'pending' => 'yellow-500',
                        'processing' => 'blue-500',
                        'shipped' => 'purple-500',
                        'delivered' => 'green-500',
                        'cancelled' => 'red-500'
                    ];
                    foreach ($orderStatusBreakdown as $status => $count):
                    ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-<?= $statusColors[$status] ?> mr-3"></span>
                                <span class="text-[var(--secondary)] capitalize"><?= $status ?></span>
                            </div>
                            <span class="text-[var(--neutral)] font-semibold"><?= $count ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Top Selling Products -->
            <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 lg:col-span-2">
                <h2 class="text-[var(--neutral)] font-semibold text-xl mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Top Selling Products
                </h2>
                <?php if (!empty($topProducts)): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="pb-3 text-[var(--secondary)] text-sm">Product</th>
                                    <th class="pb-3 text-[var(--secondary)] text-sm text-center">Sold</th>
                                    <th class="pb-3 text-[var(--secondary)] text-sm text-right">Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topProducts as $product): ?>
                                    <tr class="border-b border-gray-800">
                                        <td class="py-3 text-[var(--neutral)]"><?= esc($product['product_name']) ?></td>
                                        <td class="py-3 text-center text-[var(--neutral)]"><?= $product['total_sold'] ?></td>
                                        <td class="py-3 text-right text-green-500 font-semibold">$<?= number_format($product['total_revenue'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-[var(--secondary)] text-center py-8">No sales data available yet.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Low Stock Products -->
        <?php if (!empty($lowStockProducts)): ?>
            <div id="low-stock-section" class="bg-[#1b1b1b] rounded-xl shadow-lg p-6 mb-12">
                <h2 class="text-[var(--neutral)] font-semibold text-xl mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Products Running Low on Stock
                </h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-[var(--secondary)]">Product Name</th>
                                <th class="px-4 py-2 text-[var(--secondary)]">Category</th>
                                <th class="px-4 py-2 text-[var(--secondary)] text-center">Stock</th>
                                <th class="px-4 py-2 text-[var(--secondary)] text-right">Price</th>
                                <th class="px-4 py-2 text-[var(--secondary)] text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lowStockProducts as $product): ?>
                                <tr class="bg-[#262626] rounded-lg">
                                    <td class="px-4 py-3 rounded-l-lg">
                                        <span class="text-[var(--neutral)] font-medium"><?= esc($product->name) ?></span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded-full bg-<?= $product->getCategoryColor() ?>/20 text-<?= $product->getCategoryColor() ?> capitalize">
                                            <?= esc($product->category) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold <?= $product->stock == 0 ? 'bg-red-500/20 text-red-500' : ($product->stock <= 2 ? 'bg-orange-500/20 text-orange-500' : 'bg-yellow-500/20 text-yellow-500') ?>">
                                            <?= $product->stock ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right text-[var(--neutral)] font-semibold">
                                        <?= $product->getFormattedPrice() ?>
                                    </td>
                                    <td class="px-4 py-3 text-right rounded-r-lg">
                                        <a href="<?= base_url('admin/products/update/' . $product->id) ?>" class="text-[var(--primary)] hover:underline text-sm">
                                            Update Stock
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Recent Orders -->
        <div class="bg-[#1b1b1b] rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-[var(--neutral)] font-semibold text-xl flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Recent Orders
                </h2>
                <a href="<?= base_url('admin/orders') ?>" class="text-[var(--primary)] hover:underline text-sm">View All →</a>
            </div>
            <?php if (!empty($recentOrders)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-[var(--secondary)]">Order #</th>
                                <th class="px-4 py-2 text-[var(--secondary)]">Customer</th>
                                <th class="px-4 py-2 text-[var(--secondary)] text-center">Status</th>
                                <th class="px-4 py-2 text-[var(--secondary)] text-center">Payment</th>
                                <th class="px-4 py-2 text-[var(--secondary)] text-right">Total</th>
                                <th class="px-4 py-2 text-[var(--secondary)] text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentOrders as $order): ?>
                                <tr class="bg-[#262626] hover:bg-[#2a2a2a] transition">
                                    <td class="px-4 py-3 rounded-l-lg">
                                        <a href="<?= base_url('admin/orders/show/' . $order->id) ?>" class="text-[var(--primary)] hover:underline font-semibold">
                                            <?= esc($order->order_number) ?>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-[var(--neutral)]">
                                        <?= esc($order->customer_name) ?>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-<?= $order->getStatusColor() ?>-500/20 text-<?= $order->getStatusColor() ?>-500 capitalize">
                                            <?= esc($order->status) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-<?= $order->getPaymentColor() ?>-500/20 text-<?= $order->getPaymentColor() ?>-500 capitalize">
                                            <?= esc($order->payment_status) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right text-[var(--neutral)] font-semibold">
                                        <?= $order->getFormattedTotal() ?>
                                    </td>
                                    <td class="px-4 py-3 text-right text-[var(--secondary)] rounded-r-lg">
                                        <?= date('M d, Y', strtotime($order->created_at)) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-[var(--secondary)] text-center py-8">No orders yet.</p>
            <?php endif; ?>
        </div>

    </main>
    <?= view('components/footer'); ?>
</body>

</html>