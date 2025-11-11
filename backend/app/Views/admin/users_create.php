<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Create User']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <div class="mb-8">
            <div class="flex items-center gap-2 text-[var(--neutral)]/60 mb-4">
                <a href="/users" class="hover:text-[var(--secondary)] transition">Users</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Create New User</span>
            </div>
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Create New User</h1>
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
            <form action="/test/users/create" method="post">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            First Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text"
                            name="first_name"
                            value="<?= old('first_name') ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter first name"
                            required>
                    </div>

                    <!-- Middle Name -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Middle Name
                        </label>
                        <input type="text"
                            name="middle_name"
                            value="<?= old('middle_name') ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter middle name">
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Last Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text"
                            name="last_name"
                            value="<?= old('last_name') ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter last name"
                            required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Email <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="email"
                            name="email"
                            value="<?= old('email') ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="user@example.com"
                            required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Password <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="password"
                            name="password"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter password"
                            required>
                    </div>

                    <!-- User Type -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            User Type <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="type"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            required>
                            <option value="user" <?= old('type') === 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= old('type') === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-[var(--secondary)]/20">
                    <a href="/test/users"
                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= view('components/footer'); ?>
</body>

</html>