<?php
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $headline = get_sub_field('headline');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="testimonials" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
        <?php if ($fullHeight === 'Yes'): ?>
        height: 100vh;
        display: flex; align-items: center; padding-top:0; padding-bottom:0;
    <?php endif; ?>
    ">
    <div class="container">
        <div class="text">
            <div class="subline">
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
                <span><?= $subline; ?></span>
            </div>
            <h2><?= $headline; ?></h2>
        </div>
        <?php if(have_rows('testimonial')): ?>
            <div id="testimonial-slider" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $first = true;?>
                    <?php while(have_rows('testimonial')): the_row();
                    $testimonialText = get_sub_field('testimonial_text');
                    $testimonialAuthor = get_sub_field('testimonial_author');
                    $testimonialImage = get_sub_field('testimonial_image'); ?>
                        <div class="carousel-item <?= $first ? 'active' : '';?>">
                            <div class="carousel-content">
                                <span><?= $testimonialText; ?></span>
                                <div class="testimonial-author">
                                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($testimonialImage, 'large'); ?>">
                                    <span><?= $testimonialAuthor; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php $first = false;?>
                    <?php endwhile; ?>
                </div>
                <a class="carousel-control-prev" href="#testimonial-slider" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#testimonial-slider" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
