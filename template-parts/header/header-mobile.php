<?php
    $headerLogoMobile = get_field('header_logo', 'options');
?>

<div class="header-mobile">
    <div class="mobile-header">
        <div class="mobile-logo">
            <a href="/">
                <img src="<?= wp_get_attachment_image_url($headerLogoMobile, 'medium'); ?>" alt="Logo" />
            </a>
        </div>
        <div class="mobile-burger-menu">
            <button class="burger-icon" id="mobileMenuToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>

    <div class="mobile-nav-menu" id="mobileNavMenu">
        <button class="close-menu" id="mobileMenuClose">
            <i class="bi bi-x"></i>
        </button>
        <ul class="mobile-menu-items">
            <?php if (have_rows('menu_item', 'options')): ?>
                <?php while (have_rows('menu_item', 'options')): the_row(); ?>
                    <li class="mobile-menu-item">
                        <a href="<?= get_sub_field('menu_item_url'); ?>"><?= get_sub_field('menu_item_name'); ?></a>
                    </li>
                <?php endwhile; ?>
            <?php endif; ?>
            <li class="mobile-menu-item">
                <button type="button" class="btn btn-link"><div id="weglot_here"></div></button>
            </li>
            <?php if (have_rows('header_cta', 'options')): ?>
                <?php while (have_rows('header_cta', 'options')): the_row();
                    $headerButtonUrl = get_sub_field('header_button_url');
                    $headerButtonIcon = get_sub_field('header_button_icon');
                    $headerButtonText = get_sub_field('header_button_text');
                ?>
                    <li class="mobile-menu-item">
                        <a href="<?= $headerButtonUrl; ?>">
                            <button type="button" class="btn btn-link">
                                <i class="bi bi-<?= $headerButtonIcon; ?>"></i>
                                <?= $headerButtonText; ?>
                            </button>
                        </a>
                    </li>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var menuToggle = document.getElementById('mobileMenuToggle');
    var mobileNavMenu = document.getElementById('mobileNavMenu');
    var mobileMenuClose = document.getElementById('mobileMenuClose');
    var mobileMenuOverlay = document.createElement('div');
    mobileMenuOverlay.className = 'mobile-menu-overlay';
    document.body.appendChild(mobileMenuOverlay);

    menuToggle.addEventListener('click', function() {
        mobileNavMenu.classList.add('show');
        mobileMenuOverlay.classList.add('show');
    });

    mobileMenuClose.addEventListener('click', function() {
        mobileNavMenu.classList.remove('show');
        mobileMenuOverlay.classList.remove('show');
    });

    mobileMenuOverlay.addEventListener('click', function() {
        mobileNavMenu.classList.remove('show');
        mobileMenuOverlay.classList.remove('show');
    });
});

        </script>