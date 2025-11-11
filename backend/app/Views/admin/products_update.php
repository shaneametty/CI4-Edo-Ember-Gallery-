<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Update Product']) ?>

<body class="bg-[var(--accent)] font-sans text-[var(--neutral)]">
    <?= view('components/header_admin'); ?>

    <div class="mx-auto px-6 py-8 container">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4 text-[var(--neutral)]/60">
                <a href="/products" class="hover:text-[var(--secondary)] transition">Products</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Update Product</span>
            </div>
            <h1 class="font-bold text-[var(--neutral)] text-3xl">Update Product</h1>
        </div>

        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-500/20 mb-6 px-4 py-3 border border-green-500 rounded-lg text-green-500">
            Product updated successfully!
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-500/20 mb-6 px-4 py-3 border border-red-500 rounded-lg text-red-500">
            <span id="errorText"></span>
        </div>

        <!-- Update Form -->
        <div class="bg-[#1b1b1b] shadow-xl p-8 border border-[var(--secondary)]/20 rounded-lg max-w-2xl">
            <form id="updateForm" onsubmit="handleUpdate(event)">
                <input type="hidden" name="id" value="">

                <div class="gap-6 grid md:grid-cols-2">
                    <!-- Product Name -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Product Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text" name="name" value="" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" placeholder="Enter product name" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Category <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="category" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" required>
                            <option value="artwork">Artwork</option>
                            <option value="artbook">Artbook</option>
                            <option value="merchandise">Merchandise</option>
                        </select>
                    </div>

                    <!-- Artist -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Artist
                        </label>
                        <input type="text" name="artist" value="" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" placeholder="Enter artist name">
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Price <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="price" value="" step="0.01" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" placeholder="0.00" required>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Stock <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="number" name="stock" value="" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" placeholder="0" required>
                    </div>

                    <!-- Image URL -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Image URL
                        </label>
                        <input type="url" name="image_url" value="" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" placeholder="https://example.com/image.jpg">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-semibold text-[var(--neutral)]">
                            Description
                        </label>
                        <textarea name="description" rows="4" class="bg-[var(--accent)] px-4 py-3 border border-[var(--secondary)]/30 focus:border-[var(--secondary)] rounded-lg focus:outline-none w-full text-[var(--neutral)] transition" placeholder="Enter product description"></textarea>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-[var(--secondary)]/20 border-t">
                    <a href="/test/products" class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 px-6 py-3 rounded-lg font-semibold text-[var(--neutral)] transition duration-200">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= view('components/footer'); ?>
</body>

</html>