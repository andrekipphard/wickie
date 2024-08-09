<?php
    $headerLogo = get_field('header_logo', 'options');
    $headerLogoTransparentBackground = get_field('header_logo_transparent_background', 'options');
?>

<div class="header-desktop">
    <div class="left">
        <div class="logo">
            <?php if (is_front_page()): ?>
                <a href="/">
                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'large'); ?>">
                </a>
            <?php else: ?>
                <a href="/">
                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($headerLogo, 'large'); ?>">
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
                        $megaMenu = get_sub_field('mega_menu');
                    ?>
                        <li class="nav-item <?php if (have_rows('sub_menu_item')): ?>dropdown<?php endif; ?><?php if ($megaMenu == 'Yes' && have_rows('sub_menu_item')): ?> mega-menu-dropdown<?php endif; ?>">
                            <a class="nav-link<?php if (have_rows('sub_menu_item')): ?> dropdown-toggle<?php endif; ?>" href="<?= $menuItemUrl; ?>"<?php if (have_rows('sub_menu_item')): ?> id="menuItem<?= $menuItemIndex; ?>Dropdown" role="button"<?php endif; ?>>
                                <?= $menuItemName; ?>
                            </a>
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
                                                                ?>
                                                                    <li><a class="dropdown-item" href="<?= $subSubMenuItemUrl; ?>"><?= $subSubMenuItemName; ?></a></li>
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
    <?php get_search_form(); ?>
        <div class="search-modal" id="searchModal">
            <div class="search-modal-content">
                <span class="close">&times;</span>
                <?php get_search_form(); ?>
            </div>
        </div>
        <button type="button" class="btn btn-link"><i class="bi bi-globe"></i>En</button>
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
        var modal = document.getElementById('searchModal');
        var btn = document.getElementById('searchIcon');
        var span = modal.querySelector('.close');

        // Open modal on button click
        btn.onclick = function() {
            modal.style.display = 'flex'; // Use flex to center content
        }

        // Close modal on close button click
        span.onclick = function() {
            modal.style.display = 'none';
        }

        // Close modal when clicking outside of the modal content
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    var header = document.querySelector('.header-desktop');
    var navItems = document.querySelectorAll('.nav-item.dropdown');
    var overlay = document.querySelector('.overlay'); // Select the overlay element

    navItems.forEach(function(navItem) {
        navItem.addEventListener('mouseenter', function() {
            header.style.backgroundColor = '#000'; // Change header to black
            overlay.style.opacity = '1'; // Show overlay
            overlay.style.visibility = 'visible'; // Ensure it's visible
        });

        navItem.addEventListener('mouseleave', function() {
            header.style.backgroundColor = ''; // Reset header color
            overlay.style.opacity = '0'; // Hide overlay
            overlay.style.visibility = 'hidden'; // Ensure it's hidden
        });
    });

    // Existing modal script
    var modal = document.getElementById('searchModal');
    var btn = document.getElementById('searchIcon');
    var span = modal.querySelector('.close');

    btn.onclick = function() {
        modal.style.display = 'flex';
    }

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});


</script>
