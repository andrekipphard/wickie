<?php
    $layout = get_sub_field('layout');
    $showButtons = get_sub_field('show_buttons');
    $buttonOneStyle = get_sub_field('button_one_style');
    $buttonTwoStyle = get_sub_field('button_two_style');
    $buttonOneText = get_sub_field('button_one_text');
    $buttonOneUrl = get_sub_field('button_one_url');
    $buttonOneIcon = get_sub_field('button_one_icon');
    $buttonTwoText = get_sub_field('button_two_text');
    $buttonTwoUrl = get_sub_field('button_two_url');
    $buttonTwoIcon = get_sub_field('button_two_icon');
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $mediaType = get_sub_field('media_type');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $image = get_sub_field('image');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $backgroundImage = get_sub_field('background_image');
    $backgroundImageSize = get_sub_field('background_image_size');
    $backgroundImagePosition = get_sub_field('background_image_position');
    $backgroundImageRepeat = get_sub_field('background_image_repeat');
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
?>
<section class="image-content"<?php if($backgroundColor):?> style="background: <?= $backgroundColor; ?>; <?php endif;?>
    <?php if ($textColor): ?>
        color: <?= $textColor; ?>;
    <?php endif; ?>
    <?php if ($backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ? $backgroundImageSize : 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ? $backgroundImageRepeat : 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ? $backgroundImagePosition : 'center center'; ?>;
    <?php endif; ?>
">
    <div class="container">
        <div class="image" <?php if($layout == 'Image Left'):?>style="order:0"<?php endif;?><?php if($layout == 'Image Right'):?>style="order:1"<?php endif;?>>
                <?php if($mediaType === 'Image'):?>
                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>">
                <?php endif;?>
                <?php if($mediaType === 'Video'):?>
                    <video controls autoplay muted preload="metadata" class="video">
                        <source src="<?= $video; ?>" type="video/mp4">
                    </video>
                <?php endif;?>
                <?php if($mediaType === 'Youtube'):?>
                    <div class="iframe-container">
                        <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                <?php endif;?>
                <?php if($mediaType === 'Lottie'):?>
                    <?= $lottie; ?>
            <?php endif;?>
        </div>
        <div class="content">
            <?php if($highlightText):?>
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
            <?php endif;?>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
            <?php if( have_rows('list_item')):?>
                <ul>
                    <?php while( have_rows('list_item') ): the_row();
                    $list_item_icon = get_sub_field('list_item_icon');
                    $list_item_text = get_sub_field('list_item_text');
                    $list_item_color = get_sub_field('list_item_color');?>
                        <li><i <?php if($list_item_color):?> style="color: <?= $list_item_color; ?>;"<?php endif;?> class="bi bi-<?= $list_item_icon; ?>"></i><span><?= $list_item_text; ?></span></li>
                    <?php endwhile;?>
                </ul>
            <?php endif;?>
            <?php if( have_rows('button')):?>
                <div class="cta">
                    <?php while( have_rows('button') ): the_row();
                    $buttonStyle = get_sub_field('button_style');
                    $buttonText = get_sub_field('button_text');
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');?>
                        <a href="<?=$buttonUrl;?>">
                            <?php if($buttonStyle == 'Link'):?>
                                <button type="button" class="btn btn-link">
                                    <?= $buttonText; ?>
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            <?php else:?>
                                <button type="button" class="btn btn-primary">
                                    <?php if($buttonStyle == 'Icon Left'):?><i class="bi bi-<?= $buttonIcon; ?>" style="margin-right:10px;"></i><?php endif;?>
                                    <?= $buttonText; ?>
                                    <?php if($buttonStyle == 'Icon Right'):?><i class="bi bi-<?= $buttonIcon; ?>"></i><?php endif;?>
                                </button>
                            <?php endif;?>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>