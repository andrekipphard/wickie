<?php
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
?>
<section class="market">
    <div class="container">
        <div class="content-wrapper">
            <div class="subline">
            <span class="highlight">
                <?= $highlightText; ?>
            </span>
            </div>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
            <?php if( have_rows('market_value')):?>
                <div class="market-values">
                    <?php while( have_rows('market_value') ): the_row();
                    $name = get_sub_field('name');
                    $currency = get_sub_field('currency');
                    $value = get_sub_field('value');
                    $chartImage = get_sub_field('chart_image');
                    $currencyImage = get_sub_field('currency_image');?>
                        <div class="market-value">
                            <div class="currency">
                                <div class="image">
                                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($currencyImage, 'large');?>">
                                </div>
                                <div class="name">
                                    <h3><?= $name; ?></h3>
                                    <span><?= $currency; ?></span>
                                </div>
                            </div>
                            <div class="value">
                                <span><?= $value; ?></span>
                                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($chartImage, 'large');?>">
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>