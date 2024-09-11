<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $imageTopLeft = get_sub_field('image_top_left');
    $imageBottomLeft = get_sub_field('image_bottom_left');
    $imageTopRight = get_sub_field('image_top_right');
    $imageBottomRight = get_sub_field('image_bottom_right');
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
                <?php if($imageTopLeft):?><img src="<?= wp_get_attachment_image_url($imageTopLeft, 'large');?>"><?php endif;?>
            </div>
            <div class="bottom-left image">
            <?php if($imageBottomLeft):?><img src="<?= wp_get_attachment_image_url($imageBottomLeft, 'large');?>"><?php endif;?>
            </div>
            <div class="top-right image">
            <?php if($imageTopRight):?><img src="<?= wp_get_attachment_image_url($imageTopRight, 'large');?>"><?php endif;?>
            </div>
            <div class="bottom-right image">
            <?php if($imageBottomRight):?><img src="<?= wp_get_attachment_image_url($imageBottomRight, 'large');?>"><?php endif;?>
            </div>
            <div class="center">
            <?php if($imageCenter):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageCenter, 'large');?>"><?php endif;?>
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
        isMoving = true;
        requestAnimationFrame(animateImages);
    }
});

function animateImages() {
    const topLeftImage = document.querySelector('.hero .images .top-left');
    const bottomLeftImage = document.querySelector('.hero .images .bottom-left');
    const topRightImage = document.querySelector('.hero .images .top-right');
    const bottomRightImage = document.querySelector('.hero .images .bottom-right');

    const topLeftSpeed = 0.02;
    const bottomLeftSpeed = 0.015;
    const topRightSpeed = 0.02;
    const bottomRightSpeed = 0.015;

    const topLeftOffsetX = Math.round((mouseX - window.innerWidth / 2) * topLeftSpeed);
    const topLeftOffsetY = Math.round((mouseY - window.innerHeight / 2) * topLeftSpeed);
    topLeftImage.style.transform = `translate3d(${topLeftOffsetX}px, ${topLeftOffsetY}px, 0)`;

    const bottomLeftOffsetX = Math.round((mouseX - window.innerWidth / 2) * bottomLeftSpeed);
    const bottomLeftOffsetY = Math.round((mouseY - window.innerHeight / 2) * bottomLeftSpeed);
    bottomLeftImage.style.transform = `translate3d(${bottomLeftOffsetX}px, ${bottomLeftOffsetY}px, 0)`;

    const topRightOffsetX = Math.round((mouseX - window.innerWidth / 2) * topRightSpeed);
    const topRightOffsetY = Math.round((mouseY - window.innerHeight / 2) * topRightSpeed);
    topRightImage.style.transform = `translate3d(${topRightOffsetX}px, ${topRightOffsetY}px, 0)`;

    const bottomRightOffsetX = Math.round((mouseX - window.innerWidth / 2) * bottomRightSpeed);
    const bottomRightOffsetY = Math.round((mouseY - window.innerHeight / 2) * bottomRightSpeed);
    bottomRightImage.style.transform = `translate3d(${bottomRightOffsetX}px, ${bottomRightOffsetY}px, 0)`;

    // Call the next animation frame
    requestAnimationFrame(() => {
        isMoving = false; // Reset the moving state after the frame is rendered
    });
}




</script>
