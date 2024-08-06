<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $text = get_sub_field('text');
?>
<section class="headline-subline-text">
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