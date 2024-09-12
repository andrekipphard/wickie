<?php
    $headerLogo = get_field('header_logo', 'options');
    $headerLogoTransparentBackground = get_field('header_logo_transparent_background', 'options');
?>

<div class="header-desktop">
    <div class="left">
        <div class="logo">
            <?php if (is_front_page()): ?>
                <a href="/">
                    <?php if($headerLogoTransparentBackground):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'large'); ?>"><?php endif;?>
                </a>
            <?php else: ?>
                <a href="/">
                <?php if($headerLogo):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($headerLogo, 'large'); ?>"><?php endif;?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="middle">
        <div class="navigation">
            <?php if (have_rows('menu_item', 'options')): ?>
                <ul class="nav">
                    <?php
                    $menuItemIndex = 0; // Initialize the index variable
                    while (have_rows('menu_item', 'options')): the_row();
                        $menuItemName = get_sub_field('menu_item_name');
                        $menuItemUrl = get_sub_field('menu_item_url');
                        $menuItemIcon = get_sub_field('menu_item_icon');
                        $megaMenu = get_sub_field('mega_menu');
                    ?>
                        <li class="nav-item <?php if (have_rows('sub_menu_item')): ?>dropdown<?php endif; ?><?php if ($megaMenu == 'Yes' && have_rows('sub_menu_item')): ?> mega-menu-dropdown<?php endif; ?>">
                            <div class="nav-link<?php if (have_rows('sub_menu_item')): ?><?php endif; ?>"<?php if (have_rows('sub_menu_item')): ?> id="menuItem<?= $menuItemIndex; ?>Dropdown" role="button"<?php endif; ?>>
                                <i class="bi bi-<?= $menuItemIcon; ?>"></i><?= $menuItemName; ?>
                            </div>
                            <?php if (have_rows('sub_menu_item')): ?>
                                <div class="dropdown-menu" aria-labelledby="menuItem<?= $menuItemIndex; ?>Dropdown">
                                    <div class="row<?php if ($megaMenu == 'Yes'): ?> mega-menu<?php endif; ?><?php if ($megaMenu == 'No'): ?> normal-menu<?php endif; ?>">
                                        <div class="col d-flex justify-content-center">
                                            <?php if ($megaMenu == 'Yes' && have_rows('sub_menu_item')): ?>
                                                <div class="row container">
                                                    <?php while (have_rows('sub_menu_item')): the_row();
                                                        $subMenuItemName = get_sub_field('sub_menu_item_name');
                                                        $subMenuItemUrl = get_sub_field('sub_menu_item_url');
                                                        $subMenuItemIcon = get_sub_field('sub_menu_item_icon');
                                                    ?>
                                                        <div class="col-lg-3 mega-menu-col">
                                                            <a href="<?= $subMenuItemUrl; ?>">
                                                                <h6><?php if ($subMenuItemIcon): ?><i class="bi bi-<?= $subMenuItemIcon; ?>"></i><?php endif; ?><?= $subMenuItemName; ?></h6>
                                                            </a>
                                                            <?php if (have_rows('sub_sub_menu_item')): ?>
                                                                <ul>
                                                                <?php while (have_rows('sub_sub_menu_item')): the_row(); // Correct loop and function
                                                                    $subSubMenuItemName = get_sub_field('sub_sub_menu_item_name');
                                                                    $subSubMenuItemUrl = get_sub_field('sub_sub_menu_item_url');
                                                                    $subSubMenuItemComingSoon = get_sub_field('sub_sub_menu_item_coming_soon');
                                                                    $subSubMenuItemNewTab = get_sub_field('sub_sub_menu_item_new_tab');
                                                                ?>
                                                                    <?php if ($subSubMenuItemComingSoon === 'Nein'): ?><li><a class="dropdown-item" href="<?= $subSubMenuItemUrl; ?>" <?php if ($subSubMenuItemNewTab === 'Ja'): ?> target="_blank"<?php endif;?>><?= $subSubMenuItemName; ?><?php if ($subSubMenuItemComingSoon === 'Ja'): ?>
                        <span class="coming-soon">
                            <span class="badge">
                                <i class="bi bi-flag"></i>COMING SOON
                            </span>
                        </span>
                    <?php endif; ?></a></li><?php endif;?>
                                                                <?php endwhile; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endwhile; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($megaMenu == 'No' && have_rows('sub_menu_item')): ?>
                                                <ul>
                                                    <?php while (have_rows('sub_menu_item')): the_row();
                                                        $subMenuItemName = get_sub_field('sub_menu_item_name');
                                                        $subMenuItemUrl = get_sub_field('sub_menu_item_url');
                                                    ?>
                                                        <li><a class="dropdown-item" href="<?= $subMenuItemUrl; ?>"><?= $subMenuItemName; ?></a></li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php
                    $menuItemIndex++;
                    endwhile;
                    ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="right">
        <!-- Removed the search button and modal -->
        <button type="button" class="btn btn-link"><div id="weglot_here"></div></button>
        <?php if (have_rows('header_cta', 'options')): ?>
            <?php while (have_rows('header_cta', 'options')): the_row();
                $headerButtonUrl = get_sub_field('header_button_url');
                $headerButtonIcon = get_sub_field('header_button_icon');
                $headerButtonText = get_sub_field('header_button_text');
            ?>
                <a href="<?= $headerButtonUrl; ?>">
                    <button type="button" class="btn btn-link">
                        <i class="bi bi-<?= $headerButtonIcon; ?>"></i>
                        <?= $headerButtonText; ?>
                    </button>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var header = document.querySelector('.header-desktop');
    var logo = document.querySelector('.header-desktop .logo img');
    var overlay = document.querySelector('.overlay');
    var navItems = document.querySelectorAll('.nav-item.dropdown');
    var body = document.body; // Access the body element to check the page type
    var buttons = document.querySelectorAll('.header-desktop .right .btn');

    // Logo sources
    var lightLogoSrc = "<?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'large'); ?>";
    var darkLogoSrc = "<?= wp_get_attachment_image_url($headerLogo, 'large'); ?>";

    var scrollOffset = 100; // Adjust when the header becomes sticky

    function updateHeaderState() {
        var isSticky = window.scrollY > scrollOffset;
        var isFrontPage = body.classList.contains('home'); // WordPress adds 'home' class for the front page

        // Determine logo source based on page type and sticky state
        if (isSticky) {
            header.classList.add('sticky');
            header.style.backgroundColor = '#FFFFFF';
            logo.src = darkLogoSrc; // Dark logo for sticky header
        } else {
            header.classList.remove('sticky');
            header.style.backgroundColor = 'transparent';
            logo.src = isFrontPage ? lightLogoSrc : darkLogoSrc; // Light logo for front page, dark for others
        }
    }

    // Scroll event listener to handle sticky header
    window.addEventListener('scroll', updateHeaderState);

    // Navbar dropdown hover events
    navItems.forEach(function(navItem) {
        navItem.addEventListener('mouseenter', function() {
            header.style.backgroundColor = '#002A3F'; // Change header to blue
            logo.src = lightLogoSrc; // Use light logo when hovering
            overlay.style.opacity = '1'; // Show overlay
            overlay.style.visibility = 'visible'; // Ensure it's visible

            // Add class to change button text and icon color to white
            buttons.forEach(function(button) {
                button.classList.add('white-text');
            });
        });

        navItem.addEventListener('mouseleave', function() {
            overlay.style.opacity = '0'; // Hide overlay
            overlay.style.visibility = 'hidden'; // Ensure it's hidden

            // Restore header state based on scroll position
            updateHeaderState();

            // Remove class to restore button text and icon color
            buttons.forEach(function(button) {
                button.classList.remove('white-text');
            });
        });
    });

    // Initialize header state on page load
    updateHeaderState();
});
</script>
