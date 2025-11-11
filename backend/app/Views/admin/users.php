<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Users Management']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[var(--neutral)]">Users Management</h1>
                <p class="text-[var(--neutral)]/70 mt-2">Manage all users in the system</p>
            </div>
            <a href="/admin/users/create"
                class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                + Add New User
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
        <?php if (is_string($listOfUsers)): ?>
            <div class="bg-[#1b1b1b] border border-[var(--secondary)] text-[var(--neutral)] px-6 py-4 rounded-lg">
                <?= esc($listOfUsers) ?>
            </div>
        <?php else: ?>
            <!-- Users Table -->
            <div class="bg-[#1b1b1b] rounded-lg shadow-xl overflow-hidden border border-[var(--secondary)]/20">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[var(--secondary)]/20 border-b border-[var(--secondary)]/30">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[var(--neutral)]">Status</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-[var(--neutral)]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--secondary)]/10">
                            <?php if (empty($listOfUsers)): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-[var(--neutral)]/60">
                                        No users found
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($listOfUsers as $user): ?>
                                    <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                                        <td class="px-6 py-4 text-[var(--neutral)]">
                                            <?= esc($user->id) ?>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--neutral)]">
                                            <?= esc($user->first_name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->last_name) ?>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--neutral)]/80">
                                            <?= esc($user->email) ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if ($user->type === 'admin'): ?>
                                                <span class="bg-[var(--primary)]/20 text-[var(--primary)] px-3 py-1 rounded-full text-xs font-semibold">
                                                    Admin
                                                </span>
                                            <?php else: ?>
                                                <span class="bg-[var(--secondary)]/20 text-[var(--secondary)] px-3 py-1 rounded-full text-xs font-semibold">
                                                    User
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if ($user->is_active == 1): ?>
                                                <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full text-xs font-semibold">
                                                    Active
                                                </span>
                                            <?php else: ?>
                                                <span class="bg-red-500/20 text-red-500 px-3 py-1 rounded-full text-xs font-semibold">
                                                    Inactive
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <!-- Edit Button -->
                                                <a href="/admin/users/update/<?= esc($user->id) ?>"
                                                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--secondary)] px-3 py-2 rounded transition duration-200"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <button onclick="confirmDelete(<?= esc($user->id) ?>, '<?= esc($user->first_name . ' ' . $user->last_name) ?>')"
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
                Are you sure you want to delete user <span id="deleteUserName" class="text-[var(--primary)] font-semibold"></span>?
            </p>
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()"
                    class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--neutral)] px-4 py-2 rounded transition duration-200">
                    Cancel
                </button>
                <button onclick="deleteUser()"
                    class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-4 py-2 rounded transition duration-200">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <?= view('components/footer'); ?>

    <script>
        let deleteUserId = null;

        function confirmDelete(userId, userName) {
            deleteUserId = userId;
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteUserId = null;
        }

        function deleteUser() {
            if (!deleteUserId) return;

            fetch('/admin/users/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + deleteUserId
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
                    alert('Error deleting user: ' + error);
                });
        }
    </script>
</body>

</html>