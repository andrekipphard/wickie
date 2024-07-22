<?php
    $headline = get_sub_field('headline');
    $highlightBoxText = get_sub_field('highlight_box_text');
    $highlightBoxIcon = get_sub_field('highlight_box_icon');
?>
<section class="steps">
    <div class="container">
        <h2><?= $headline; ?></h2>
        <div class="content-boxes">
            <div class="content-box highlighted">
                <div class="icon">
                    <i class="bi bi-<?= $highlightBoxIcon; ?>"></i>
                </div>
                <div class="content">
                    <span><?= $highlightBoxText; ?></span>
                    <?php if( have_rows('cta')):?>
                        <div class="cta">
                            <?php while( have_rows('cta') ): the_row();
                            $buttonUrl = get_sub_field('button_url');
                            $buttonIcon = get_sub_field('button_icon');
                            $buttonText = get_sub_field('button_text');?>
                                <a href="<?=$buttonUrl;?>">
                                    <button type="button" class="btn btn-white">
                                        <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                        <?= $buttonText; ?>
                                    </button>
                                </a>
                            <?php endwhile;?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <?php if( have_rows('content_box')):?>
                <?php while( have_rows('content_box') ): the_row();
                $contentBoxIcon = get_sub_field('content_box_icon');
                $contentBoxText = get_sub_field('content_box_text');?>
                    <div class="content-box">
                        <div class="icon">
                            <i class="bi bi-<?= $contentBoxIcon; ?>"></i>
                        </div>
                        <div class="content">
                            <span><?= $contentBoxText; ?></span>
                        </div>
                    </div>
                <?php endwhile;?>
            <?php endif; ?>
        </div>
    </div>
</section>