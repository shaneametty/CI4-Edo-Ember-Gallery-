<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Create Order']) ?>

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

        <!-- Error Messages -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-red-500/20 border border-red-500 rounded-lg p-4 mb-6">
                <h3 class="text-red-500 font-semibold mb-2">Please fix the following errors:</h3>
                <ul class="list-disc list-inside text-red-500/80">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Create Form -->
        <form action="/admin/orders/create" method="post" id="orderForm">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Customer Information -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <h2 class="text-xl font-bold text-[var(--neutral)] mb-4">Customer Information</h2>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Select User -->
                            <div class="md:col-span-2">
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Select User <span class="text-[var(--primary)]">*</span>
                                </label>
                                <select name="user_id" 
                                        id="userSelect"
                                        onchange="fillUserInfo()"
                                        class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                        required>
                                    <option value="">Select a user...</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= esc($user->id) ?>" 
                                                data-name="<?= esc($user->first_name . ' ' . $user->last_name) ?>"
                                                data-email="<?= esc($user->email) ?>">
                                            <?= esc($user->first_name . ' ' . $user->last_name) ?> (<?= esc($user->email) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Customer Name -->
                            <div class="md:col-span-2">
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Customer Name <span class="text-[var(--primary)]">*</span>
                                </label>
                                <input type="text" 
                                       name="customer_name" 
                                       id="customerName"
                                       value="<?= old('customer_name') ?>"
                                       class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                       placeholder="Enter customer name"
                                       required>
                            </div>

                            <!-- Customer Email -->
                            <div>
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Email <span class="text-[var(--primary)]">*</span>
                                </label>
                                <input type="email" 
                                       name="customer_email" 
                                       id="customerEmail"
                                       value="<?= old('customer_email') ?>"
                                       class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                       placeholder="customer@example.com"
                                       required>
                            </div>

                            <!-- Customer Phone -->
                            <div>
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Phone
                                </label>
                                <input type="text" 
                                       name="customer_phone" 
                                       value="<?= old('customer_phone') ?>"
                                       class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                       placeholder="+63 917 123 4567">
                            </div>

                            <!-- Shipping Address -->
                            <div class="md:col-span-2">
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Shipping Address
                                </label>
                                <textarea name="shipping_address" 
                                          rows="3"
                                          class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                          placeholder="Enter shipping address"><?= old('shipping_address') ?></textarea>
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Order Notes
                                </label>
                                <textarea name="notes" 
                                          rows="2"
                                          class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                          placeholder="Special instructions or notes"><?= old('notes') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-[var(--neutral)]">Order Items</h2>
                            <button type="button" 
                                    onclick="addOrderItem()"
                                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--secondary)] px-4 py-2 rounded transition duration-200">
                                + Add Item
                            </button>
                        </div>

                        <div id="orderItems" class="space-y-4">
                            <!-- Order items will be added here dynamically -->
                        </div>

                        <div class="mt-6 pt-4 border-t border-[var(--secondary)]/20">
                            <div class="flex justify-between items-center">
                                <h3 class="text-[var(--neutral)] font-bold text-lg">Total</h3>
                                <p id="orderTotal" class="text-[var(--primary)] font-bold text-xl">$0.00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Settings -->
                <div class="space-y-6">
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <h2 class="text-xl font-bold text-[var(--neutral)] mb-4">Order Settings</h2>
                        
                        <div class="space-y-4">
                            <!-- Status -->
                            <div>
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Status <span class="text-[var(--primary)]">*</span>
                                </label>
                                <select name="status" 
                                        class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                        required>
                                    <option value="pending" selected>Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>

                            <!-- Payment Status -->
                            <div>
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Payment Status <span class="text-[var(--primary)]">*</span>
                                </label>
                                <select name="payment_status" 
                                        class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                        required>
                                    <option value="unpaid" selected>Unpaid</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col gap-3">
                        <button type="submit" 
                                class="w-full bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                            Create Order
                        </button>
                        <a href="/admin/orders" 
                           class="w-full bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200 text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Hidden total amount field -->
            <input type="hidden" name="total_amount" id="totalAmount" value="0">
        </form>
    </div>

    <script>
        // Available products passed from controller
        const products = <?= json_encode($products) ?>;
        let itemCounter = 0;

        /**
         * Auto-fill customer info when user is selected
         */
        function fillUserInfo() {
            const select = document.getElementById('userSelect');
            const option = select.options[select.selectedIndex];
            
            if (option.value) {
                document.getElementById('customerName').value = option.dataset.name;
                document.getElementById('customerEmail').value = option.dataset.email;
            }
        }

        /**
         * Add new order item row
         */
        function addOrderItem() {
            itemCounter++;
            const itemHtml = `
                <div class="border border-[var(--secondary)]/20 rounded-lg p-4" id="item-${itemCounter}">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="text-[var(--neutral)] font-semibold">Item #${itemCounter}</h4>
                        <button type="button" 
                                onclick="removeOrderItem(${itemCounter})"
                                class="text-[var(--primary)] hover:text-[var(--primary)]/80">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-[var(--neutral)]/80 text-sm mb-1">Product</label>
                            <select name="items[${itemCounter}][product_id]" 
                                    onchange="updateItemPrice(${itemCounter})"
                                    class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded px-3 py-2 text-[var(--neutral)] text-sm"
                                    required>
                                <option value="">Select product...</option>
                                ${products.map(p => `
                                    <option value="${p.id}" 
                                            data-price="${p.price}" 
                                            data-name="${p.name}"
                                            data-category="${p.category}">
                                        ${p.name} - $${parseFloat(p.price).toFixed(2)}
                                    </option>
                                `).join('')}
                            </select>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[var(--neutral)]/80 text-sm mb-1">Quantity</label>
                                <input type="number" 
                                       name="items[${itemCounter}][quantity]" 
                                       value="1" 
                                       min="1"
                                       onchange="calculateItemSubtotal(${itemCounter})"
                                       class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded px-3 py-2 text-[var(--neutral)] text-sm"
                                       required>
                            </div>
                            <div>
                                <label class="block text-[var(--neutral)]/80 text-sm mb-1">Subtotal</label>
                                <input type="text" 
                                       id="subtotal-${itemCounter}"
                                       value="$0.00"
                                       class="w-full bg-[var(--accent)]/50 border border-[var(--secondary)]/20 rounded px-3 py-2 text-[var(--neutral)] text-sm"
                                       readonly>
                            </div>
                        </div>
                        
                        <input type="hidden" name="items[${itemCounter}][price]" id="price-${itemCounter}" value="0">
                        <input type="hidden" name="items[${itemCounter}][product_name]" id="name-${itemCounter}">
                        <input type="hidden" name="items[${itemCounter}][product_category]" id="category-${itemCounter}">
                    </div>
                </div>
            `;
            
            document.getElementById('orderItems').insertAdjacentHTML('beforeend', itemHtml);
        }

        /**
         * Remove an order item
         */
        function removeOrderItem(id) {
            document.getElementById(`item-${id}`).remove();
            calculateTotal();
        }

        /**
         * Update item price when product is selected
         */
        function updateItemPrice(id) {
            const select = document.querySelector(`select[name="items[${id}][product_id]"]`);
            const option = select.options[select.selectedIndex];
            
            if (option.value) {
                const price = parseFloat(option.dataset.price);
                document.getElementById(`price-${id}`).value = price;
                document.getElementById(`name-${id}`).value = option.dataset.name;
                document.getElementById(`category-${id}`).value = option.dataset.category;
                calculateItemSubtotal(id);
            }
        }

        /**
         * Calculate subtotal for a single item
         */
        function calculateItemSubtotal(id) {
            const quantity = parseInt(document.querySelector(`input[name="items[${id}][quantity]"]`).value) || 0;
            const price = parseFloat(document.getElementById(`price-${id}`).value) || 0;
            const subtotal = quantity * price;
            
            document.getElementById(`subtotal-${id}`).value = `$${subtotal.toFixed(2)}`;
            calculateTotal();
        }

        /**
         * Calculate order total
         */
        function calculateTotal() {
            let total = 0;
            const items = document.querySelectorAll('[id^="subtotal-"]');
            
            items.forEach(item => {
                const value = item.value.replace('$', '');
                total += parseFloat(value) || 0;
            });
            
            document.getElementById('orderTotal').textContent = `$${total.toFixed(2)}`;
            document.getElementById('totalAmount').value = total.toFixed(2);
        }

        // Add first item on page load
        window.addEventListener('DOMContentLoaded', () => {
            addOrderItem();
        });
    </script>
</body>
</html>