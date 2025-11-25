<?= view('components/head'); ?>

<header class="top-0 z-50 sticky flex justify-between items-center bg-[var(--accent)] px-6 md:px-10 py-6 border-[var(--secondary)]/20 border-b">
    <a href="/dashboard">
        <h1 class="font-semibold text-[var(--secondary)] text-xl md:text-2xl">🔥 Edo Ember - Admin</h1>
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex space-x-8 text-[var(--neutral)] text-sm">
        <a href="/admin/users" class="hover:text-[var(--primary)] transition">Users</a>
        <a href="/admin/products" class="hover:text-[var(--primary)] transition">Products</a>
        <a href="/admin/orders" class="hover:text-[var(--primary)] transition">Orders</a>
    </nav>

    <!-- Desktop User Info & Logout -->
    <div class="hidden md:flex items-center gap-4">
        <div class="text-right">
            <p class="font-semibold text-[var(--neutral)] text-sm">
                <?= esc(session()->get('userName')) ?>
            </p>
            <p class="text-[var(--secondary)] text-xs">
                <?= ucfirst(esc(session()->get('userType'))) ?>
            </p>
        </div>
        <a href="/logout"
            class="bg-[var(--primary)]/20 hover:bg-[var(--primary)] px-4 py-2 border border-[var(--primary)] rounded-lg font-semibold text-[var(--primary)] hover:text-[var(--neutral)] transition duration-200">
            Logout
        </a>
    </div>

    <!-- Mobile Menu Button -->
    <button id="mobileMenuBtn" class="md:hidden focus:outline-none text-[var(--neutral)]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</header>

<!-- Mobile Menu -->
<div id="mobileMenu" class="hidden md:hidden top-[73px] z-40 sticky bg-[#1b1b1b] border-[var(--secondary)]/20 border-b">
    <nav class="flex flex-col space-y-4 px-6 py-4">
        <!-- User Info -->
        <div class="pb-4 border-[var(--secondary)]/20 border-b">
            <p class="font-semibold text-[var(--neutral)] text-sm">
                <?= esc(session()->get('userName')) ?>
            </p>
            <p class="text-[var(--secondary)] text-xs">
                <?= ucfirst(esc(session()->get('userType'))) ?>
            </p>
        </div>

        <!-- Menu Links -->
        <a href="/admin/users" class="text-[var(--neutral)] hover:text-[var(--primary)] transition">Users</a>
        <a href="/admin/products" class="text-[var(--neutral)] hover:text-[var(--primary)] transition">Products</a>
        <a href="/admin/orders" class="text-[var(--neutral)] hover:text-[var(--primary)] transition">Orders</a>

        <!-- Logout Button -->
        <a href="/logout"
            class="bg-[var(--primary)]/20 hover:bg-[var(--primary)] px-4 py-3 border border-[var(--primary)] rounded-lg font-semibold text-[var(--primary)] hover:text-[var(--neutral)] text-center transition duration-200">
            Logout
        </a>
    </nav>
</div>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!mobileMenuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Close mobile menu on window resize to desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>