<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Products Management']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[var(--neutral)]">Products Management</h1>
                <p class="text-[var(--neutral)]/70 mt-2">Manage artworks, artbooks, and merchandise</p>
            </div>
            <a href="/admin/products/create" 
               class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                + Add New Product
            </a>
        </div>

        <!-- Error/Success Messages -->
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

        <!-- Check if data is string (error message) -->
        <?php if (is_string($listOfProducts)): ?>
            <div class="bg-[#1b1b1b] border border-[var(--secondary)] text-[var(--neutral)] px-6 py-4 rounded-lg">
                <?= esc($listOfProducts) ?>
            </div>
        <?php else: ?>
            <!-- Products Table -->
            <div class="bg-[#1b1b1b] rounded-lg shadow-xl overflow-hidden border border-[var(--secondary)]/20">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[var(--secondary)]/20 border-b border-[var(--secondary)]/30">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Category</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Artist</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Price</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Stock</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Status</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-[var(--neutral)]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--secondary)]/10">
                            <?php if (empty($listOfProducts)): ?>
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-[var(--neutral)]/60">
                                        No products found
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($listOfProducts as $product): ?>
                                    <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                                        <td class="px-6 py-4 text-[var(--neutral)]">
                                            <?= esc($product->id) ?>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--neutral)]">
                                            <?= esc($product->name) ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php
                                            $categoryColors = [
                                                'artwork' => 'primary',
                                                'artbook' => 'secondary',
                                                'merchandise' => 'green-500'
                                            ];
                                            $color = $categoryColors[$product->category] ?? 'gray-500';
                                            ?>
                                            <span class="bg-[var(--<?= $color ?>)]/20 text-[var(--<?= $color ?>)] px-3 py-1 rounded-full text-xs font-semibold">
                                                <?= ucfirst(esc($product->category)) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--neutral)]/80">
                                            <?= esc($product->artist ?? 'N/A') ?>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--neutral)] font-semibold">
                                            $<?= number_format($product->price, 2) ?>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--neutral)]">
                                            <?= esc($product->stock) ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if ($product->is_available == 1): ?>
                                                <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full text-xs font-semibold">
                                                    Available
                                                </span>
                                            <?php else: ?>
                                                <span class="bg-red-500/20 text-red-500 px-3 py-1 rounded-full text-xs font-semibold">
                                                    Unavailable
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <!-- Edit Button -->
                                                <a href="/admin/products/update/<?= esc($product->id) ?>" 
                                                   class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--secondary)] px-3 py-2 rounded transition duration-200"
                                                   title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <button onclick="confirmDelete(<?= esc($product->id) ?>, '<?= esc($product->name) ?>')"
                                                        class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 text-[var(--primary)] px-3 py-2 rounded transition duration-200"
                                                        title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
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
                Are you sure you want to delete product <span id="deleteProductName" class="text-[var(--primary)] font-semibold"></span>?
            </p>
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" 
                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-4 py-2 rounded transition duration-200">
                    Cancel
                </button>
                <button onclick="deleteProduct()" 
                        class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-4 py-2 rounded transition duration-200">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <?= view('components/footer'); ?>

    <script>
        let deleteProductId = null;

        function confirmDelete(productId, productName) {
            deleteProductId = productId;
            document.getElementById('deleteProductName').textContent = productName;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteProductId = null;
        }

        function deleteProduct() {
            if (!deleteProductId) return;

            fetch('/admin/products/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + deleteProductId
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
                alert('Error deleting product: ' + error);
            });
        }
    </script>
</body>
</html>