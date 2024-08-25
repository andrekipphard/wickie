<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $image = get_sub_field('image');
    $layout = get_sub_field('layout');
?>
<section class="content-card <?= $layout == 'List' ? 'content-card-list' : ''; ?>">
    <div class="container">
        <div class="content-wrapper">
            <div class="content">
                <h2><?= $headline; ?></h2>
                <span><?= $subline; ?></span>
                
                <?php if($layout == 'List' && have_rows('list_item')): ?>
                    <ul class="list-group-numbered">
                        <?php while(have_rows('list_item')): the_row();
                        $listItemHeadline = get_sub_field('list_item_headline');
                        $listItemText = get_sub_field('list_item_text'); ?>
                            <li class="list-group-item">
                                <div class="list-group-item-content">
                                    <h3><?= $listItemHeadline; ?></h3>
                                    <span><?= $listItemText; ?></span>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

                <?php if(have_rows('cta')): ?>
                    <div class="cta">
                        <?php while(have_rows('cta')): the_row();
                        $buttonUrl = get_sub_field('button_url');
                        $buttonIcon = get_sub_field('button_icon');
                        $buttonText = get_sub_field('button_text'); ?>
                            <a href="<?= $buttonUrl; ?>">
                                <button type="button" class="btn btn-white">
                                    <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                    <?= $buttonText; ?>
                                </button>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="image">
            <?php if($image):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>"><?php endif;?>
            </div>
        </div>
    </div>
</section>
