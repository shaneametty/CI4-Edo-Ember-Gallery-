<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Create Product']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-[var(--neutral)]/60 mb-4">
                <a href="/admin/products" class="hover:text-[var(--secondary)] transition">Products</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Create New Product</span>
            </div>
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Create New Product</h1>
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
        <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-8 border border-[var(--secondary)]/20 max-w-2xl">
            <form action="/admin/products/create" method="post">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div class="md:col-span-2">
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Product Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               value="<?= old('name') ?>"
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
                            <option value="artwork" <?= old('category') === 'artwork' ? 'selected' : '' ?>>Artwork</option>
                            <option value="artbook" <?= old('category') === 'artbook' ? 'selected' : '' ?>>Artbook</option>
                            <option value="merchandise" <?= old('category') === 'merchandise' ? 'selected' : '' ?>>Merchandise</option>
                        </select>
                    </div>

                    <!-- Artist -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Artist
                        </label>
                        <input type="text" 
                               name="artist" 
                               value="<?= old('artist') ?>"
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
                               value="<?= old('price') ?>"
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
                               value="<?= old('stock') ?>"
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
                               value="<?= old('image_url') ?>"
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
                                  placeholder="Enter product description"><?= old('description') ?></textarea>
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
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= view('components/footer'); ?>
</body>
</html>