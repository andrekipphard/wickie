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
    $logo = get_field( 'footer_logo', 'options' );
	$companyInformation = get_field( 'footer_company_information', 'options' );
	$copyright = get_field( 'footer_copyright', 'options' );
?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer">
				<div class="company-info">
					<img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($logo, 'large'); ?>">
					<span><?=$companyInformation;?></span>
					<?php if( have_rows('footer_social_icon', 'options')):?>
						<div class="social-icons">
							<?php while( have_rows('footer_social_icon', 'options') ): the_row();
							$socialIconUrl = get_sub_field('footer_social_icon_url');
							$socialIcon = get_sub_field('footer_social_icon');?>
									<a href="<?=$socialIconUrl;?>"><i class="bi bi-<?=$socialIcon;?>"></i></a>
							<?php endwhile;?>
						</div>
					<?php endif;?>
					<?php if( have_rows('footer_app_link', 'options')):?>
						<div class="app-links">
							<?php while( have_rows('footer_app_link', 'options') ): the_row();
							$appLinkUrl = get_sub_field('footer_app_link_url');
							$appLinkImage = get_sub_field('footer_app_link_image');?>
								<a href="<?=$appLinkUrl;?>">
									<img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($appLinkImage, 'large'); ?>">
								</a>
							<?php endwhile;?>
						</div>
					<?php endif;?>
				</div>
				<div class="navigation-links">
					<div class="navigation-links-menu">
						<?php if( have_rows('footer_menu', 'options')):?>
							<ul class="navigation-group navigation-links-menu-ul">
								<?php while( have_rows('footer_menu', 'options') ): the_row();
								$footerMenuName = get_sub_field('footer_menu_name');
								$footerMenuUrl = get_sub_field('footer_menu_url');?>
									<li class="navigation-item navigation-links-menu-ul-li">
										<a href="<?=$footerMenuUrl;?>"><span><?=$footerMenuName;?></span></a>
										<?php if( have_rows('footer_menu_item', 'options')):?>
											<ul class="navigation-group">
											<?php while( have_rows('footer_menu_item', 'options') ): the_row();
											$footerMenuItemName = get_sub_field('footer_menu_item_name');
											$footerMenuItemUrl = get_sub_field('footer_menu_item_url');?>
													<li class="navigation-item"><a href="<?=$footerMenuItemUrl;?>"><span><?=$footerMenuItemName;?></span></a></li>
												<?php endwhile;?>
											</ul>
										<?php endif;?>
									</li>
								<?php endwhile;?>
							</ul>
						<?php endif;?>
					</div>
				</div>	
			</div>

			<div class="copyright">
				<?=$copyright;?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<div class="overlay"></div>

</body>
</html>
