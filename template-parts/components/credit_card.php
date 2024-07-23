<?php
    $image = get_sub_field('image');
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
?>
<section class="credit-card">
    <div class="container">
        <a class="content-wrapper" href="<?= $buttonUrl; ?>">
            <div class="image" style="background-image: url('<?= wp_get_attachment_image_url($image, 'large');?>;">
            </div>
            <div class="content">
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
                <h2><?= $headline; ?></h2>
                <span><?= $text; ?></span>
                <button type="button" class="btn btn-white">
                    <?= $buttonText; ?>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </a>
    </div>
</section>