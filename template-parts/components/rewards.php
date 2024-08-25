<?php
    $highlightTextLeft = get_sub_field('highlight_text_left');
    $headlineLeft = get_sub_field('headline_left');
    $textLeft = get_sub_field('text_left');
    $buttonTextLeft = get_sub_field('button_text_left');
    $imageLeft = get_sub_field('image_left');
    $buttonUrlLeft = get_sub_field('button_url_left');
    $highlightTextRight = get_sub_field('highlight_text_right');
    $headlineRight = get_sub_field('headline_right');
    $buttonTextRight = get_sub_field('button_text_right');
    $imageRight = get_sub_field('image_right');
    $buttonUrlRight = get_sub_field('button_url_right');
?>
<section class="rewards">
    <div class="container">
        <a class="content-wrapper cryptoback" href="<?= $buttonUrlLeft; ?>">
            <div class="content">
                <span class="highlight">
                    <?= $highlightTextLeft; ?>
                </span>
                <h2><?= $headlineLeft; ?></h2>
                <span><?= $textLeft; ?></span>
                <button type="button" class="btn btn-primary">
                    <?= $buttonTextLeft; ?>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
            <div class="image" style="background-image: url('<?= wp_get_attachment_image_url($imageLeft, 'large');?>;">
            </div>
        </a>
        <?php if($buttonUrlRight):?><a class="content-wrapper token" href="<?= $buttonUrlRight; ?>">
            <div class="content">
                <div class="subline">
                    <span class="highlight">
                        <?= $highlightTextRight; ?>
                    </span>
                    <button type="button" class="btn btn-link">
                        <?= $buttonTextRight; ?>
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
                <h2><?= $headlineRight; ?></h2>
            </div>
            <div class="image">
            <?php if($imageRight):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageRight, 'large');?>"><?php endif;?>
            </div>
        </a>
        <?php endif;?>
        <?php if(!$buttonUrlRight):?>
            <div class="content" style="    display: flex;align-content: center;justify-content: center;align-items: center;">
            <?php if($imageRight):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageRight, 'large');?>" style="width: 65%; height: auto;"><?php endif;?>
            </div>
        <?php endif;?>
    </div>
</section>