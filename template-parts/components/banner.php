<?php
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $layout = get_sub_field('layout');
    $padding = get_sub_field('padding');
    $marginTop = get_sub_field('margin_top');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
?>
<section class="<?= $layout == 'Single Image' ? 'banner-two-buttons' : 'banner'; ?>"style="<?php if($padding == 'Yes'):?> padding-top: 7rem; padding-bottom: 7rem;<?php endif;?><?php if($marginTop == 'No'):?> margin-top:0px;<?php endif;?>">
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
            <?php if($layout === 'Single Image' || $layout === 'Multiple Images'):?><div class="image">
                <?php if( have_rows('image')):?>
                    <div class="images">
                        <?php while( have_rows('image') ): the_row();
                        $image = get_sub_field('image');
                        $overlay = get_sub_field('overlay');?>
                            <img class="<?= $overlay == 'Yes' ? 'overlay' : ''; ?>" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large');?>">
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
            
            <?php endif;?>
                <?php if($layout === 'Video'):?><div class="image">
                    <video controls autoplay muted preload="metadata" class="video">
                        <source src="<?= $video; ?>" type="video/mp4">
                    </video>
                </div>
                <?php endif;?>
                <?php if($layout === 'Youtube'):?><div class="image">
                    <div class="iframe-container">
                        <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <?php endif;?>
                <?php if($layout === 'Lottie'):?><div class="image">
                    <?= $lottie; ?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>