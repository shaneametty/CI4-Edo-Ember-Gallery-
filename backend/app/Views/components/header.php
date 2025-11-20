<?php $session = session(); ?>

<header class="top-0 z-50 sticky flex justify-between items-center bg-[var(--accent)] px-10 py-6 border-[var(--secondary)]/20 border-b">
    <!-- Brand -->
    <a href="/">
        <h1 class="font-semibold text-[var(--secondary)] text-2xl">🔥 Edo Ember Gallery</h1>
    </a>

    <!-- Navigation -->
    <nav class="flex items-center justify-center gap-16 max-w-lg mx-auto text-[var(--neutral)] text-sm md:text-base">
        <a href="/" class="hover:text-[var(--primary)] transition">Home</a>
        <a href="/userProducts" class="hover:text-[var(--primary)] transition">Products</a>
        <a href="#about" class="hover:text-[var(--primary)] transition">About</a>
    </nav>


    <!-- Login / Profile -->
    <?php if ($session->has('user')):
        $user = $session->get('user');
        $profileImg = $user['photo'] ?? '/images/user_default.jpg';
    ?>
        <details class="group relative">
            <summary class="flex items-center space-x-2 focus:outline-none cursor-pointer list-none">
                <div class="border-[var(--primary)] border-2 rounded-full w-10 h-10 overflow-hidden">
                    <img src="<?= esc($profileImg) ?>" alt="Profile" class="w-10 h-10 object-cover">
                </div>
            </summary>
            <div class="right-0 z-50 absolute bg-[var(--accent)] shadow-lg mt-2 py-2 border border-[var(--secondary)] rounded-lg w-48">
                <?php if (strtolower($user['type'] ?? '') === 'admin'): ?>
                    <a href="dashboard" class="block hover:bg-gray-700 px-4 py-2 text-sm">Admin Dashboard</a>
                <?php else: ?>
                    <a href="/profile" class="block hover:bg-gray-700 px-4 py-2 text-sm">Profile</a>
                <?php endif; ?>
                <form method="get" action="/logout">
                    <button type="submit" class="block hover:bg-gray-700 px-4 py-2 w-full text-sm text-left">Logout</button>
                </form>
            </div>
        </details>
    <?php else: ?>
        <a href="/login">
            <?= view('components/buttons/button_primary', ['label' => 'Login', 'href' => '/login']); ?>
        </a>
    <?php endif; ?>
</header>