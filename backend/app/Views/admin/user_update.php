<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Update User']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-[var(--neutral)]/60 mb-4">
                <a href="/admin/users" class="hover:text-[var(--secondary)] transition">Users</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Update User</span>
            </div>
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Update User</h1>
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
            User updated successfully!
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
            <span id="errorText"></span>
        </div>

        <!-- Update Form -->
        <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-8 border border-[var(--secondary)]/20 max-w-2xl">
            <form id="updateForm" onsubmit="handleUpdate(event)">
                <input type="hidden" name="id" value="<?= esc($user->id) ?>">

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            First Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text"
                            name="first_name"
                            value="<?= esc($user->first_name) ?>"
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
                            value="<?= esc($user->middle_name ?? '') ?>"
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
                            value="<?= esc($user->last_name) ?>"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            placeholder="Enter last name"
                            required>
                    </div>

                    <!-- Email (Read Only) -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Email
                        </label>
                        <input type="email"
                            value="<?= esc($user->email) ?>"
                            class="w-full bg-[var(--accent)]/50 border border-[var(--secondary)]/20 rounded-lg px-4 py-3 text-[var(--neutral)]/60 cursor-not-allowed"
                            readonly>
                        <p class="text-[var(--neutral)]/50 text-xs mt-1">Email cannot be changed</p>
                    </div>

                    <!-- User Type -->
                    <div class="md:col-span-2">
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            User Type <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="type"
                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                            required>
                            <option value="user" <?= $user->type === 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $user->type === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-[var(--secondary)]/20">
                    <a href="/admin/users"
                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                        Update User
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

            fetch('/admin/users/update', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('successMessage').classList.remove('hidden');
                        setTimeout(() => {
                            window.location.href = '/admin/users';
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