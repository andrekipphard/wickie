<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wickie
 */
?>

<?php
    // Retrieve ACF fields
    $logo = get_field('footer_logo', 'options');
    $companyInformation = get_field('footer_company_information', 'options');
    $copyright_template = get_field('footer_copyright', 'options');

    // Get the current year
    $current_year = date('Y');

    // Replace the {year} placeholder with the current year
    $copyright = str_replace('{year}', $current_year, $copyright_template);
?>

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer">
            <div class="company-info">
                <?php if ($logo): ?>
                    <img loading="lazy" decoding="async" src="<?= esc_url(wp_get_attachment_image_url($logo, 'large')); ?>" alt="Company Logo">
                <?php endif; ?>

                <?php if ($companyInformation): ?>
                    <span><?= esc_html($companyInformation); ?></span>
                <?php endif; ?>

                <?php if (have_rows('footer_social_icon', 'options')): ?>
                    <div class="social-icons">
                        <?php while (have_rows('footer_social_icon', 'options')): the_row(); 
                            $socialIconUrl = get_sub_field('footer_social_icon_url');
                            $socialIcon = get_sub_field('footer_social_icon');
                        ?>
                            <?php if ($socialIconUrl && $socialIcon): ?>
                                <a href="<?= esc_url($socialIconUrl); ?>">
                                    <i class="bi bi-<?= esc_attr($socialIcon); ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('footer_app_link', 'options')): ?>
                    <div class="app-links">
                        <?php while (have_rows('footer_app_link', 'options')): the_row(); 
                            $appLinkUrl = get_sub_field('footer_app_link_url');
                            $appLinkImage = get_sub_field('footer_app_link_image');
                        ?>
                            <?php if ($appLinkUrl && $appLinkImage): ?>
                                <a href="<?= esc_url($appLinkUrl); ?>">
                                    <img loading="lazy" decoding="async" src="<?= esc_url(wp_get_attachment_image_url($appLinkImage, 'large')); ?>" alt="App Link">
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="navigation-links">
                <?php if (have_rows('footer_menu', 'options')): ?>
                    <div class="navigation-links-menu">
                        <ul class="navigation-group navigation-links-menu-ul">
                            <?php while (have_rows('footer_menu', 'options')): the_row(); 
                                $footerMenuName = get_sub_field('footer_menu_name');
                                $footerMenuUrl = get_sub_field('footer_menu_url');
                            ?>
                                <li class="navigation-item navigation-links-menu-ul-li">
                                    <?php if ($footerMenuName && $footerMenuUrl): ?>
                                        <a href="<?= esc_url($footerMenuUrl); ?>">
                                            <span><?= esc_html($footerMenuName); ?></span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (have_rows('footer_menu_item')): ?>
                                        <ul class="navigation-group">
                                            <?php while (have_rows('footer_menu_item')): the_row(); 
                                                $footerMenuItemName = get_sub_field('footer_menu_item_name');
                                                $footerMenuItemUrl = get_sub_field('footer_menu_item_url');
                                            ?>
                                                <?php if ($footerMenuItemName && $footerMenuItemUrl): ?>
                                                    <li class="navigation-item">
                                                        <a href="<?= esc_url($footerMenuItemUrl); ?>">
                                                            <span><?= esc_html($footerMenuItemName); ?></span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>	
        </div>

        <?php if (isset($copyright) && !empty($copyright)): ?>
            <div class="copyright">
                <?= esc_html($copyright); ?>
            </div>
        <?php endif; ?>
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<div class="overlay"></div>
</body>
</html>
