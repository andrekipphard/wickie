<?php
    $headline = get_sub_field('headline');
?>
<section class="services">
    <div class="container">
        <h2><?= $headline; ?></h2>
        <?php if( have_rows('service')):?>
            <div class="services-wrapper">
                <?php while( have_rows('service') ): the_row();
                $serviceHighlightText = get_sub_field('service_highlight_text');
                $serviceHeadline = get_sub_field('service_headline');
                $serviceButtonUrl = get_sub_field('service_button_url');
                $serviceButtonText = get_sub_field('service_button_text');
                $serviceImage = get_sub_field('service_image');?>
                    <a class="service" href="<?= $serviceButtonUrl; ?>">
                        <span class="highlight">
                            <?= $serviceHighlightText; ?>
                        </span>
                        <h3><?= $serviceHeadline; ?></h3>
                        <?php if($serviceImage):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($serviceImage, 'large'); ?>"><?php endif;?>
                        <button type="button" class="btn btn-link">
                            <?= $serviceButtonText; ?>
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php endif;?>
    </div>
</section>