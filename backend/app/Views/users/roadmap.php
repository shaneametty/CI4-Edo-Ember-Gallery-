<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('components/head', ['title' => '🔥 Road Map']) ?>
</head>

<body
    class="relative bg-cover bg-center min-h-screen font-sans text-[var(--neutral)]"
    style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://i.pinimg.com/1200x/eb/87/23/eb87234f0ec8bd8a719d80e228fb30a8.jpg');">

    <?= view('components/header') ?> <!-- header now inside body so it inherits fonts / styles -->

    <main class="z-10 relative mx-auto px-6 py-16 max-w-7xl">
        <header class="mb-8 text-center">
            <h1 class="font-serif font-bold text-[var(--secondary)] text-4xl md:text-5xl leading-tight">Road Map</h1>
            <p class="mt-3 text-[var(--neutral)]/80 text-lg">Our to-do list for Edo Ember Gallery</p>
        </header>

        <section class="space-y-6">
            <!-- Item -->
            <article class="flex md:flex-row flex-col justify-between md:items-center gap-4 bg-[var(--accent)] shadow-lg p-6 rounded-2xl">
                <div>
                    <h3 class="mb-1 font-serif text-[var(--secondary)] text-xl">Database & Seeding</h3>
                    <p class="mb-1 text-[var(--secondary)]/80">Three DBs: users, products/services, orders</p>
                    <p class="font-medium text-[var(--secondary)]/60 text-sm">Priority: High</p>
                </div>
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 rounded-full font-semibold text-sm" onchange="updateStatusColor(this)">
                        <option value="planned">Planned</option>
                        <option value="in-progress" selected>In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
            </article>

            <!-- Item -->
            <article class="flex md:flex-row flex-col justify-between md:items-center gap-4 bg-[var(--accent)] shadow-lg p-6 rounded-2xl">
                <div>
                    <h3 class="mb-1 font-serif text-[var(--secondary)] text-xl">CRUD for Users</h3>
                    <p class="mb-1 text-[var(--secondary)]/80">Create, update, soft-delete user accounts</p>
                    <p class="font-medium text-[var(--secondary)]/60 text-sm">Priority: High</p>
                </div>
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 rounded-full font-semibold text-sm" onchange="updateStatusColor(this)">
                        <option value="planned" selected>Planned</option>
                        <option value="in-progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
            </article>

            <!-- Item -->
            <article class="flex md:flex-row flex-col justify-between md:items-center gap-4 bg-[var(--accent)] shadow-lg p-6 rounded-2xl">
                <div>
                    <h3 class="mb-1 font-serif text-[var(--secondary)] text-xl">CRUD for Orders</h3>
                    <p class="mb-1 text-[var(--secondary)]/80">Admin: update, cancel, and manage orders</p>
                    <p class="font-medium text-[var(--secondary)]/60 text-sm">Priority: Medium</p>
                </div>
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 rounded-full font-semibold text-sm" onchange="updateStatusColor(this)">
                        <option value="planned" selected>Planned</option>
                        <option value="in-progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
            </article>

            <!-- Item -->
            <article class="flex md:flex-row flex-col justify-between md:items-center gap-4 bg-[var(--accent)] shadow-lg p-6 rounded-2xl">
                <div>
                    <h3 class="mb-1 font-serif text-[var(--secondary)] text-xl">CRUD for Products</h3>
                    <p class="mb-1 text-[var(--secondary)]/80">Admin product management (create / update / delete)</p>
                    <p class="font-medium text-[var(--secondary)]/60 text-sm">Priority: Medium</p>
                </div>
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 rounded-full font-semibold text-sm" onchange="updateStatusColor(this)">
                        <option value="planned" selected>Planned</option>
                        <option value="in-progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
            </article>

            <article class="flex md:flex-row flex-col justify-between md:items-center gap-4 bg-[var(--accent)] shadow-lg p-6 rounded-2xl">
                <div>
                    <h3 class="mb-1 font-serif text-[var(--secondary)] text-xl">Frontend Websites</h3>
                    <p class="mb-1 text-[var(--secondary)]/80">Landing, login, sign up, mood board, road map</p>
                    <p class="font-medium text-[var(--secondary)]/60 text-sm">Priority: Low</p>
                </div>
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 rounded-full font-semibold text-sm" onchange="updateStatusColor(this)">
                        <option value="planned">Planned</option>
                        <option value="in-progress">In Progress</option>
                        <option value="done" selected>Done</option>
                    </select>
                </div>
            </article>
        </section>
    </main>

    <?= view('components/footer') ?>

    <script>
        function updateStatusColor(select) {
            switch (select.value) {
                case 'planned':
                    select.style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--secondary') || '#a67d43';
                    select.style.color = getComputedStyle(document.documentElement).getPropertyValue('--neutral') || '#e5e2dc';
                    break;
                case 'in-progress':
                    select.style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--primary') || '#ad0013';
                    select.style.color = getComputedStyle(document.documentElement).getPropertyValue('--neutral') || '#e5e2dc';
                    break;
                case 'done':
                    select.style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('') || '#ff7141ff';
                    select.style.color = getComputedStyle(document.documentElement).getPropertyValue('--neutral') || '#e5e2dc';
                    break;
            }
        }

        document.querySelectorAll('select').forEach(sel => updateStatusColor(sel));
    </script>
</body>

</html>