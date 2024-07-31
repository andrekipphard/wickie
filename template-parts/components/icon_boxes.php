<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $alignHeadline = get_sub_field('align_headline');
    $icon_with_background_color = get_sub_field('icon_with_background_color');
    $iconBoxesPerRow = get_sub_field('icon_boxes_per_row')
?>
<section class="icon-boxes">
    <div class="container">
        <div class="title" <?php if($alignHeadline == 'Center'):?>style="align-items: center;"<?php endif;?><?php if($alignHeadline == 'Right'):?>style="align-items: end;"<?php endif;?>>
            <?php if($highlightText):?>
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
            <?php endif;?>
            <h2><?= $headline; ?></h2>
            <?php if($subline):?><span><?= $subline; ?></span><?php endif;?>
        </div>
        <?php if( have_rows('icon_box')):?>
            <div class="icon-boxes-wrapper<?php if($subline):?> has-subline<?php endif;?>">
                <?php while( have_rows('icon_box') ): the_row();
                $alignIconBox = get_sub_field('align_icon_box');
                $iconBoxIcon = get_sub_field('icon_box_icon');
                $iconBoxHeadline = get_sub_field('icon_box_headline');
                $iconBoxText = get_sub_field('icon_box_text');?>
                    <div class="icon-box" 
                        style="
                            <?php if($alignIconBox == 'Center'):?>text-align:center;<?php endif;?><?php if($alignIconBox == 'Right'):?>text-align:end;<?php endif;?>
                            <?php if($iconBoxesPerRow == '3'):?>flex-basis: calc(33.333% - 26.66px);<?php endif;?><?php if($iconBoxesPerRow == '4'):?>flex-basis: calc(25% - 30px);<?php endif;?>
                        "
                    >
                        <i class="bi bi-<?= $iconBoxIcon; ?>"
                            <?php if($icon_with_background_color == 'Yes'):?>style="color: #FFFFFF; background-color: #93E100; border-radius: 20px; width: fit-content; padding-left: 15px; padding-right: 15px; padding-top: 3px; align-self: <?php if($alignIconBox == 'Center'):?>center;<?php endif;?><?php if($alignIconBox == 'Right'):?>end;<?php endif;?>"<?php endif;?>
                        ></i>
                        <h3><?= $iconBoxHeadline; ?></h3>
                        <span><?= $iconBoxText; ?></span>
                    </div>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
</section>