<?= view('components/head'); ?>

<section class="reveal-on-scroll relative py-16 px-6 md:px-10 text-center h-64 md:h-80"
    style="background-image: url('https://i.pinimg.com/736x/fa/49/c8/fa49c80f1f29e6c329e9639086d1a50a.jpg'); background-size: cover; background-position: center;">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full px-6 md:px-10">
        <h3 class="text-3xl font-bold text-[var(--neutral)] mb-4">Stay Updated</h3>
        <p class="text-[var(--neutral)]/80 mb-4 max-w-md text-center">
            Subscribe to our newsletter for the latest exhibits and featured artists.
        </p>

        <form class="max-w-md w-full flex flex-col sm:flex-row gap-4">
            <input
                type="email"
                placeholder="Your email"
                class="flex-1 px-4 py-2 rounded border border-[var(--secondary)] bg-[#1b1b1b] text-[var(--neutral)] focus:outline-none">

            <?= view('components/buttons/button_secondary', ['label' => 'Subscribe', 'href' => '#']); ?>
        </form>
    </div>
</section>