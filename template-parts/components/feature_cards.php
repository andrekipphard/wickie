<?php
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $headline = get_sub_field('headline');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="feature-cards<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="text">
            <div class="subline">
                <span class="highlight">
                    <?= $highlightText; ?>
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
                $contentBoxMediaType = get_sub_field('content_box_media_type');
                $contentBoxImage = get_sub_field('content_box_image');
                $contentBoxVideo = get_sub_field('content_box_video');
                $contentBoxYoutube = get_sub_field('content_box_youtube');
                $contentBoxLottie = get_sub_field('content_box_lottie');
                $contentBoxButtonUrl = get_sub_field('content_box_button_url');
                $contentBoxBgColor = get_sub_field('content_box_bg_color');
                $contentBoxTextColor = get_sub_field('content_box_text_color');?>
                    <a class="content-box" href="<?= $contentBoxButtonUrl; ?>" style="<?php if($contentBoxBgColor):?>background: <?= $contentBoxBgColor; ?>;<?php endif;?><?php if($contentBoxTextColor):?>color: <?= $contentBoxTextColor; ?>;<?php endif;?>">
                        <div class="content">
                            <h3 class="title"><?= $contentBoxHeadline; ?></h3>
                            <span><?= $contentBoxText; ?></span>
                            <button type="button" class="btn btn-link" style="<?php if($contentBoxTextColor):?>color: <?= $contentBoxTextColor; ?>;<?php endif;?>">
                                <?= $contentBoxButtonText; ?>
                                <i class="bi bi-chevron-right" style="<?php if($contentBoxTextColor):?>background: <?= $contentBoxTextColor; ?>;<?php endif;?><?php if($contentBoxBgColor):?>color: <?= $contentBoxBgColor; ?>;<?php endif;?>"></i>
                            </button>
                        </div>
                        <?php if($contentBoxMediaType === 'Image'):?><div class="image">
                            <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($contentBoxImage, 'large');?>">
                        </div>
                        <?php endif;?>
                        <?php if($contentBoxMediaType === 'Video'):?><div class="image">
                            <video controls autoplay muted preload="metadata" class="video">
                                <source src="<?= $contentBoxVideo; ?>" type="video/mp4">
                            </video>
                        </div>
                        <?php endif;?>
                        <?php if($contentBoxMediaType === 'Youtube'):?><div class="image">
                            <div class="iframe-container">
                                <iframe src="<?= $contentBoxYoutube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if($contentBoxMediaType === 'Lottie'):?><div class="image">
                            <?= $contentBoxLottie; ?>
                        </div>
                        <?php endif;?>
                    </a>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
</section>