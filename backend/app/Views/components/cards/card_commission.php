<div class="relative bg-[var(--accent)] border border-[var(--secondary)] rounded-2xl shadow-lg overflow-hidden h-[420px] flex flex-col justify-between hover:shadow-[0_0_15px_var(--secondary)] transition">
    <div class="absolute inset-0 border-2 border-[var(--primary)] rounded-2xl opacity-20 pointer-events-none"></div>

    <?php if (!empty($image)): ?>
        <div class="h-48 bg-cover bg-center" style="background-image: url('<?= esc($image) ?>');"></div>
    <?php endif; ?>

    <div class="p-6 flex flex-col justify-between flex-grow text-[var(--neutral)] relative z-10">
        <div>
            <h3 class="text-xl font-bold text-[var(--secondary)] mb-2"><?= esc($title) ?></h3>
            <p class="text-[var(--neutral)]/80 mb-4"><?= esc($desc) ?></p>
            <?php if (!empty($price)): ?>
                <p class="text-[var(--primary)] font-semibold mb-6">Starting at <?= esc($price) ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($href)): ?>
            <a href="<?= esc($href) ?>"
                class="border-2 border-[var(--primary)] text-[var(--primary)] font-semibold py-2 px-4 rounded-lg text-center hover:bg-[var(--primary)] hover:text-[var(--accent)] transition">
                Request Now
            </a>
        <?php endif; ?>
    </div>
</div>