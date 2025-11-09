<?= view('components/head'); ?>

<header class="flex justify-between items-center px-10 py-6 border-b border-[var(--secondary)]/20 bg-[var(--accent)] sticky top-0 z-50">
    <a href="/">
        <h1 class="text-2xl font-semibold text-[var(--secondary)]">🔥 Edo Ember Gallery</h1>
    </a>

    <nav class="flex space-x-8 text-[var(--neutral)] text-sm md:text-base">
        <a href="/" class="hover:text-[var(--primary)] transition">Home</a>
        <a href="#" class="hover:text-[var(--primary)] transition">Exhibits</a>
        <a href="#" class="hover:text-[var(--primary)] transition">Artists</a>
        <a href="#" class="hover:text-[var(--primary)] transition">Shop</a>
        <a href="#" class="hover:text-[var(--primary)] transition">Blog</a>
        <a href="#" class="hover:text-[var(--primary)] transition">Contact</a>
    </nav>

    <a href="/login">
        <?= view('components/buttons/button_primary', ['label' => 'Login', 'href' => '/login']); ?>
    </a>
</header>