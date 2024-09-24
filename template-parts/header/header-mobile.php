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
<style>
    .header-mobile {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background-color: #FFFFFF;
    position: relative;
    z-index: 1000;
}

.mobile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.mobile-logo img {
    width: 120px;
    height: auto;
}

.burger-icon {
    background: none;
    border: none;
    font-size: 30px;
    cursor: pointer;
}

.mobile-nav-menu {
    display: none;
    flex-direction: column;
    justify-content: flex-start;
    position: fixed;
    top: 0;
    right: 0;
    height: 100%;
    width: 80%;
    background-color: #002A3F;
    padding: 20px;
    z-index: 2000;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.5);
    color: #FFFFFF;
    transition: transform 0.3s ease;
}

.mobile-nav-menu.show {
    display: flex;
    transform: translateX(0);
}

.mobile-nav-menu .close-menu {
    align-self: flex-end;
    background: none;
    border: none;
    font-size: 30px;
    color: #FFFFFF;
    cursor: pointer;
    margin-bottom: 20px;
}

.mobile-menu-items {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.mobile-menu-item a {
    color: #FFFFFF;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 600;
}

.mobile-menu-item a:hover {
    color: #FFD700; /* Optional: highlight color on hover */
}

/* Overlay to darken background when menu is open */
.mobile-menu-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1500;
}

.mobile-menu-overlay.show {
    display: block;
}

    </style>
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