<?php
$headline = get_sub_field('headline');
$subline = get_sub_field('subline');
$highlightText = get_sub_field('highlight_text');
$text = get_sub_field('text');
$backgroundImage = get_sub_field('background_image');
$backgroundImageSize = get_sub_field('background_image_size');
$backgroundImagePosition = get_sub_field('background_image_position');
$backgroundImageRepeat = get_sub_field('background_image_repeat');
$backgroundColor = get_sub_field('background_color');
$textColor = get_sub_field('text_color');
$backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
$textLayout = get_sub_field('position_text');
$layout = get_sub_field('layout');
$backgroundVideo = get_sub_field('background_video');
$videoType = get_sub_field('video_type');
$videoTypeMobile = get_sub_field('video_type_mobile');
$mediaType = get_sub_field('media_type');
$video = get_sub_field('video');
$youtube = get_sub_field('youtube');
$lottie = get_sub_field('lottie');
$image = get_sub_field('image');
$fullHeight = get_sub_field('full_height');
$isHero = get_sub_field('is_hero');
$overlayColor = get_sub_field('overlay_color');
$mobileBackgroundImage = get_sub_field('mobile_background_image');
$mobileBackgroundVideo = get_sub_field('mobile_background_video');
$mobileBackgroundLottie = get_sub_field('mobile_background_lottie');
$mobileBackgroundType = get_sub_field('mobile_background_type');
$mobileBackgroundImageUrl = $mobileBackgroundImage ? wp_get_attachment_image_url($mobileBackgroundImage, 'large') : '';

// Position Fields
$positionFields = [
    'highlightText' => 'highlight_text_position',
    'headline' => 'headline_position',
    'subline' => 'subline_position',
    'text' => 'text_position',
    'buttons' => 'buttons_position',
    'images' => 'images_position',
];
foreach ($positionFields as $key => $field) {
    ${"position" . ucfirst($key)} = '';
    if (have_rows('position')) {
        while (have_rows('position')) {
            the_row();
            ${"position" . ucfirst($key)} = get_sub_field($field);
        }
    }
}

// Margin Fields
$marginFields = [
    'highlightText' => 'highlight_text',
    'headline' => 'headline',
    'subline' => 'subline',
    'text' => 'text',
    'buttons' => 'buttons',
    'images' => 'images',
];
$marginTop = $marginBottom = [];
foreach ($marginFields as $key => $field) {
    $marginTop[$key] = '';
    $marginBottom[$key] = '';
}
if (have_rows('margin')) {
    while (have_rows('margin')) {
        the_row();
        if (have_rows('margin_top')) {
            while (have_rows('margin_top')) {
                the_row();
                foreach ($marginFields as $key => $field) {
                    $marginTop[$key] = get_sub_field($field);
                }
            }
        }
        if (have_rows('margin_bottom')) {
            while (have_rows('margin_bottom')) {
                the_row();
                foreach ($marginFields as $key => $field) {
                    $marginBottom[$key] = get_sub_field($field);
                }
            }
        }
    }
}
?>

