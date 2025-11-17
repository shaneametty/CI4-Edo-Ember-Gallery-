<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Orders Management']) ?>

<body class="bg-[var(--accent)] font-sans text-[var(--neutral)]">
    <?= view('components/header_admin'); ?>
    
    <div class="mx-auto px-6 py-8 container">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-bold text-[var(--neutral)] text-3xl">Orders Management</h1>
                <p class="mt-2 text-[var(--neutral)]/70">View and manage all customer orders</p>
            </div>
            <a href="/admin/orders/create"
                class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                + Create New Order
            </a>
        </div>

        <!-- Success/Error Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Check if data is string (error message) or array -->
        <?php if (is_string($listOfOrders)): ?>
            <div class="bg-[#1b1b1b] border border-[var(--secondary)] text-[var(--neutral)] px-6 py-4 rounded-lg">
                <?= esc($listOfOrders) ?>
            </div>
        <?php else: ?>
            <!-- Orders Table -->
            <div class="bg-[#1b1b1b] shadow-xl border border-[var(--secondary)]/20 rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[var(--secondary)]/20 border-[var(--secondary)]/30 border-b">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Order #</th>
                                <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Customer</th>
                                <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Total</th>
                                <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Status</th>
                                <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Payment</th>
                                <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Date</th>
                                <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--secondary)]/10">
                            <?php if (empty($listOfOrders)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-[var(--neutral)]/60">
                                        No orders found. <a href="/admin/orders/create" class="text-[var(--primary)] hover:underline">Create your first order</a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($listOfOrders as $order): ?>
                                    <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                                        <!-- Order Number -->
                                        <td class="px-6 py-4 text-[var(--neutral)] font-semibold">
                                            <?= esc($order->order_number) ?>
                                        </td>
                                        
                                        <!-- Customer Info -->
                                        <td class="px-6 py-4 text-[var(--neutral)]">
                                            <div>
                                                <p class="font-semibold"><?= esc($order->customer_name) ?></p>
                                                <p class="text-sm text-[var(--neutral)]/60"><?= esc($order->customer_email) ?></p>
                                            </div>
                                        </td>
                                        
                                        <!-- Total Amount -->
                                        <td class="px-6 py-4 font-semibold text-[var(--neutral)]">
                                            $<?= number_format($order->total_amount, 2) ?>
                                        </td>
                                        
                                        <!-- Order Status -->
                                        <td class="px-6 py-4">
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
                                            <span class="bg-<?= $color ?>/20 text-<?= $color ?> px-3 py-1 rounded-full font-semibold text-xs">
                                                <?= ucfirst(esc($order->status)) ?>
                                            </span>
                                        </td>
                                        
                                        <!-- Payment Status -->
                                        <td class="px-6 py-4">
                                            <?php if ($order->payment_status === 'paid'): ?>
                                                <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full font-semibold text-xs">
                                                    Paid
                                                </span>
                                            <?php else: ?>
                                                <span class="bg-red-500/20 text-red-500 px-3 py-1 rounded-full font-semibold text-xs">
                                                    Unpaid
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <!-- Date -->
                                        <td class="px-6 py-4 text-[var(--neutral)]/80 text-sm">
                                            <?= date('M d, Y', strtotime($order->created_at)) ?>
                                        </td>
                                        
                                        <!-- Actions -->
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <!-- View Details -->
                                                <a href="/admin/orders/show/<?= esc($order->id) ?>"
                                                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-3 py-2 rounded text-[var(--secondary)] transition duration-200"
                                                    title="View Details">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                
                                                <!-- Delete (only for pending orders) -->
                                                <?php if ($order->status === 'pending'): ?>
                                                    <button onclick="confirmDelete(<?= esc($order->id) ?>, '<?= esc($order->order_number) ?>')"
                                                        class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 px-3 py-2 rounded text-[var(--primary)] transition duration-200"
                                                        title="Delete Order">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
        <div class="bg-[#1b1b1b] border border-[var(--secondary)] rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold text-[var(--neutral)] mb-4">Confirm Delete</h3>
            <p class="text-[var(--neutral)]/80 mb-6">
                Are you sure you want to delete order <span id="deleteOrderNumber" class="text-[var(--primary)] font-semibold"></span>?
            </p>
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" 
                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-4 py-2 rounded transition duration-200">
                    Cancel
                </button>
                <button onclick="deleteOrder()" 
                        class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-4 py-2 rounded transition duration-200">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let deleteOrderId = null;

        function confirmDelete(orderId, orderNumber) {
            deleteOrderId = orderId;
            document.getElementById('deleteOrderNumber').textContent = orderNumber;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteOrderId = null;
        }

        function deleteOrder() {
            if (!deleteOrderId) return;

            fetch('/admin/orders/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + deleteOrderId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error deleting order: ' + error);
            });
        }
    </script>
</body>
</html>