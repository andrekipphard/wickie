<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
?>
<section class="pricing" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="pricing-wrapper">
            <div class="title">
                <h2><?= $headline; ?></h2>
                <span><?= $subline; ?></span>
            </div>
            <?php if(have_rows('pricing_box')): ?>
                <div class="pricing-boxes">
                    <?php while(have_rows('pricing_box')): the_row();
                    $pricingBoxButtonUrl = get_sub_field('pricing_box_button_url');
                    $pricingBoxButtonText = get_sub_field('pricing_box_button_text');
                    $pricingBoxHighlightText = get_sub_field('pricing_box_highlight_text');
                    $pricingBoxHeadline = get_sub_field('pricing_box_headline');
                    $pricingBoxSubline = get_sub_field('pricing_box_subline');
                    $pricingBoxText = get_sub_field('pricing_box_text');?>
                        <a class="pricing-box" href="<?= $pricingBoxButtonUrl; ?>">
                            <span class="highlight">
                                <?= $pricingBoxHighlightText; ?>
                            </span>
                            <h3><?= $pricingBoxHeadline; ?></h3>
                            <h4><?= $pricingBoxSubline; ?></h4>
                            <span><?= $pricingBoxText; ?></span>
                            <?php if(have_rows('list_item')): ?>
                                <ul class="list-group-numbered">
                                    <?php while(have_rows('list_item')): the_row();
                                    $listItemHeadline = get_sub_field('list_item_headline');
                                    $listItemText = get_sub_field('list_item_text');
                                    $listItemComingSoon = get_sub_field('list_item_coming_soon'); ?>
                                        <li class="list-group-item<?php if($listItemComingSoon == 'Yes'):?> coming-soon<?php endif;?>">
                                            <div class="list-group-item-content">
                                                <h5><?= $listItemHeadline; ?></h5>
                                                <span><?= $listItemText; ?></span>
                                            </div>
                                            <?php if($listItemComingSoon == 'Yes'):?>
                                                <span class="coming-soon-text"><?= __('Coming Soon', 'your-text-domain'); ?></span>
                                            <?php endif;?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <button type="button" class="btn btn-link">
                                <?= $pricingBoxButtonText; ?>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </a>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>