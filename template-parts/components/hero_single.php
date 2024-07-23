<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $image = get_sub_field('image');
    $highlightText = get_sub_field('highlight_text');
    $text = get_sub_field('text');
?>
<section class="hero-single">
    <div class="container">
        <div class="content">
            <span class="highlight">
                <?= $highlightText; ?>
            </span>
            <h1><?= $headline; ?></h1>
            <?php if($subline):?><h3><?= $subline; ?></h3><?php endif;?>
            <span><?= $text; ?></span>
        </div>
        <div class="image">
            <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>">
        </div>
    </div>
</section>