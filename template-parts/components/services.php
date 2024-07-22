<?php
    $headline = get_sub_field('headline');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
?>
<section class="services">
    <div class="container">
        <div class="title">
            <h2><?= $headline; ?></h2>
            <a href="<?= $buttonUrl; ?>">
                <button type="button" class="btn btn-primary">
                    <?= $buttonText; ?>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </a>
        </div>
        <?php if( have_rows('content_box')):?>
            <div class="content-boxes">
                <?php while( have_rows('content_box') ): the_row();
                $contentBoxImage = get_sub_field('content_box_image');
                $contentBoxHighlightText = get_sub_field('content_box_highlight_text');
                $contentBoxHeadline = get_sub_field('content_box_headline');
                $contentBoxButtonText = get_sub_field('content_box_button_text');
                $contentBoxButtonUrl = get_sub_field('content_box_button_url');?>
                    <a class="content-box" href="<?= $contentBoxButtonUrl; ?>">
                        <img class="w-100" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($contentBoxImage, 'large');?>">
                        <div class="content">
                            <div class="text">
                                <span class="highlight">
                                    <?= $contentBoxHighlightText; ?>
                                </span>
                                <h3 class="title"><?= $contentBoxHeadline; ?></h3>
                            </div>
                            <button type="button" class="btn btn-link">
                                <?= $contentBoxButtonText; ?>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </a>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
</section>

<script>
// import function to register Swiper custom elements
import { register } from '../../node_modules/swiper/element/bundle';
// register Swiper custom elements
register();
</script>