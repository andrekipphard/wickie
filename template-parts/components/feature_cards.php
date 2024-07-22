<?php
    $hightlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $headline = get_sub_field('headline');
?>
<section class="feature-cards">
    <div class="container">
        <div class="text">
            <div class="subline">
                <span class="highlight">
                    <?= $hightlightText; ?>
                </span>
                <span><?= $subline; ?></span>
            </div>
            <h2><?= $headline; ?></h2>
        </div>
        <?php if( have_rows('content_box')):?>
            <div class="content-boxes">
                <?php while( have_rows('content_box') ): the_row();
                $contentBoxHeadline = get_sub_field('content_box_headline');
                $contentBoxText = get_sub_field('content_box_text');
                $contentBoxButtonText = get_sub_field('content_box_button_text');
                $contentBoxImage = get_sub_field('content_box_image');
                $contentBoxButtonUrl = get_sub_field('content_box_button_url');?>
                    <a class="content-box" href="<?= $contentBoxButtonUrl; ?>">
                        <div class="content">
                            <h3 class="title"><?= $contentBoxHeadline; ?></h3>
                            <span><?= $contentBoxText; ?></span>
                            <button type="button" class="btn btn-link">
                                <?= $contentBoxButtonText; ?>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                        <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($contentBoxImage, 'large');?>">
                    </a>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
</section>