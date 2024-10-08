<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $image = get_sub_field('image');
    $floatingImage = get_sub_field('floating_image');
    $text = get_sub_field('text');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="banner-boxed<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="container-wrapper" style="background-image: url('<?= wp_get_attachment_image_url($image, 'large');?>;">
            <div class="subline">
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
                <span><?= $subline; ?></span>
            </div>
            <h2><?= $headline; ?></h2>
            <span class="text"><?= $text; ?></span>
            <?php if( have_rows('buttons')):?>
                <div class="buttons">
                    <?php while( have_rows('buttons') ): the_row();
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
            <?php if($floatingImage):?><img class="floating" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($floatingImage, 'large'); ?>"><?php endif;?>
        </div>
    </div>
</section>