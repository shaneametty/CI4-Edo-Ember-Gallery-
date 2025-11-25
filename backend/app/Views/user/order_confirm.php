<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Order Confirmation']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_user'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-[var(--neutral)]/60 mb-4">
                <a href="/user/products" class="hover:text-[var(--secondary)] transition">Products</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Order Confirmation</span>
            </div>
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Confirm Your Order</h1>
            <p class="text-[var(--neutral)]/70 mt-2">Review your order details before submitting</p>
        </div>

        <!-- Validation Errors -->
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

        <form action="/user/order/submit" method="post">
            <input type="hidden" name="product_id" value="<?= esc($product->id) ?>">
            
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Left Column: Order Form -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Product Information -->
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <h2 class="text-2xl font-bold text-[var(--neutral)] mb-6">Product Details</h2>
                        
                        <div class="flex gap-6">
                            <!-- Product Image -->
                            <div class="w-32 h-32 bg-[var(--secondary)]/10 rounded-lg flex-shrink-0 overflow-hidden">
                                <?php if ($product->image_url): ?>
                                    <img src="<?= esc($product->image_url) ?>" 
                                         alt="<?= esc($product->name) ?>"
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fa-solid fa-image text-[var(--secondary)] text-3xl"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-[var(--neutral)] mb-2">
                                    <?= esc($product->name) ?>
                                </h3>
                                <?php if ($product->artist): ?>
                                    <p class="text-[var(--neutral)]/60 text-sm mb-2">
                                        <i class="fa-solid fa-user mr-1"></i>
                                        by <?= esc($product->artist) ?>
                                    </p>
                                <?php endif; ?>
                                <?php
                                $categoryColors = [
                                    'artwork' => 'primary',
                                    'artbook' => 'secondary',
                                    'merchandise' => 'green-500'
                                ];
                                $color = $categoryColors[$product->category] ?? 'gray-500';
                                ?>
                                <span class="inline-block bg-[var(--<?= $color ?>)]/20 text-[var(--<?= $color ?>)] px-3 py-1 rounded-full text-xs font-semibold mb-3">
                                    <?= ucfirst(esc($product->category)) ?>
                                </span>
                                
                                <?php if ($product->description): ?>
                                    <p class="text-[var(--neutral)]/80 text-sm mt-3">
                                        <?= esc($product->description) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information (LOCKED - From Profile) -->
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-[var(--neutral)]">Customer Information</h2>
                            <span class="text-[var(--secondary)] text-sm flex items-center gap-2">
                                <i class="fa-solid fa-lock"></i>
                                From Your Profile
                            </span>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Customer Name (LOCKED - Read-only) -->
                            <div class="md:col-span-2">
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Full Name <span class="text-[var(--primary)]">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text"
                                           name="customer_name"
                                           value="<?= esc($user->getFullName()) ?>"
                                           class="w-full bg-[var(--accent)]/50 border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] cursor-not-allowed"
                                           readonly
                                           required>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[var(--secondary)]">
                                        <i class="fa-solid fa-lock text-sm"></i>
                                    </div>
                                </div>
                                <p class="text-[var(--neutral)]/50 text-xs mt-1">
                                    <i class="fa-solid fa-info-circle mr-1"></i>
                                    To change this, update your profile
                                </p>
                            </div>

                            <!-- Email (LOCKED - Read-only) -->
                            <div>
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Email <span class="text-[var(--primary)]">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email"
                                           name="customer_email"
                                           value="<?= esc($user->email) ?>"
                                           class="w-full bg-[var(--accent)]/50 border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] cursor-not-allowed"
                                           readonly
                                           required>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[var(--secondary)]">
                                        <i class="fa-solid fa-lock text-sm"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone (EDITABLE) -->
                            <div>
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Phone Number
                                </label>
                                <input type="tel"
                                       name="customer_phone"
                                       value="<?= old('customer_phone') ?>"
                                       class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                       placeholder="+1 (555) 123-4567">
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <h2 class="text-2xl font-bold text-[var(--neutral)] mb-6">Shipping Address</h2>
                        
                        <div>
                            <label class="block text-[var(--neutral)] font-semibold mb-2">
                                Full Address <span class="text-[var(--primary)]">*</span>
                            </label>
                            <textarea name="shipping_address"
                                      rows="4"
                                      class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                      placeholder="Street Address, City, State, ZIP Code, Country"
                                      required><?= old('shipping_address') ?></textarea>
                        </div>
                    </div>

                    <!-- Order Notes (Optional) -->
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                        <h2 class="text-2xl font-bold text-[var(--neutral)] mb-6">Order Notes (Optional)</h2>
                        
                        <div>
                            <textarea name="notes"
                                      rows="3"
                                      class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                      placeholder="Special instructions or delivery notes..."><?= old('notes') ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="space-y-6">
                    
                    <!-- Order Summary Card -->
                    <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20 sticky top-6">
                        <h2 class="text-xl font-bold text-[var(--neutral)] mb-6">Order Summary</h2>
                        
                        <div class="space-y-4">
                            <!-- Quantity -->
                            <div>
                                <label class="block text-[var(--neutral)] font-semibold mb-2">
                                    Quantity <span class="text-[var(--primary)]">*</span>
                                </label>
                                <input type="number"
                                       name="quantity"
                                       id="quantity"
                                       value="1"
                                       min="1"
                                       max="<?= $product->stock ?>"
                                       onchange="updateTotal()"
                                       class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                       required>
                                <p class="text-[var(--neutral)]/60 text-xs mt-1">
                                    Max: <?= $product->stock ?> available
                                </p>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="pt-4 border-t border-[var(--secondary)]/20 space-y-3">
                                <div class="flex justify-between text-[var(--neutral)]/80">
                                    <span>Price per unit:</span>
                                    <span class="font-semibold">$<?= number_format($product->price, 2) ?></span>
                                </div>

                                <div class="flex justify-between text-[var(--neutral)]/80">
                                    <span>Quantity:</span>
                                    <span class="font-semibold" id="summaryQty">1</span>
                                </div>

                                <div class="pt-3 border-t-2 border-[var(--primary)]/30">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-[var(--neutral)]">Total:</span>
                                        <span class="text-2xl font-bold text-[var(--primary)]" id="totalAmount">
                                            $<?= number_format($product->price, 2) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Status -->
                            <div class="pt-4 border-t border-[var(--secondary)]/20 space-y-2 text-sm">
                                <div class="flex items-center gap-2 text-[var(--neutral)]/60">
                                    <i class="fa-solid fa-circle-check text-green-500"></i>
                                    <span>Order Status: <strong class="text-[var(--neutral)]">Pending</strong></span>
                                </div>
                                <div class="flex items-center gap-2 text-[var(--neutral)]/60">
                                    <i class="fa-solid fa-clock text-yellow-500"></i>
                                    <span>Payment: <strong class="text-[var(--neutral)]">Unpaid</strong></span>
                                </div>
                            </div>

                            <!-- Security Notice -->
                            <div class="pt-4 border-t border-[var(--secondary)]/20">
                                <div class="bg-[var(--secondary)]/10 border border-[var(--secondary)]/30 rounded-lg p-3">
                                    <p class="text-[var(--secondary)] text-xs flex items-start gap-2">
                                        <i class="fa-solid fa-shield-halved mt-0.5"></i>
                                        <span>This order will be placed under your account. Your profile information is used for order tracking and cannot be changed here.</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="pt-6 space-y-3">
                                <button type="submit"
                                        class="w-full bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-4 rounded-lg font-bold text-lg transition duration-200">
                                    <i class="fa-solid fa-check-circle mr-2"></i>
                                    Place Order
                                </button>

                                <a href="/user/products"
                                   class="block w-full bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold text-center transition duration-200">
                                    <i class="fa-solid fa-arrow-left mr-2"></i>
                                    Back to Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?= view('components/footer'); ?>

    <script>
        const pricePerUnit = <?= $product->price ?>;

        function updateTotal() {
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            const total = pricePerUnit * quantity;
            
            document.getElementById('summaryQty').textContent = quantity;
            document.getElementById('totalAmount').textContent = '$' + total.toFixed(2);
        }
    </script>
</body>

</html>