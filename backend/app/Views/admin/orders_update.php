<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Update Order']) ?>

<body class="bg-[var(--accent)] font-sans text-[var(--neutral)]">
    <?= view('components/header_admin'); ?>

    <div class="mx-auto px-6 py-8 container">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4 text-[var(--neutral)]/60">
                <a href="/orders" class="hover:text-[var(--secondary)] transition">Orders</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Update Order</span>
            </div>
            <h1 class="font-bold text-[var(--neutral)] text-3xl">Update Order</h1>
        </div>

        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-500/20 mb-6 px-4 py-3 border border-green-500 rounded-lg text-green-500">
            Order updated successfully!
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-500/20 mb-6 px-4 py-3 border border-red-500 rounded-lg text-red-500">
            <span id="errorText"></span>
        </div>

        <!-- Update Form -->
        <div class="bg-[#1b1b1b] shadow-xl p-8 border border-[var(--secondary)]/20 rounded-lg max-w-2xl">
            <form id="updateOrderForm" onsubmit="handleUpdateOrder(event)">
                <input type="hidden" name="id" value="">

                <div class="gap-6 grid md:grid-cols-2">
                    <!-- User ID -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            User ID <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="user_id" value="" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" required>
                    </div>

                    <!-- Product ID -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Product ID <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="product_id" value="" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" required>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Quantity <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="quantity" value="" min="1" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" required>
                    </div>

                    <!-- Total Price -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Total Price <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="total_price" value="" step="0.01" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" required>
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Payment Status <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="payment_status" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" required>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>

                    <!-- Order Status -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Order Status <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="order_status" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-[var(--secondary)]/20 border-t">
                    <a href="/orders" class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                        Update Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= view('components/footer'); ?>

    <script>
        function handleUpdateOrder(event) {
            event.preventDefault();
            // Placeholder: add JS logic to submit the update
            document.getElementById('successMessage').classList.remove('hidden');
            document.getElementById('errorMessage').classList.add('hidden');
        }
    </script>
</body>

</html>