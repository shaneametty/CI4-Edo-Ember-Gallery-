<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block opacity-50 px-6 py-2 rounded-lg font-semibold
               text-[var(--accent)] bg-[var(--secondary)]/50 cursor-not-allowed
               border border-[var(--secondary)] shadow-inner">
        <?= esc($label ?? 'Secondary') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-6 py-2 rounded-lg font-semibold
               text-[var(--accent)] bg-[var(--secondary)] border border-[var(--secondary)]/80
               hover:bg-transparent hover:text-[var(--secondary)]
               hover:shadow-[0_0_10px_rgba(255,215,0,0.4)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Secondary') ?>
    </a>

<?php else : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-6 py-2 rounded-lg font-semibold
               text-[var(--accent)] bg-[var(--secondary)] border border-[var(--secondary)]/80
               hover:bg-transparent hover:text-[var(--secondary)]
               hover:shadow-[0_0_14px_rgba(255,215,0,0.5)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Secondary') ?>
    </a>
<?php endif; ?>