<section class="hero-new<?php if (is_front_page() || is_page(2189)): ?><?php if ($isHero == 'Yes'): ?> minus-margin-top<?php endif;?><?php endif;?><?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($overlayColor): ?>--overlay-color: <?= $overlayColor; ?>;<?php endif; ?>
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    <?php if ($layout === 'Kein Background Video' && $backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ?: 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ?: 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ?: 'center center'; ?>;
    <?php endif; ?>
    <?php if ($layout === 'Background Video' && $mobileBackgroundImageUrl): ?>
        background-image: url('<?= $mobileBackgroundImageUrl; ?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    <?php endif;?>
    <?php if ($fullHeight === 'Yes'): ?>
        <?php if (is_front_page() || is_page(2189)): ?>
            height: calc(100vh - 32px);
        <?php else: ?>
            height: calc(100vh - 148px);
        <?php endif; ?>
        display: flex; align-items: center; padding-top:0; padding-bottom:0;
    <?php endif; ?>
">
<div class="video-overlay hide-desktop"></div>

    <?php if ($layout === 'Background Video'): ?>
    
    <div class="video-wrapper">
        <?php if ($videoType === 'Youtube' && $backgroundVideo): ?>
            <iframe class="background-video"
                    src="<?= $backgroundVideo; ?>?autoplay=1&mute=1&loop=1&playlist=<?= basename($backgroundVideo); ?>&controls=0&modestbranding=1&rel=0&showinfo=0"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
            </iframe>
        <?php elseif ($videoType === 'Video' && $backgroundVideo): ?>
            <video autoplay muted loop playsinline class="background-video">
                <source src="<?= $backgroundVideo; ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <?php if ($textLayout === 'Center' || $textLayout === 'With Image'): ?>
            <div class="video-overlay hide-mobile"></div>
        <?php endif; ?>
    </div>
    <div class="video-wrapper-mobile">
        <?php if ($mobileBackgroundType === 'Video' && $videoTypeMobile === 'Youtube' && $mobileBackgroundVideo): ?>
            <iframe class="background-video"
                    src="<?= $mobileBackgroundVideo; ?>?autoplay=1&mute=1&loop=1&playlist=<?= basename($mobileBackgroundVideo); ?>&controls=0&modestbranding=1&rel=0&showinfo=0"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
            </iframe>
        <?php elseif ($mobileBackgroundType === 'Video' && $videoTypeMobile === 'Video' && $mobileBackgroundVideo): ?>
            <video autoplay muted loop playsinline class="background-video">
                <source src="<?= $mobileBackgroundVideo; ?>" type="video/mp4">
            </video>
        <?php elseif ($mobileBackgroundType === 'Lottie' && $mobileBackgroundLottie): ?>
            <?= $mobileBackgroundLottie; ?>
        <?php endif; ?>
        <?php if ($textLayout === 'Center' || $textLayout === 'With Image'): ?>
            <div class="video-overlay hide-mobile"></div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="container-wrapper">    <div class="container">
        <div class="content-image" style="
            <?php if ($textLayout === 'Right'): ?> flex-direction: row-reverse; <?php endif; ?>
        ">
            <div class="content" style="
                <?php if ($textLayout === 'Center'): ?>
                    text-align: center;
                    align-items: center;
                    flex-basis: 100%;
                <?php elseif ($textLayout === 'Left' || $textLayout === 'Right'): ?>
                    background: rgba(0, 0, 0, 0.5);
                    padding: 40px;
                    flex-basis: 60%;
                    border-radius: 20px;
                <?php endif; ?>
            ">
                <?php if ($highlightText): ?>
                    <span class="highlight" style="
                        <?php if ($positionHighlightText): ?> order: <?= $positionHighlightText; ?>; <?php endif; ?>
                        <?php if ($marginTop['highlightText'] || $marginBottom['highlightText']): ?>
                            margin-top: <?= $marginTop['highlightText'] ?: '0'; ?>px;
                            margin-bottom: <?= $marginBottom['highlightText'] ?: '0'; ?>px;
                        <?php endif; ?>
                    ">
                        <?= $highlightText; ?>
                    </span>
                <?php endif; ?>

                <h1 style="
                    <?php if ($positionHeadline): ?> order: <?= $positionHeadline; ?>; <?php endif; ?>
                    <?php if ($marginTop['headline'] || $marginBottom['headline']): ?>
                        margin-top: <?= $marginTop['headline'] ?: '0'; ?>px;
                        margin-bottom: <?= $marginBottom['headline'] ?: '0'; ?>px;
                    <?php endif; ?>
                ">
                    <?= $headline; ?>
                </h1>

                <?php if ($subline): ?>
                    <h3 style="
                        <?php if ($positionSubline): ?> order: <?= $positionSubline; ?>; <?php endif; ?>
                        <?php if ($marginTop['subline'] || $marginBottom['subline']): ?>
                            margin-top: <?= $marginTop['subline'] ?: '0'; ?>px;
                            margin-bottom: <?= $marginBottom['subline'] ?: '0'; ?>px;
                        <?php endif; ?>
                    ">
                        <?= $subline; ?>
                    </h3>
                <?php endif; ?>
                <?php if ($text): ?>  
                <span style="
                    <?php if ($positionText): ?> order: <?= $positionText; ?>; <?php endif; ?>
                    <?php if ($marginTop['text'] || $marginBottom['text']): ?>
                        margin-top: <?= $marginTop['text'] ?: '0'; ?>px;
                        margin-bottom: <?= $marginBottom['text'] ?: '0'; ?>px;
                    <?php endif; ?>
                ">
                    <?= $text; ?>
                </span>
                <?php endif; ?>
                <?php if (have_rows('buttons')): ?>
                    <div class="cta multiple-buttons" style="
                        <?php if ($positionButtons): ?> order: <?= $positionButtons; ?>; <?php endif; ?>
                        <?php if ($marginTop['buttons'] || $marginBottom['buttons']): ?>
                            margin-top: <?= $marginTop['buttons'] ?: '0'; ?>px;
                            margin-bottom: <?= $marginBottom['buttons'] ?: '0'; ?>px;
                        <?php endif; ?>
                    ">
                        <?php while (have_rows('buttons')): the_row();
                            $buttonText = get_sub_field('button_text');
                            $buttonUrl = get_sub_field('button_url');
                            $buttonIcon = get_sub_field('button_icon');
                            $buttonIconPosition = get_sub_field('button_icon_position');
                            $buttonStyle = get_sub_field('button_style'); ?>
                            <a href="<?= $buttonUrl; ?>">
                                <button type="button" class="btn btn-<?= $buttonStyle; ?><?php if (!$buttonText): ?> round<?php endif; ?>">
                                    <?php if ($buttonIconPosition === 'Left'): ?>
                                        <i class="bi bi-<?= $buttonIcon; ?><?php if ($buttonText): ?> margin-right<?php endif; ?>"></i>
                                    <?php endif; ?>
                                    <?= $buttonText; ?>
                                    <?php if ($buttonIconPosition === 'Right'): ?>
                                        <i class="bi bi-<?= $buttonIcon; ?><?php if ($buttonText): ?> margin-left<?php endif; ?>"></i>
                                    <?php endif; ?>
                                </button>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('images')): ?>
                    <div class="cta images" style="
                        <?php if ($positionImages): ?> order: <?= $positionImages; ?>; <?php endif; ?>
                        <?php if ($marginTop['images'] || $marginBottom['images']): ?>
                            margin-top: <?= $marginTop['images'] ?: '0'; ?>px;
                            margin-bottom: <?= $marginBottom['images'] ?: '0'; ?>px;
                        <?php endif; ?>
                    ">
                        <?php while (have_rows('images')): the_row();
                            $imagesImage = get_sub_field('images_image'); ?>
                            <div class="image">
                                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imagesImage, 'large'); ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($textLayout === 'With Image' || $textLayout === ''): ?>
                <?php if ($mediaType === 'Image' && $layout === 'Kein Background Video'): ?>
                    <div class="image" style="background-image: url('<?= wp_get_attachment_image_url($image, 'large'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
                <?php elseif ($mediaType === 'Video'): ?>
                    <div class="image"<?php if ($positionImages): ?> style="order: <?= $positionImages ?>"<?php endif; ?>>
                        <video controls autoplay muted preload="metadata" class="video">
                            <source src="<?= $video; ?>" type="video/mp4">
                        </video>
                    </div>
                <?php elseif ($mediaType === 'Youtube' && $layout === 'Kein Background Video'): ?>
                    <div class="image"<?php if ($positionImages): ?> style="order: <?= $positionImages ?>"<?php endif; ?>>
                        <div class="iframe-container">
                            <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php elseif ($mediaType === 'Lottie' && $layout === 'Kein Background Video'): ?>
                    <div class="image"<?php if ($positionImages): ?> style="order: <?= $positionImages ?>"<?php endif; ?>>
                        <?= $lottie; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div></div>

</section>
