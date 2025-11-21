<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 My Profile']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_user'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[var(--neutral)]">My Profile</h1>
            <p class="text-[var(--neutral)]/70 mt-2">Manage your account information and settings</p>
        </div>

        <!-- Success Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Validation Errors -->
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

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Profile Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-[var(--secondary)]/20">
                    <div class="text-center">
                        <!-- Avatar Placeholder -->
                        <div class="w-24 h-24 mx-auto mb-4 bg-[var(--secondary)]/20 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-[var(--secondary)] text-4xl"></i>
                        </div>
                        
                        <h2 class="text-xl font-bold text-[var(--neutral)] mb-1">
                            <?= esc($user->getFullName()) ?>
                        </h2>
                        
                        <p class="text-[var(--secondary)] text-sm mb-4">
                            <?= esc($user->email) ?>
                        </p>

                        <div class="flex justify-center gap-2 mb-6">
                            <span class="bg-[var(--secondary)]/20 text-[var(--secondary)] px-3 py-1 rounded-full text-xs font-semibold">
                                <?= ucfirst(esc($user->type)) ?>
                            </span>
                            <?php if ($user->isActive()): ?>
                                <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full text-xs font-semibold">
                                    Active
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="space-y-2 text-sm text-[var(--neutral)]/60">
                            <div class="flex items-center justify-between">
                                <span>Member since:</span>
                                <span class="text-[var(--neutral)]"><?= date('M Y', strtotime($user->created_at)) ?></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Last updated:</span>
                                <span class="text-[var(--neutral)]"><?= date('M d, Y', strtotime($user->updated_at)) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-6 border border-red-500/20 mt-6">
                    <h3 class="text-lg font-bold text-red-500 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Danger Zone
                    </h3>
                    <p class="text-[var(--neutral)]/70 text-sm mb-4">
                        Deactivating your account will disable your access.
                    </p>
                    <button onclick="confirmDeactivate()"
                        class="w-full bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-white px-4 py-3 rounded-lg font-semibold transition duration-200 border border-red-500">
                        <i class="fa-solid fa-user-slash mr-2"></i>
                        Deactivate Account
                    </button>
                </div>
            </div>

            <!-- Edit Profile Form -->
            <div class="lg:col-span-2">
                <div class="bg-[#1b1b1b] rounded-lg shadow-xl p-8 border border-[var(--secondary)]/20">
                    <h2 class="text-2xl font-bold text-[var(--neutral)] mb-6">Edit Profile Information</h2>
                    
                    <form action="/user/profile/update" method="post">
                        <div class="space-y-6">
                            <!-- Personal Information Section -->
                            <div>
                                <h3 class="text-lg font-semibold text-[var(--secondary)] mb-4 pb-2 border-b border-[var(--secondary)]/20">
                                    Personal Information
                                </h3>
                                
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

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                                            Email <span class="text-[var(--primary)]">*</span>
                                        </label>
                                        <input type="email"
                                            name="email"
                                            value="<?= esc($user->email) ?>"
                                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                            placeholder="user@example.com"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Change Password Section -->
                            <div>
                                <h3 class="text-lg font-semibold text-[var(--secondary)] mb-4 pb-2 border-b border-[var(--secondary)]/20">
                                    Change Password (Optional)
                                </h3>
                                
                                <p class="text-[var(--neutral)]/60 text-sm mb-4">
                                    Leave blank if you don't want to change your password
                                </p>

                                <div class="grid md:grid-cols-3 gap-6">
                                    <!-- Current Password -->
                                    <div>
                                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                                            Current Password
                                        </label>
                                        <input type="password"
                                            name="current_password"
                                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                            placeholder="Current password">
                                    </div>

                                    <!-- New Password -->
                                    <div>
                                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                                            New Password
                                        </label>
                                        <input type="password"
                                            name="new_password"
                                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                            placeholder="New password">
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <label class="block text-[var(--neutral)] font-semibold mb-2">
                                            Confirm Password
                                        </label>
                                        <input type="password"
                                            name="confirm_password"
                                            class="w-full bg-[var(--accent)] border border-[var(--secondary)]/30 rounded-lg px-4 py-3 text-[var(--neutral)] focus:outline-none focus:border-[var(--secondary)] transition"
                                            placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-[var(--secondary)]/20">
                            <a href="/"
                                class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Deactivate Account Confirmation Modal -->
    <div id="deactivateModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
        <div class="bg-[#1b1b1b] border border-red-500 rounded-lg p-6 max-w-md w-full mx-4">
            <div class="text-center mb-4">
                <i class="fa-solid fa-triangle-exclamation text-red-500 text-5xl mb-4"></i>
                <h3 class="text-xl font-bold text-[var(--neutral)] mb-2">Deactivate Account?</h3>
            </div>
            
            <p class="text-[var(--neutral)]/80 mb-6 text-center">
                Are you sure you want to deactivate your account? You will be logged out and won't be able to access your account.
            </p>
            
            <div class="bg-red-500/10 border border-red-500/30 rounded-lg p-4 mb-6">
                <p class="text-red-500 text-sm">
                    <i class="fa-solid fa-info-circle mr-2"></i>
                    This action will disable your account access immediately.
                </p>
            </div>

            <div class="flex flex-col gap-3">
                <button onclick="deactivateAccount()"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg transition duration-200 font-semibold">
                    Yes, Deactivate My Account
                </button>
                <button onclick="closeDeactivateModal()"
                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-4 py-3 rounded-lg transition duration-200">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <?= view('components/footer'); ?>

    <script>
        function confirmDeactivate() {
            document.getElementById('deactivateModal').classList.remove('hidden');
        }

        function closeDeactivateModal() {
            document.getElementById('deactivateModal').classList.add('hidden');
        }

        function deactivateAccount() {
            fetch('/user/profile/deactivate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Your account has been deactivated. You will be logged out.');
                        window.location.href = '/logout';
                    } else {
                        alert('Error: ' + data.message);
                        closeDeactivateModal();
                    }
                })
                .catch(error => {
                    alert('Error deactivating account: ' + error);
                    closeDeactivateModal();
                });
        }

        // Close modal when clicking outside
        document.getElementById('deactivateModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeactivateModal();
            }
        });
    </script>
</body>

</html>