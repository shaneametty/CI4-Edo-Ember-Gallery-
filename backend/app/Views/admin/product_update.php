<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Update Product']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-[var(--neutral)]/60 mb-4">
                <a href="/admin/products" class="hover:text-[var(--secondary)] transition">Products</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Update Product</span>
            </div>
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Update Product</h1>
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

        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6">
            Product updated successfully!
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
            <span id="errorText"></span>
        </div>

        <!-- Update Form -->
        <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-8 border border-[var(--secondary)]/20 max-w-2xl">
            <form id="updateForm" onsubmit="handleUpdate(event)">
                <input type="hidden" name="id" value="<?= esc($product->id) ?>">

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div class="md:col-span-2">
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Product Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text"
                            name="name"
                            value="<?= esc($product->name) ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter product name"
                            required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Category <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="category"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            required>
                            <option value="artwork" <?= $product->category === 'artwork' ? 'selected' : '' ?>>Artwork</option>
                            <option value="artbook" <?= $product->category === 'artbook' ? 'selected' : '' ?>>Artbook</option>
                            <option value="merchandise" <?= $product->category === 'merchandise' ? 'selected' : '' ?>>Merchandise</option>
                        </select>
                    </div>

                    <!-- Artist -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Artist
                        </label>
                        <input type="text"
                            name="artist"
                            value="<?= esc($product->artist ?? '') ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter artist name">
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Price <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number"
                            name="price"
                            value="<?= esc($product->price) ?>"
                            step="0.01"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="0.00"
                            required>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Stock <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number"
                            name="stock"
                            value="<?= esc($product->stock) ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="0"
                            required>
                    </div>

                    <!-- Image URL -->
                    <div class="md:col-span-2">
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Image URL
                        </label>
                        <input type="url"
                            name="image_url"
                            value="<?= esc($product->image_url ?? '') ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="https://example.com/image.jpg">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Description
                        </label>
                        <textarea name="description"
                            rows="4"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter product description"><?= esc($product->description ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-[var(--secondary)]/20">
                    <a href="/admin/products"
                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= view('components/footer'); ?>

    <script>
        function handleUpdate(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            // Hide previous messages
            document.getElementById('successMessage').classList.add('hidden');
            document.getElementById('errorMessage').classList.add('hidden');

            fetch('/admin/products/update', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('successMessage').classList.remove('hidden');
                        setTimeout(() => {
                            window.location.href = '/admin/products';
                        }, 1500);
                    } else {
                        document.getElementById('errorText').textContent = data.message;
                        document.getElementById('errorMessage').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    document.getElementById('errorText').textContent = 'An error occurred: ' + error;
                    document.getElementById('errorMessage').classList.remove('hidden');
                });
        }
    </script>
</body>

</html>