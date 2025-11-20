<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Order Details']) ?>

<body class="bg-[var(--accent)] font-sans text-[var(--neutral)]">
    <?= view('components/header_admin'); ?>
    
    <div class="mx-auto px-6 py-8 container">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4 text-[var(--neutral)]/60">
                <a href="/admin/orders" class="hover:text-[var(--secondary)] transition">Orders</a>
                <span>/</span>
                <span class="text-[var(--neutral)]"><?= esc($order->order_number) ?></span>
            </div>
            <h1 class="font-bold text-[var(--neutral)] text-3xl">Order Details</h1>
        </div>

        <!-- Success/Error Messages -->
        <div id="successMessage" class="hidden bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6">
            <span id="successText"></span>
        </div>

        <div id="errorMessage" class="hidden bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
            <span id="errorText"></span>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Left Column: Order Details -->
            <div class="md:col-span-2 space-y-6">
                
                <!-- Order Items -->
                <div class="bg-[#1b1b1b] shadow-xl p-6 border border-[var(--secondary)]/20 rounded-lg">
                    <h2 class="text-xl font-bold text-[var(--neutral)] mb-4">Order Items</h2>
                    <div class="space-y-4">
                        <?php if (!empty($order->items)): ?>
                            <?php foreach ($order->items as $item): ?>
                                <div class="flex justify-between items-center border-b border-[var(--secondary)]/10 pb-4">
                                    <div class="flex-1">
                                        <h3 class="text-[var(--neutral)] font-semibold"><?= esc($item->product_name) ?></h3>
                                        <p class="text-[var(--neutral)]/60 text-sm">
                                            <?= ucfirst(esc($item->product_category)) ?> • 
                                            Qty: <?= esc($item->quantity) ?>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[var(--neutral)] font-semibold">$<?= number_format($item->subtotal, 2) ?></p>
                                        <p class="text-[var(--neutral)]/60 text-sm">$<?= number_format($item->price, 2) ?> each</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <!-- Total -->
                            <div class="flex justify-between items-center pt-4">
                                <h3 class="text-[var(--neutral)] font-bold text-lg">Total</h3>
                                <p class="text-[var(--primary)] font-bold text-xl">$<?= number_format($order->total_amount, 2) ?></p>
                            </div>
                        <?php else: ?>
                            <p class="text-[var(--neutral)]/60">No items in this order</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-[#1b1b1b] shadow-xl p-6 border border-[var(--secondary)]/20 rounded-lg">
                    <h2 class="text-xl font-bold text-[var(--neutral)] mb-4">Customer Information</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm">Name</p>
                            <p class="text-[var(--neutral)] font-semibold"><?= esc($order->customer_name) ?></p>
                        </div>
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm">Email</p>
                            <p class="text-[var(--neutral)]"><?= esc($order->customer_email) ?></p>
                        </div>
                        <?php if ($order->customer_phone): ?>
                            <div>
                                <p class="text-[var(--neutral)]/60 text-sm">Phone</p>
                                <p class="text-[var(--neutral)]"><?= esc($order->customer_phone) ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($order->shipping_address): ?>
                            <div>
                                <p class="text-[var(--neutral)]/60 text-sm">Shipping Address</p>
                                <p class="text-[var(--neutral)]"><?= nl2br(esc($order->shipping_address)) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Notes (if any) -->
                <?php if ($order->notes): ?>
                    <div class="bg-[#1b1b1b] shadow-xl p-6 border border-[var(--secondary)]/20 rounded-lg">
                        <h2 class="text-xl font-bold text-[var(--neutral)] mb-4">Order Notes</h2>
                        <p class="text-[var(--neutral)]/80"><?= nl2br(esc($order->notes)) ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Order Status & Actions -->
            <div class="space-y-6">
                
                <!-- Order Status -->
                <div class="bg-[#1b1b1b] shadow-xl p-6 border border-[var(--secondary)]/20 rounded-lg">
                    <h2 class="text-xl font-bold text-[var(--neutral)] mb-4">Order Status</h2>
                    
                    <div class="space-y-4">
                        <!-- Order Number -->
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Order Number</p>
                            <p class="text-[var(--neutral)] font-semibold"><?= esc($order->order_number) ?></p>
                        </div>

                        <!-- Date -->
                        <div>
                            <p class="text-[var(--neutral)]/60 text-sm mb-2">Date</p>
                            <p class="text-[var(--neutral)]"><?= date('M d, Y - h:i A', strtotime($order->created_at)) ?></p>
                        </div>

                        <!-- Order Status Selector -->
                        <div>
                            <label class="block text-[var(--neutral)]/60 text-sm mb-2">Order Status</label>
                            <select id="orderStatus" 
                                    class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition">
                                <option value="pending" <?= $order->status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="processing" <?= $order->status === 'processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="shipped" <?= $order->status === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="delivered" <?= $order->status === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                <option value="cancelled" <?= $order->status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                        </div>

                        <!-- Payment Status Selector -->
                        <div>
                            <label class="block text-[var(--neutral)]/60 text-sm mb-2">Payment Status</label>
                            <select id="paymentStatus" 
                                    class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition">
                                <option value="unpaid" <?= $order->payment_status === 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
                                <option value="paid" <?= $order->payment_status === 'paid' ? 'selected' : '' ?>>Paid</option>
                            </select>
                        </div>

                        <!-- Update Buttons -->
                        <div class="space-y-3">
                            <button onclick="updateOrderStatus()" 
                                    class="w-full bg-[var(--secondary)] hover:bg-[var(--secondary)]/80 text-[var(--neutral)] px-4 py-3 rounded-lg font-semibold transition duration-200">
                                Update Order Status
                            </button>
                            
                            <button onclick="updatePaymentStatus()" 
                                    class="w-full bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-4 py-3 rounded-lg font-semibold transition duration-200">
                                Update Payment Status
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Back to Orders Button -->
                <a href="/admin/orders" 
                   class="block w-full bg-[var(--accent)] hover:bg-[var(--secondary)]/10 border border-[var(--secondary)]/30 text-[var(--neutral)] px-4 py-3 rounded-lg font-semibold text-center transition duration-200">
                    ← Back to Orders
                </a>
            </div>
        </div>
    </div>

    <script>
        const orderId = <?= $order->id ?>;

        /**
         * Update Order Status
         * Sends AJAX request to update the order's fulfillment status
         */
        function updateOrderStatus() {
            const status = document.getElementById('orderStatus').value;

            fetch('/admin/orders/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${orderId}&status=${status}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccess('Order status updated successfully!');
                } else {
                    showError(data.message);
                }
            })
            .catch(error => {
                showError('Error updating status: ' + error);
            });
        }

        /**
         * Update Payment Status
         * Sends AJAX request to update the payment status
         */
        function updatePaymentStatus() {
            const paymentStatus = document.getElementById('paymentStatus').value;

            fetch('/admin/orders/update-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${orderId}&payment_status=${paymentStatus}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccess('Payment status updated successfully!');
                } else {
                    showError(data.message);
                }
            })
            .catch(error => {
                showError('Error updating payment status: ' + error);
            });
        }

        /**
         * Show Success Message
         */
        function showSuccess(message) {
            document.getElementById('successText').textContent = message;
            document.getElementById('successMessage').classList.remove('hidden');
            document.getElementById('errorMessage').classList.add('hidden');
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                document.getElementById('successMessage').classList.add('hidden');
            }, 3000);
        }

        /**
         * Show Error Message
         */
        function showError(message) {
            document.getElementById('errorText').textContent = message;
            document.getElementById('errorMessage').classList.remove('hidden');
            document.getElementById('successMessage').classList.add('hidden');
        }
    </script>
</body>
</html>