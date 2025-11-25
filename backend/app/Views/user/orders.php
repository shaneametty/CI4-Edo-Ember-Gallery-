<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 My Orders']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_user'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[var(--neutral)]">My Orders</h1>
            <p class="text-[var(--neutral)]/70 mt-2">Track and view your order history</p>
        </div>

        <!-- Orders List -->
        <?php if (empty($orders)): ?>
            <!-- Empty State -->
            <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-12 border border-[var(--secondary)]/20 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-[var(--secondary)]/20 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-box-open text-[var(--secondary)] text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-[var(--neutral)] mb-3">No Orders Yet</h2>
                <p class="text-[var(--neutral)]/70 mb-6">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                <a href="/user/products" class="inline-block bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                    Browse Gallery
                </a>
            </div>
        <?php else: ?>
            <!-- Orders Grid -->
            <div class="space-y-4">
                <?php foreach ($orders as $order): ?>
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl border border-[var(--secondary)]/20 overflow-hidden hover:border-[var(--secondary)]/40 transition duration-200">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <!-- Left: Order Info -->
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-xl font-bold text-[var(--neutral)]">
                                            <?= esc($order->order_number) ?>
                                        </h3>
                                        
                                        <!-- Status Badge -->
                                        <?php
                                        $statusColors = [
                                            'pending' => 'yellow-500',
                                            'processing' => 'blue-500',
                                            'shipped' => 'purple-500',
                                            'delivered' => 'green-500',
                                            'cancelled' => 'red-500'
                                        ];
                                        $color = $statusColors[$order->status] ?? 'gray-500';
                                        ?>
                                        <span class="bg-<?= $color ?>/20 text-<?= $color ?> px-3 py-1 rounded-full text-xs font-semibold">
                                            <?= ucfirst(esc($order->status)) ?>
                                        </span>

                                        <!-- Payment Badge -->
                                        <?php if ($order->payment_status === 'paid'): ?>
                                            <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fa-solid fa-check-circle mr-1"></i>Paid
                                            </span>
                                        <?php else: ?>
                                            <span class="bg-red-500/20 text-red-500 px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fa-solid fa-clock mr-1"></i>Unpaid
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="grid md:grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <p class="text-[var(--neutral)]/60 mb-1">Order Date</p>
                                            <p class="text-[var(--neutral)] font-semibold">
                                                <?= date('M d, Y', strtotime($order->created_at)) ?>
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-[var(--neutral)]/60 mb-1">Total Amount</p>
                                            <p class="text-[var(--primary)] font-bold text-lg">
                                                $<?= number_format($order->total_amount, 2) ?>
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-[var(--neutral)]/60 mb-1">Items</p>
                                            <p class="text-[var(--neutral)] font-semibold">
                                                <?= isset($order->items_count) ? $order->items_count : count($order->items ?? []) ?> item(s)
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right: Action Button -->
                                <div>
                                    <a href="/user/orders/view/<?= esc($order->id) ?>" 
                                       class="block bg-[var(--secondary)] hover:bg-[var(--secondary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200 text-center whitespace-nowrap">
                                        View Details
                                        <i class="fa-solid fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?= view('components/footer'); ?>
</body>

</html>