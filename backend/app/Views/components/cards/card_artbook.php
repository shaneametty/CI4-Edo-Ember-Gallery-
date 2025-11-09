<div class="bg-gradient-to-b from-[#2b2b2b] to-[var(--accent)] border border-[var(--secondary)] rounded-2xl shadow-lg overflow-hidden h-[420px] flex flex-col hover:shadow-[0_0_15px_var(--secondary)] transition">
    <?php if (!empty($image)): ?>
        <div class="h-56 w-full overflow-hidden">
            <img src="<?= esc($image) ?>" alt="<?= esc($title) ?>" class="w-full h-full object-cover hover:scale-105 transition duration-500">
        </div>
    <?php endif; ?>

    <div class="p-6 flex flex-col justify-between flex-grow text-[var(--neutral)]">
        <div>
            <h3 class="text-xl font-bold text-[var(--secondary)] mb-2"><?= esc($title) ?></h3>
            <?php if (!empty($author)): ?>
                <p class="text-[var(--neutral)]/70 text-sm mb-3 italic">by <?= esc($author) ?></p>
            <?php endif; ?>
            <?php if (!empty($desc)): ?>
                <p class="text-[var(--neutral)]/80 mb-4"><?= esc($desc) ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($href)): ?>
            <a href="<?= esc($href) ?>"
                class="border-2 border-[var(--secondary)] text-[var(--secondary)] font-semibold py-2 px-4 rounded-lg text-center hover:bg-[var(--secondary)] hover:text-[var(--accent)] transition">
                Explore Book
            </a>
        <?php endif; ?>
    </div>
</div>