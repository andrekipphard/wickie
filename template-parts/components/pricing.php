<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
?>
<section class="pricing">
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
                                    $listItemText = get_sub_field('list_item_text');?>
                                        <li class="list-group-item">
                                            <div class="list-group-item-content">
                                                <h5><?= $listItemHeadline; ?></h5>
                                                <span><?= $listItemText; ?></span>
                                            </div>
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