<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Orders Management']) ?>

<body class="bg-[var(--accent)] font-sans text-[var(--neutral)]">
    <?= view('components/header_admin'); ?>
    <div class="mx-auto px-6 py-8 container">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-bold text-[var(--neutral)] text-3xl">Orders Management</h1>
                <p class="mt-2 text-[var(--neutral)]/70">Manage all orders in the shop</p>
            </div>
            <a href="/orders_create"
                class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                + Add New Order
            </a>
        </div>

        <!-- Orders Table -->
        <div class="bg-[#1b1b1b] shadow-xl border border-[var(--secondary)]/20 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[var(--secondary)]/20 border-[var(--secondary)]/30 border-b">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Order ID</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">User ID</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Product ID</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Quantity</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Total Price</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Payment Status</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Order Status</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--secondary)]/10">
                        <!-- Sample Order Row -->
                        <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                            <td class="px-6 py-4 text-[var(--neutral)]">1</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">2</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">1</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">1</td>
                            <td class="px-6 py-4 font-semibold text-[var(--neutral)]">$15,000.00</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500/20 px-2 py-1 rounded-full font-semibold text-green-500 text-xs">
                                    Paid
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500/20 px-2 py-1 rounded-full font-semibold text-green-500 text-xs">
                                    Completed
                                </span>
                            </td>
                            <td class="flex justify-center gap-2 px-6 py-4">
                                <a href="/orders_update"
                                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-3 py-2 rounded text-[var(--secondary)] transition duration-200"
                                    title="Edit">
                                    <i class="fa-pen-to-square fa-solid"></i>
                                </a>
                                <button onclick="confirmDeleteOrder(1)"
                                    class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 px-3 py-2 rounded text-[var(--primary)] transition duration-200"
                                    title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- More sample orders -->
                        <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                            <td class="px-6 py-4 text-[var(--neutral)]">2</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">3</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">5</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">2</td>
                            <td class="px-6 py-4 font-semibold text-[var(--neutral)]">$170.00</td>
                            <td class="px-6 py-4">
                                <span class="bg-red-500/20 px-2 py-1 rounded-full font-semibold text-red-500 text-xs">
                                    Unpaid
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-500/20 px-2 py-1 rounded-full font-semibold text-yellow-500 text-xs">
                                    Pending
                                </span>
                            </td>
                            <td class="flex justify-center gap-2 px-6 py-4">
                                <a href="/orders_update"
                                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-3 py-2 rounded text-[var(--secondary)] transition duration-200"
                                    title="Edit">
                                    <i class="fa-pen-to-square fa-solid"></i>
                                </a>
                                <button onclick="confirmDeleteOrder(2)"
                                    class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 px-3 py-2 rounded text-[var(--primary)] transition duration-200"
                                    title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                            <td class="px-6 py-4 text-[var(--neutral)]">3</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">2</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">8</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">3</td>
                            <td class="px-6 py-4 font-semibold text-[var(--neutral)]">$75.00</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500/20 px-2 py-1 rounded-full font-semibold text-green-500 text-xs">
                                    Paid
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500/20 px-2 py-1 rounded-full font-semibold text-green-500 text-xs">
                                    Completed
                                </span>
                            </td>
                            <td class="flex justify-center gap-2 px-6 py-4">
                                <a href="/orders_update"
                                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-3 py-2 rounded text-[var(--secondary)] transition duration-200"
                                    title="Edit">
                                    <i class="fa-pen-to-square fa-solid"></i>
                                </a>
                                <button onclick="confirmDeleteOrder(3)"
                                    class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 px-3 py-2 rounded text-[var(--primary)] transition duration-200"
                                    title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?= view('components/footer'); ?>

    <script>
        let deleteOrderId = null;

        function confirmDeleteOrder(orderId) {
            deleteOrderId = orderId;
            alert('Order deletion logic goes here for ID: ' + deleteOrderId);
        }
    </script>
</body>

</html>