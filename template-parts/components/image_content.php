<?php
    $layout = get_sub_field('layout');
    $showButtons = get_sub_field('show_buttons');
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
            <?php if($image):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>"><?php endif;?>
        </div>
        <div class="content">
            <?php if($highlightText):?>
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
            <?php endif;?>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
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