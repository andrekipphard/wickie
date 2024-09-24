<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $text = get_sub_field('text');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
?>
<section class="headline-subline-text" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <?php if($subline): ?>
            <span class="highlight">
                <?= $subline; ?>
            </span>
        <?php endif;?>
        <h2><?= $headline; ?></h2>
        <span>
            <?= $text; ?>
        </span>
    </div>
</section>