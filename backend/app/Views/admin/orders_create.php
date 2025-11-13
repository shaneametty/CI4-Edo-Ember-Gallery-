<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => 'Create Order']) ?>

<body class="bg-[var(--accent)] font-sans text-[var(--neutral)]">
    <?= view('components/header_admin'); ?>

    <div class="mx-auto px-6 py-8 container">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4 text-[var(--neutral)]/60">
                <a href="/admin/orders" class="hover:text-[var(--secondary)] transition">Orders</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Create New Order</span>
            </div>
            <h1 class="font-bold text-[var(--neutral)] text-3xl">Create New Order</h1>
        </div>

        <!-- Success Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div id="alertBox" class="bg-green-500/20 mb-6 p-4 border border-green-500 rounded-lg transition-opacity duration-1000">
                <p class="font-semibold text-green-500">
                    <?= esc(session()->getFlashdata('success')) ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div id="alertBox" class="bg-red-500/20 mb-6 p-4 border border-red-500 rounded-lg transition-opacity duration-1000">
                <p class="font-semibold text-red-500">
                    <?= esc(session()->getFlashdata('error')) ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- Validation Errors -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-red-500/20 mb-6 p-4 border border-red-500 rounded-lg">
                <h3 class="mb-2 font-semibold text-red-500">Please fix the following errors:</h3>
                <ul class="text-red-500/80 list-disc list-inside">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Create Order Form -->
        <div class="bg-[#1b1b1b] shadow-xl p-8 border border-[var(--secondary)]/20 rounded-lg max-w-2xl">
            <form id="createOrderForm" action="<?= base_url('orders_create') ?>" method="POST">
                <div class="gap-6 grid md:grid-cols-2">
                    <!-- User ID -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            User ID <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="user_id" value="<?= old('user_id') ?>"
                            class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition"
                            placeholder="Enter user ID" required>
                    </div>

                    <!-- Product ID -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Product ID <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="product_id" value="<?= old('product_id') ?>"
                            class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition"
                            placeholder="Enter product ID" required>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Quantity <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="quantity" value="<?= old('quantity', 1) ?>"
                            class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition"
                            min="1" required>
                    </div>

                    <!-- Total Price -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Total Price <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="total_price" value="<?= old('total_price') ?>" step="0.01"
                            class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition"
                            placeholder="0.00" required>
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Payment Status <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="payment_status"
                            class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition"
                            required>
                            <option value="paid" <?= old('payment_status') === 'paid' ? 'selected' : '' ?>>Paid</option>
                            <option value="unpaid" <?= old('payment_status') === 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
                        </select>
                    </div>

                    <!-- Order Status -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Order Status <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="order_status"
                            class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition"
                            required>
                            <option value="pending" <?= old('order_status') === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="completed" <?= old('order_status') === 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="canceled" <?= old('order_status') === 'canceled' ? 'selected' : '' ?>>Canceled</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-[var(--secondary)]/20 border-t">
                    <a href="/admin/orders"
                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                        Create Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= view('components/footer'); ?>

    <script>
        // Optional: auto-hide flash messages after 3 seconds
        setTimeout(() => {
            const alert = document.getElementById('alertBox');
            if (alert) alert.style.opacity = '0';
        }, 3000);
    </script>
</body>

</html>