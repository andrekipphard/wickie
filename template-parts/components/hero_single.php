<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $image = get_sub_field('image');
    $highlightText = get_sub_field('highlight_text');
    $text = get_sub_field('text');
    $buttonStyle = get_sub_field('button_style');
?>
<section class="hero-single">
    <div class="container">
        <div class="content-image">
            <div class="content">
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
                <h1><?= $headline; ?></h1>
                <?php if($subline):?><h3><?= $subline; ?></h3><?php endif;?>
                <span><?= $text; ?></span>
                <?php if($buttonStyle == 'Contact Button'):?>
                    <?php if( have_rows('button')):?>
                        <div class="cta contact-button">
                            <?php while( have_rows('button') ): the_row();
                            $buttonText = get_sub_field('button_text');
                            $buttonUrl = get_sub_field('button_url');
                            $buttonIcon = get_sub_field('button_icon');?>
                                <a href="<?= $buttonUrl; ?>">
                                    <button type="button" class="btn btn-link">
                                        <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                        <?= $buttonText; ?>
                                    </button>
                                </a>
                            <?php endwhile;?>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            </div>
            <div class="image">
                <?php if($image):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>"><?php endif;?>
            </div>
        </div>
        <?php if($buttonStyle == 'Multiple Buttons'):?>
            <?php if( have_rows('button')):?>
                <div class="cta multiple-buttons">
                    <?php while( have_rows('button') ): the_row();
                    $buttonText = get_sub_field('button_text');
                    $buttonUrl = get_sub_field('button_url');?>
                        <a href="<?= $buttonUrl; ?>">
                            <button type="button" class="btn btn-white">
                                <?= $buttonText; ?>
                            </button>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        <?php endif;?>
    </div>
</section>
