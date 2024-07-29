<?php
    $layout = get_sub_field('layout');
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
    $image = get_sub_field('image');
?>
<section class="image-content">
    <div class="container">
        <div class="image" <?php if($layout == 'Image Left'):?>style="order:0"<?php endif;?><?php if($layout == 'Image Right'):?>style="order:1"<?php endif;?>>
            <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>">
        </div>
        <div class="content">
            <?php if($highlightText):?>
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
            <?php endif;?>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
            <div class="cta">
                <a href="<?=$buttonOneUrl;?>">
                    <?php if($buttonOneStyle == 'Link'):?>
                        <button type="button" class="btn btn-link">
                            <?= $buttonOneText; ?>
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    <?php else:?>
                        <button type="button" class="btn btn-primary">
                            <?php if($buttonOneStyle == 'Icon Left'):?><i class="bi bi-<?= $buttonOneIcon; ?>" style="margin-right:10px;"></i><?php endif;?>
                            <?= $buttonOneText; ?>
                            <?php if($buttonOneStyle == 'Icon Right'):?><i class="bi bi-<?= $buttonOneIcon; ?>"></i><?php endif;?>
                        </button>
                    <?php endif;?>
                </a>
                <a href="<?=$buttonOneUrl;?>">
                    <?php if($buttonTwoStyle == 'Link'):?>
                        <button type="button" class="btn btn-link">
                            <?= $buttonTwoText; ?>
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    <?php else:?>
                        <button type="button" class="btn btn-primary">
                            <?php if($buttonTwoStyle == 'Icon Left'):?><i class="bi bi-<?= $buttonTwoIcon; ?>" style="margin-right:10px;"></i><?php endif;?>
                            <?= $buttonTwoText; ?>
                            <?php if($buttonTwoStyle == 'Icon Right'):?><i class="bi bi-<?= $buttonTwoIcon; ?>"></i><?php endif;?>
                        </button>
                    <?php endif;?>
                </a>
            </div>
        </div>
    </div>
</section>