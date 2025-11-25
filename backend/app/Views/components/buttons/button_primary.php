<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block opacity-50 px-6 py-2 rounded-lg font-semibold
               text-[var(--primary)] border border-[var(--primary)] cursor-not-allowed
               bg-[var(--accent)] shadow-inner">
        <?= esc($label ?? 'Primary') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-6 py-2 rounded-lg font-semibold
               text-[var(--primary)] border border-[var(--primary)] bg-[var(--accent)]
               hover:bg-[var(--primary)] hover:text-[var(--accent)]
               hover:shadow-[0_0_10px_rgba(158,42,43,0.6)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Primary') ?>
    </a>

<?php else : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-6 py-2 rounded-lg font-semibold
               text-[var(--primary)] border border-[var(--primary)] bg-[var(--accent)]
               hover:bg-[var(--primary)] hover:text-[var(--accent)]
               hover:shadow-[0_0_14px_rgba(158,42,43,0.6)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Primary') ?>
    </a>
<?php endif; ?>