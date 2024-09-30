<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wickie
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if (have_rows('content')): ?>
        <?php while (have_rows('content')): the_row(); ?>
            <?php 
                // Dynamically load the correct template part based on the layout
                $layout = get_row_layout(); 
                get_template_part('template-parts/components/' . $layout);
            ?>
        <?php endwhile; ?>
    <?php else: ?>
        <?php while (have_posts()): the_post(); ?>
            <div class='container mb-5'>
                <?php get_template_part('template-parts/content', 'page'); ?>
            </div>
        <?php endwhile; // End of the loop. ?>
    <?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
