<?= view('components/head'); ?>

<header class="flex justify-between items-center px-6 md:px-10 py-6 border-b border-[var(--secondary)]/20 bg-[var(--accent)] sticky top-0 z-50">
    <a href="/user/profile">
        <h1 class="text-xl md:text-2xl font-semibold text-[var(--secondary)]">🔥 Edo Ember Gallery</h1>
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex space-x-8 text-[var(--neutral)] text-sm">
        <a href="/user/profile" class="hover:text-[var(--primary)] transition">My Profile</a>
        <a href="/user/products" class="hover:text-[var(--primary)] transition">Products</a>
        <a href="/user/orders" class="hover:text-[var(--primary)] transition">My Orders</a>
    </nav>

    <!-- Desktop User Info & Logout -->
    <div class="hidden md:flex items-center gap-4">
        <div class="text-right">
            <p class="text-[var(--neutral)] text-sm font-semibold">
                <?= esc(session()->get('userName')) ?>
            </p>
            <p class="text-[var(--secondary)] text-xs">
                Member
            </p>
        </div>
        <a href="/logout"
            class="bg-[var(--primary)]/20 hover:bg-[var(--primary)] text-[var(--primary)] hover:text-[var(--neutral)] px-4 py-2 rounded-lg font-semibold transition duration-200 border border-[var(--primary)]">
            Logout
        </a>
    </div>

    <!-- Mobile Menu Button -->
    <button id="mobileMenuBtn" class="md:hidden text-[var(--neutral)] focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</header>

<!-- Mobile Menu -->
<div id="mobileMenu" class="hidden md:hidden bg-[#1b1b1b] border-b border-[var(--secondary)]/20 sticky top-[73px] z-40">
    <nav class="flex flex-col px-6 py-4 space-y-4">
        <!-- User Info -->
        <div class="pb-4 border-b border-[var(--secondary)]/20">
            <p class="text-[var(--neutral)] text-sm font-semibold">
                <?= esc(session()->get('userName')) ?>
            </p>
            <p class="text-[var(--secondary)] text-xs">
                Member
            </p>
        </div>

        <!-- Menu Links -->
        <a href="/user/profile" class="text-[var(--neutral)] hover:text-[var(--primary)] transition">My Profile</a>
        <a href="/user/orders" class="text-[var(--neutral)] hover:text-[var(--primary)] transition">My Orders</a>
        <a href="/" class="text-[var(--neutral)] hover:text-[var(--primary)] transition">Browse Gallery</a>

        <!-- Logout Button -->
        <a href="/logout"
            class="bg-[var(--primary)]/20 hover:bg-[var(--primary)] text-[var(--primary)] hover:text-[var(--neutral)] px-4 py-3 rounded-lg font-semibold transition duration-200 border border-[var(--primary)] text-center">
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