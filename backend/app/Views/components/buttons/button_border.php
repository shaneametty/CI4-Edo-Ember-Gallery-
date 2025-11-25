<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block opacity-50 px-6 py-2 rounded-lg font-semibold
               text-[var(--secondary)] border border-[var(--secondary)] cursor-not-allowed
               bg-transparent shadow-inner">
        <?= esc($label ?? 'Secondary') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-6 py-2 rounded-lg font-semibold
               text-[var(--secondary)] border border-[var(--secondary)] bg-transparent
               hover:bg-[var(--secondary)] hover:text-[var(--accent)]
               hover:shadow-[0_0_12px_rgba(255,215,0,0.4)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Secondary') ?>
    </a>

<?php else : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-6 py-2 rounded-lg font-semibold
               text-[var(--secondary)] border border-[var(--secondary)] bg-transparent
               hover:bg-[var(--secondary)] hover:text-[var(--accent)]
               hover:shadow-[0_0_14px_rgba(255,215,0,0.5)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Secondary') ?>
    </a>
<?php endif; ?>