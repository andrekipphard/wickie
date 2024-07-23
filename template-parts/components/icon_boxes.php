<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $alignHeadline = get_sub_field('align_headline');
?>
<section class="icon-boxes">
    <div class="container">
        <div class="title" <?php if($alignHeadline == 'Center'):?>style="align-items: center;"<?php endif;?><?php if($alignHeadline == 'Right'):?>style="align-items: end;"<?php endif;?>>
            <span class="highlight">
                <?= $highlightText; ?>
            </span>
            <h2><?= $headline; ?></h2>
            <span><?= $subline; ?></span>
        </div>
        <?php if( have_rows('icon_box')):?>
            <div class="icon-boxes-wrapper">
                <?php while( have_rows('icon_box') ): the_row();
                $alignIconBox = get_sub_field('align_icon_box');
                $iconBoxIcon = get_sub_field('icon_box_icon');
                $iconBoxHeadline = get_sub_field('icon_box_headline');
                $iconBoxText = get_sub_field('icon_box_text');?>
                    <div class="icon-box" <?php if($alignIconBox == 'Center'):?>style="text-align:center"<?php endif;?><?php if($alignIconBox == 'Right'):?>style="text-align:right"<?php endif;?>>
                        <i class="bi bi-<?= $iconBoxIcon; ?>"></i>
                        <h3><?= $iconBoxHeadline; ?></h3>
                        <span><?= $iconBoxText; ?></span>
                    </div>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
</section>