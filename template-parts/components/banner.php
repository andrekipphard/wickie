<?php
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $layout = get_sub_field('layout');
?>
<section class="<?= $layout == 'Single Image' ? 'banner-two-buttons' : 'banner'; ?>">
    <div class="container">
        <div class="<?= $layout == 'Single Image' ? 'banner-two-buttons-wrapper' : 'banner-wrapper'; ?>">
            <div class="content">
                <h2><?=$headline;?></h2>
                <span><?=$text;?></span>
                <?php if( have_rows('cta')):?>
                    <div class="cta">
                        <?php while( have_rows('cta') ): the_row();
                        $buttonUrl = get_sub_field('button_url');
                        $buttonIcon = get_sub_field('button_icon');
                        $buttonText = get_sub_field('button_text');?>
                            <a href="<?=$buttonUrl;?>">
                                <button type="button" class="btn btn-white">
                                    <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                    <?= $buttonText; ?>
                                </button>
                            </a>
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
            </div>
            <?php if( have_rows('image')):?>
                <div class="images">
                    <?php while( have_rows('image') ): the_row();
                    $image = get_sub_field('image');
                    $overlay = get_sub_field('overlay');?>
                        <img class="<?= $overlay == 'Ja' ? 'overlay' : ''; ?>" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large');?>">
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>