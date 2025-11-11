<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Update User']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-[var(--neutral)]/60 mb-4">
                <a href="/users" class="hover:text-[var(--secondary)] transition">Users</a>
                <span>/</span>
                <span class="text-[var(--neutral)]">Update User</span>
            </div>
            <h1 class="text-3xl font-bold text-[var(--neutral)]">Update User</h1>
        </div>

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

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            First Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text" name="first_name" value="John" class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition" required>
                    </div>

                    <!-- Middle Name -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Middle Name
                        </label>
                        <input type="text" name="middle_name" value="" class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition">
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Last Name <span class="text-[var(--primary)]">*</span>
                        </label>
                        <input type="text" name="last_name" value="Doe" class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition" required>
                    </div>

                    <!-- Email (Read Only) -->
                    <div>
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            Email
                        </label>
                        <input type="email" value="johndoe@example.com" class="w-full bg-[var(--accent)]/50 border border-[var(--secondary)]/20 rounded-lg px-4 py-3 text-[var(--neutral)]/60 cursor-not-allowed" readonly>
                        <p class="text-[var(--neutral)]/50 text-xs mt-1">Email cannot be changed</p>
                    </div>

                    <!-- User Type -->
                    <div class="md:col-span-2">
                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                            User Type <span class="text-[var(--primary)]">*</span>
                        </label>
                        <select name="type" class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition" required>
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-[var(--secondary)]/20">
                    <a href="/test/users" class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
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
            // Show success message only
            document.getElementById('successMessage').classList.remove('hidden');
            setTimeout(() => {
                window.location.href = '/test/users';
            }, 1500);
        }
    </script>
</body>

</html>