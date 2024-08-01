<section class="feature-boxes">
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