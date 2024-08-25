<?php
    $anchor = get_sub_field('anchor');
    $image = get_sub_field('image');
    $featuresTitle = get_sub_field('features_title');
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
?>
<section class="credit-card-content" id="<?= $anchor; ?>">
    <div class="container">
        <div class="credit-card-image">
        <?php if($image):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>"><?php endif;?>
            <span class="features-title"><?= $featuresTitle; ?></span>
            <?php if( have_rows('feature')):?>
                <div class="feature-wrapper">
                    <?php while( have_rows('feature') ): the_row();
                    $featureTitle = get_sub_field('feature_title');
                    $featureInfo = get_sub_field('feature_info');?>
                        <div class="feature">
                            <span class="feature-title"><?= $featureTitle; ?></span>
                            <span><?= $featureInfo; ?></span>
                        </div>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
        <div class="credit-card-info">
            <h2><?= $headline; ?></h2>
            <span><?= $subline; ?></span>
            <?php if( have_rows('list_item')):?>
                <ul>
                    <?php while( have_rows('list_item') ): the_row();
                    $list_item_icon = get_sub_field('list_item_icon');
                    $list_item_text = get_sub_field('list_item_text');?>
                        <li><i class="bi bi-<?= $list_item_icon; ?>"></i><span><?= $list_item_text; ?></span></li>
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