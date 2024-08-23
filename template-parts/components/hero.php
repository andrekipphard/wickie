<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $imageTopLeft = get_sub_field('image_top_left');
    $imageBottomLeft = get_sub_field('image_bottom_left');
    $imageTopRight = get_sub_field('image_top_right');
    $imageBottomRight = get_sub_field('image_bottom_left');
    $imageCenter = get_sub_field('image_center');
?>
<section class="hero">
    <div class="container">
        <div class="content">
            <h1><?= $headline; ?></h1>
            <span><?= $subline; ?></span>
            <?php if( have_rows('cta')):?>
                <div class="cta">
                    <?php while( have_rows('cta') ): the_row();
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');
                    $buttonText = get_sub_field('button_text');
                    $buttonType = get_sub_field('button_type');
                    $buttonIconPosition = get_sub_field('button_icon_position');?>
                        <a href="<?=$buttonUrl;?>">
                            <button type="button" class="btn btn-<?= $buttonType; ?>">
                            <?php if($buttonIconPosition == 'Left'):?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif;?>
                                <?= $buttonText; ?>
                            <?php if($buttonIconPosition == 'Right'):?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif;?>
                            </button>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
        <div class="images">
            <div class="top-left image">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageTopLeft, 'large');?>">
            </div>
            <div class="bottom-left image">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageBottomLeft, 'large');?>">
            </div>
            <div class="top-right image">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageTopRight, 'large');?>">
            </div>
            <div class="bottom-right image">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageBottomRight, 'large');?>">
            </div>
            <div class="center">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageCenter, 'large');?>">
            </div>
        </div>
    </div>
</section>
<script>
let mouseX = 0;
let mouseY = 0;
let isMoving = false;

document.addEventListener('mousemove', (event) => {
    mouseX = event.clientX;
    mouseY = event.clientY;
    if (!isMoving) {
        requestAnimationFrame(animateImages);
        isMoving = true;
    }
});

function animateImages() {
    const topLeftImage = document.querySelector('.hero .images .top-left');
    const bottomLeftImage = document.querySelector('.hero .images .bottom-left');
    const topRightImage = document.querySelector('.hero .images .top-right');
    const bottomRightImage = document.querySelector('.hero .images .bottom-right');

    // Reduzierte Geschwindigkeiten
    const topLeftSpeed = 0.02;
    const bottomLeftSpeed = 0.015;
    const topRightSpeed = 0.02;
    const bottomRightSpeed = 0.015;

    const topLeftOffsetX = (mouseX - window.innerWidth / 2) * topLeftSpeed;
    const topLeftOffsetY = (mouseY - window.innerHeight / 2) * topLeftSpeed;
    topLeftImage.style.transform = `translate(${topLeftOffsetX}px, ${topLeftOffsetY}px)`;

    const bottomLeftOffsetX = (mouseX - window.innerWidth / 2) * bottomLeftSpeed;
    const bottomLeftOffsetY = (mouseY - window.innerHeight / 2) * bottomLeftSpeed;
    bottomLeftImage.style.transform = `translate(${bottomLeftOffsetX}px, ${bottomLeftOffsetY}px)`;

    const topRightOffsetX = (mouseX - window.innerWidth / 2) * topRightSpeed;
    const topRightOffsetY = (mouseY - window.innerHeight / 2) * topRightSpeed;
    topRightImage.style.transform = `translate(${topRightOffsetX}px, ${topRightOffsetY}px)`;

    const bottomRightOffsetX = (mouseX - window.innerWidth / 2) * bottomRightSpeed;
    const bottomRightOffsetY = (mouseY - window.innerHeight / 2) * bottomRightSpeed;
    bottomRightImage.style.transform = `translate(${bottomRightOffsetX}px, ${bottomRightOffsetY}px)`;

    isMoving = false;
}


</script>
