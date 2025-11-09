<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block opacity-50 px-5 py-2 rounded-lg font-medium
               text-[var(--primary)] border border-[var(--primary)] cursor-not-allowed
               bg-transparent shadow-inner">
        <?= esc($label ?? 'Link') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-5 py-2 rounded-lg font-medium
               text-[var(--primary)] border border-[var(--primary)] bg-transparent
               hover:bg-[var(--primary)] hover:text-[var(--accent)]
               hover:shadow-[0_0_10px_rgba(158,42,43,0.5)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Link') ?>
    </a>

<?php else : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block px-5 py-2 rounded-lg font-medium
               text-[var(--primary)] border border-[var(--primary)] bg-transparent
               hover:bg-[var(--primary)] hover:text-[var(--accent)]
               hover:shadow-[0_0_12px_rgba(158,42,43,0.6)]
               transition-all duration-300 ease-out">
        <?= esc($label ?? 'Link') ?>
    </a>
<?php endif; ?>