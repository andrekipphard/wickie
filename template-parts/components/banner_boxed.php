<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
    $image = get_sub_field('image');
    $floatingImage = get_sub_field('floating_image');
    $text = get_sub_field('text');
?>
<section class="banner-boxed">
    <div class="container">
        <a href="<?= $buttonUrl; ?>" style="background-image: url('<?= wp_get_attachment_image_url($image, 'large');?>;">
            <div class="subline">
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
                <span><?= $subline; ?></span>
            </div>
            <h2><?= $headline; ?></h2>
            <span class="text"><?= $text; ?></span>
            <button type="button" class="btn btn-white">
                <?= $buttonText; ?>
                <i class="bi bi-arrow-right"></i>
            </button>
            <img class="floating" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($floatingImage, 'large'); ?>">
        </a>
    </div>
</section>