<?php
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="feature-boxes" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    <?php if ($fullHeight === 'Yes'): ?>
        height: 100vh;
        display: flex; align-items: center; padding-top:0; padding-bottom:0;
    <?php endif; ?>
    ">
    <div class="container">
        <?php if( have_rows('feature_box')):?>
            <div class="feature-box-wrapper">
                <?php while( have_rows('feature_box') ): the_row();
                $featureBoxIcon = get_sub_field('feature_box_icon');
                $featureBoxText = get_sub_field('feature_box_text');?>
                    <div class="feature-box">
                        <div class="icon">
                            <i class="bi bi-<?= $featureBoxIcon; ?>"></i>
                        </div>
                        <span><?= $featureBoxText; ?></span>
                    </div>
                <?php endwhile;?>
            </div>
        <?php endif; ?>
    </div>
</section>