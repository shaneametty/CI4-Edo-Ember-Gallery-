<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Order Details']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_user'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-[var(--neutral)]/60 mb-4">
                <a href="/user/orders" class="hover:text-[var(--secondary)] transition">My Orders</a>
                <span>/</span>
                <span class="text-[var(--neutral)]"><?= esc($order->order_number) ?></span>
            </div>
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Order Details</h1>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left Column: Order Items & Customer Info -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Order Items -->
                <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                    <h2 class="text-2xl font-bold text-[var(--neutral)] mb-6">Order Items</h2>
                    
                    <div class="space-y-4">
                        <?php if (!empty($order->items)): ?>
                            <?php foreach ($order->items as $item): ?>
                                <div class="flex gap-4 pb-4 border-b border-[var(--secondary)]/10 last:border-0">
                                    <!-- Product Image Placeholder -->
                                    <div class="w-20 h-20 bg-[var(--secondary)]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-image text-[var(--secondary)] text-2xl"></i>
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1">
                                        <h3 class="text-[var(--neutral)] font-bold text-lg mb-1">
                                            <?= esc($item->product_name) ?>
                                        </h3>
                                        <p class="text-[var(--neutral)]/60 text-sm mb-2">
                                            <?= ucfirst(esc($item->product_category)) ?>
                                        </p>
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="text-[var(--neutral)]/80">
                                                <i class="fa-solid fa-dollar-sign mr-1"></i>
                                                <?= number_format($item->price, 2) ?> each
                                            </span>
                                            <span class="text-[var(--neutral)]/80">
                                                <i class="fa-solid fa-box mr-1"></i>
                                                Qty: <?= esc($item->quantity) ?>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="text-right">
                                        <p class="text-[var(--primary)] font-bold text-xl">
                                            $<?= number_format($item->subtotal, 2) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <!-- Total Section -->
                            <div class="pt-4 border-t-2 border-[var(--secondary)]/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-[var(--neutral)] font-bold text-xl">Total Amount</h3>
                                    <p class="text-[var(--primary)] font-bold text-2xl">
                                        $<?= number_format($order->total_amount, 2) ?>
                                    </p>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-[var(--neutral)]/60 text-center py-8">No items in this order</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Customer & Shipping Information -->
                <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                    <h2 class="text-2xl font-bold text-[var(--neutral)] mb-6">Shipping Information</h2>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Customer Name</p>
                            <p class="text-[var(--neutral)] font-semibold"><?= esc($order->customer_name) ?></p>
                        </div>

                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Email</p>
                            <p class="text-[var(--neutral)] font-semibold"><?= esc($order->customer_email) ?></p>
                        </div>

                        <?php if ($order->customer_phone): ?>
                            <div>
                                <p class="text-[var(--neutral)]/60 text-sm mb-2">Phone</p>
                                <p class="text-[var(--neutral)] font-semibold"><?= esc($order->customer_phone) ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($order->shipping_address): ?>
                            <div class="md:col-span-2">
                                <p class="text-[var(--neutral)]/60 text-sm mb-2">Shipping Address</p>
                                <p class="text-[var(--neutral)] font-semibold"><?= nl2br(esc($order->shipping_address)) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Notes (if any) -->
                <?php if ($order->notes): ?>
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <h2 class="text-2xl font-bold text-[var(--neutral)] mb-4">
                            <i class="fa-solid fa-note-sticky mr-2"></i>Order Notes
                        </h2>
                        <p class="text-[var(--neutral)]/80"><?= nl2br(esc($order->notes)) ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="space-y-6">
                
                <!-- Order Status Card -->
                <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                    <h2 class="text-xl font-bold text-[var(--neutral)] mb-6">Order Status</h2>
                    
                    <div class="space-y-4">
                        <!-- Order Number -->
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Order Number</p>
                            <p class="text-[var(--neutral)] font-bold text-lg"><?= esc($order->order_number) ?></p>
                        </div>

                        <!-- Order Date -->
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Order Date</p>
                            <p class="text-[var(--neutral)] font-semibold">
                                <?= date('M d, Y - h:i A', strtotime($order->created_at)) ?>
                            </p>
                        </div>

                        <!-- Order Status -->
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Order Status</p>
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
                            <span class="inline-block bg-<?= $color ?>/20 text-<?= $color ?> px-4 py-2 rounded-lg font-bold text-sm">
                                <?= ucfirst(esc($order->status)) ?>
                            </span>
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Payment Status</p>
                            <?php if ($order->payment_status === 'paid'): ?>
                                <span class="inline-block bg-green-500/20 text-green-500 px-4 py-2 rounded-lg font-bold text-sm">
                                    <i class="fa-solid fa-check-circle mr-2"></i>Paid
                                </span>
                            <?php else: ?>
                                <span class="inline-block bg-red-500/20 text-red-500 px-4 py-2 rounded-lg font-bold text-sm">
                                    <i class="fa-solid fa-clock mr-2"></i>Unpaid
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Last Updated -->
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Last Updated</p>
                            <p class="text-[var(--neutral)] text-sm">
                                <?= date('M d, Y - h:i A', strtotime($order->updated_at)) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Order Timeline -->
                <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                    <h2 class="text-xl font-bold text-[var(--neutral)] mb-6">Order Timeline</h2>
                    
                    <div class="space-y-4">
                        <?php
                        $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                        $currentIndex = array_search($order->status, $statuses);
                        
                        foreach ($statuses as $index => $status):
                            $isComplete = $index <= $currentIndex;
                            $isCurrent = $index === $currentIndex;
                        ?>
                            <div class="flex items-center gap-3">
                                <div class="<?= $isComplete ? 'bg-[var(--primary)]' : 'bg-[var(--neutral)]/20' ?> w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
                                    <?php if ($isComplete): ?>
                                        <i class="fa-solid fa-check text-white text-sm"></i>
                                    <?php else: ?>
                                        <div class="w-2 h-2 bg-[var(--neutral)]/40 rounded-full"></div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="<?= $isComplete ? 'text-[var(--neutral)] font-semibold' : 'text-[var(--neutral)]/40' ?> text-sm">
                                        <?= ucfirst($status) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Back Button -->
                <a href="/user/orders" 
                   class="block w-full bg-[var(--accent)] hover:bg-[var(--secondary)]/10 border border-[var(--secondary)]/30 text-[var(--neutral)] px-4 py-3 rounded-lg font-semibold text-center transition duration-200">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Back to Orders
                </a>
            </div>
        </div>
    </div>

    <?= view('components/footer'); ?>
</body>

</html>