<?php if(have_rows('image')):?>
<div class="row me-0">
    <div class="col">
        <div class="swiper mySwiper py-4 py-lg-5">
            <div class="swiper-wrapper">
                <?php while(have_rows('image')): the_row();
                    $image = get_sub_field('image');?>
                    <div class="swiper-slide shadow rounded py-5 px-4 p-lg-5"><img src="<?= wp_get_attachment_image_url($image, 'full');?>" class="img-fluid"></div>
                <?php endwhile;?>
            </div>
        </div>
    </div>
</div>
<?php endif;?>

<script>
jQuery(document).ready(function() {
    // Initialize Swiper
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 6,
        spaceBetween: 60,
        loop: true,
        speed: 5000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
            reverseDirection: true,
        },
        allowTouchMove: false, // Prevent touch interactions
        simulateTouch: false,  // Prevent simulation of touch interactions
        grabCursor: false,     // Disable cursor change on hover
    });

    // Toggle between different configurations for desktop and mobile
    function toggleSwiper() {
        if (window.innerWidth <= 767) {
            swiper.params.slidesPerView = 2;
            swiper.params.spaceBetween = 20;
        } else {
            swiper.params.slidesPerView = 6;
            swiper.params.spaceBetween = 60;
        }
        swiper.update(); // Update swiper with new params
    }

    // Initial toggle on page load
    toggleSwiper();

    // Re-toggle whenever the window is resized
    window.addEventListener('resize', toggleSwiper);
});
</script>
