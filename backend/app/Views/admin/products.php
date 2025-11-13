<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Products Management']) ?>

<body class="bg-[var(--accent)] font-sans text-[var(--neutral)]">
    <?= view('components/header_admin'); ?>
    <div class="mx-auto px-6 py-8 container">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-bold text-[var(--neutral)] text-3xl">Products Management</h1>
                <p class="mt-2 text-[var(--neutral)]/70">Manage artworks, artbooks, and merchandise</p>
            </div>
            <a href="products_create"
                class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                + Add New Product
            </a>
        </div>

        <!-- Products Table -->
        <div class="bg-[#1b1b1b] shadow-xl border border-[var(--secondary)]/20 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[var(--secondary)]/20 border-[var(--secondary)]/30 border-b">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">ID</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Name</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Category</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Artist</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Price</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Stock</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-left">Status</th>
                            <th class="px-6 py-4 font-semibold text-[var(--neutral)] text-sm text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--secondary)]/10">
                        <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                            <td class="px-6 py-4 text-[var(--neutral)]">1</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">Sample Product</td>
                            <td class="px-6 py-4">
                                <span class="bg-[var(--primary)]/20 px-3 py-1 rounded-full font-semibold text-[var(--primary)] text-xs">
                                    Artwork
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[var(--neutral)]/80">Sample Artist</td>
                            <td class="px-6 py-4 font-semibold text-[var(--neutral)]">$99.99</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">10</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500/20 px-3 py-1 rounded-full font-semibold text-green-500 text-xs">Available</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="/products_update"
                                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-3 py-2 rounded text-[var(--secondary)] transition duration-200"
                                        title="Edit">
                                        <i class="fa-pen-to-square fa-solid"></i>
                                    </a>

                                    <button onclick="confirmDelete(1, 'Sample Product')"
                                        class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 px-3 py-2 rounded text-[var(--primary)] transition duration-200"
                                        title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black/70">
        <div class="bg-[#1b1b1b] mx-4 p-6 border border-[var(--secondary)] rounded-lg w-full max-w-md">
            <h3 class="mb-4 font-bold text-[var(--neutral)] text-xl">Confirm Delete</h3>
            <p class="mb-6 text-[var(--neutral)]/80">
                Are you sure you want to delete product <span id="deleteProductName" class="font-semibold text-[var(--primary)]"></span>?
            </p>
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()"
                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-4 py-2 rounded text-[var(--neutral)] transition duration-200">
                    Cancel
                </button>
                <button onclick="deleteProduct()"
                    class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 px-4 py-2 rounded text-[var(--neutral)] transition duration-200">
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
            alert('Product deletion logic goes here for ID: ' + deleteProductId);
            closeDeleteModal();
        }
    </script>
</body>

</html>