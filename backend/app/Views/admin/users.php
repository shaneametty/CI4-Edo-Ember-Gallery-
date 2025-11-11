<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Users Management']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <?= view('components/header_admin'); ?>

    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[var(--neutral)]">Users Management</h1>
                <p class="text-[var(--neutral)]/70 mt-2">Manage all users in the system</p>
            </div>
            <a href="/users_create"
                class="bg-[var(--primary)] hover:bg-[var(--primary)]/80 text-[var(--neutral)] px-6 py-3 rounded-lg font-semibold transition duration-200">
                + Add New User
            </a>
        </div>

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
                        <!-- Example Admin -->
                        <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                            <td class="px-6 py-4 text-[var(--neutral)]">1</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">John Doe</td>
                            <td class="px-6 py-4 text-[var(--neutral)]/80">johndoe@example.com</td>
                            <td class="px-6 py-4 text-[var(--primary)] font-semibold">Admin</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full text-xs font-semibold">Active</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="/users_update"
                                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--secondary)] px-3 py-2 rounded transition duration-200"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 text-[var(--primary)] px-3 py-2 rounded transition duration-200"
                                        title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Example Regular User -->
                        <tr class="hover:bg-[var(--secondary)]/5 transition duration-150">
                            <td class="px-6 py-4 text-[var(--neutral)]">2</td>
                            <td class="px-6 py-4 text-[var(--neutral)]">Jane Smith</td>
                            <td class="px-6 py-4 text-[var(--neutral)]/80">janesmith@example.com</td>
                            <td class="px-6 py-4 text-[var(--secondary)] font-semibold">User</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full text-xs font-semibold">Active</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="/users_update"
                                        class="bg-[var(--secondary)]/20 hover:bg-[var(--secondary)]/30 text-[var(--secondary)] px-3 py-2 rounded transition duration-200"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button class="bg-[var(--primary)]/20 hover:bg-[var(--primary)]/30 text-[var(--primary)] px-3 py-2 rounded transition duration-200"
                                        title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-[var(--neutral)]/60">
                                No other users found
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?= view('components/footer'); ?>
</body>

</html>