<div class="bg-[var(--accent)] border-2 border-[var(--primary)] rounded-2xl shadow-lg overflow-hidden h-[420px] flex flex-col hover:shadow-[0_0_15px_var(--primary)] transition">
    <?php if (!empty($image)): ?>
        <div class="h-48 w-full bg-cover bg-center" style="background-image: url('<?= esc($image) ?>');"></div>
    <?php endif; ?>

    <div class="p-6 flex flex-col justify-between flex-grow text-[var(--neutral)]">
        <div>
            <h3 class="text-2xl font-bold text-[var(--primary)] mb-2"><?= esc($title) ?></h3>
            <?php if (!empty($date)): ?>
                <p class="text-[var(--secondary)] text-sm mb-3 italic"><?= esc($date) ?></p>
            <?php endif; ?>
            <p class="text-[var(--neutral)]/80 mb-6"><?= esc($description) ?></p>
        </div>

        <?php if (!empty($href)): ?>
            <a href="<?= esc($href) ?>"
                class="border-2 border-[var(--primary)] text-[var(--primary)] font-semibold py-2 px-4 rounded-lg text-center hover:bg-[var(--primary)] hover:text-[var(--accent)] transition">
                View Event
            </a>
        <?php endif; ?>
    </div>
</div>