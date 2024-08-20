<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $imageTopLeft = get_sub_field('image_top_left');
    $imageBottomLeft = get_sub_field('image_bottom_left');
    $imageTopRight = get_sub_field('image_top_right');
    $imageBottomRight = get_sub_field('image_bottom_left');
    $imageCenter = get_sub_field('image_center');
?>
<section class="hero">
    <div class="container">
        <div class="content">
            <h1><?= $headline; ?></h1>
            <span><?= $subline; ?></span>
            <?php if( have_rows('cta')):?>
                <div class="cta">
                    <?php while( have_rows('cta') ): the_row();
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');
                    $buttonText = get_sub_field('button_text');
                    $buttonType = get_sub_field('button_type');
                    $buttonIconPosition = get_sub_field('button_icon_position');?>
                        <a href="<?=$buttonUrl;?>">
                            <button type="button" class="btn btn-<?= $buttonType; ?>">
                            <?php if($buttonIconPosition == 'Left'):?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif;?>
                                <?= $buttonText; ?>
                            <?php if($buttonIconPosition == 'Right'):?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif;?>
                            </button>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
        <div class="images">
            <div class="top-left">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageTopLeft, 'large');?>">
            </div>
            <div class="bottom-left">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageBottomLeft, 'large');?>">
            </div>
            <div class="top-right">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageTopRight, 'large');?>">
            </div>
            <div class="bottom-right">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageBottomRight, 'large');?>">
            </div>
            <div class="center">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageCenter, 'large');?>">
            </div>
        </div>
    </div>
</section>