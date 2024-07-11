<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
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
		<?php get_template_part( 'template-parts/components/hero' );?>
		<?php get_template_part( 'template-parts/components/feature-cards' );?>
		<?php get_template_part( 'template-parts/components/credit-card' );?>
		<?php get_template_part( 'template-parts/components/rewards' );?>
		<?php get_template_part( 'template-parts/components/market' );?>
		<?php get_template_part( 'template-parts/components/services' );?>
		<?php get_template_part( 'template-parts/components/steps' );?>
		<?php get_template_part( 'template-parts/components/content-card' );?>
		<?php get_template_part( 'template-parts/components/feature-boxes' );?>
		<?php get_template_part( 'template-parts/components/content-card-list' );?>
		<?php get_template_part( 'template-parts/components/pricing' );?>
		<?php get_template_part( 'template-parts/components/banner' );?>
		<?php get_template_part( 'template-parts/components/testimonials' );?>
		<?php get_template_part( 'template-parts/components/blog-posts' );?>
		<?php get_template_part( 'template-parts/components/banner-two-buttons' );?>
		<?php /* if (have_rows('content')):?>
			<?php while( have_rows('content')): the_row(); 

				if( get_row_layout() == 'hero' ):
					
					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'category_slider' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'community' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'sale_slider' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'test' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'lifestyle' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'categories' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'sale_products' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'category_tabs' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'contact' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'hero_single' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'products' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'headline_text' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'image_text' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'image_text_left' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'background_image_text' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'vertical_slider' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'point_of_sale' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'products_of_category' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );

				elseif( get_row_layout() == 'faq' ): 

					get_template_part( 'template-parts/layouts/'. get_row_layout() );
				
				endif; 

			endwhile;

		else:
			while ( have_posts() ) :
				
				the_post();
				echo "<div class='container mb-5'>";
				
				get_template_part( 'template-parts/content', 'page' );
	
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				echo "</div>";
	
			endwhile; // End of the loop.
		endif;*/
		?>

	</main><!-- #main -->

<?php
// if (!have_rows('content')):
	// get_sidebar();
// endif;
get_footer();
