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
		<section class="hero">
			<div class="container">
				<h1>One app, all things money</h1>
				<span>Open a free account in minutes right from your phone and make your money go further.</span>
				<div class="cta">
					<button type="button" class="btn btn-white">Open Account</button>
					<button type="button" class="btn btn-link">Learn more</button>
				</div>
				<div class="images">
					<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero/home3-1.jpg">
				</div>
			</div>
		</section>
		<?php if (have_rows('content')):?>
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
		endif;
		?>

	</main><!-- #main -->

<?php
if (!have_rows('content')):
	// get_sidebar();
endif;
get_footer();
