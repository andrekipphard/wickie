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

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer">
				<div class="company-info">
					<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/header/w-logo.svg">
					<span>We are a bank. A fully-fledged, bona fide bank. A business bank created and backed by business people.</span>
					<div class="social-icons">
						<a href="https://www.facebook.com/share/6L6QbQSPC8DzC7ym/"><i class="bi bi-facebook"></i></a>
						<a href="https://www.instagram.com/wickie.io/?hl=de"><i class="bi bi-instagram"></i></a>
						<a href="https://www.linkedin.com/company/greatidee-uab"><i class="bi bi-linkedin"></i></a>
						<a href="https://twitter.com/wickie_io"><i class="bi bi-twitter-x"></i></a>
					</div>
					<div class="app-links">
						<a href="#">
							<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/app-store.png">
						</a>
						<a href="#">
							<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/google-play-store.png">
						</a>
					</div>
				</div>
				<div class="navigation-links">
					<div class="navigation-links-menu">
						<ul class="navigation-group">
							<li class="navigation-item">
								<a href="#"><span>Account</span></a>
								<ul class="navigation-group">
									<li class="navigation-item"><a href="#"><span>ATM Services</span></a></li>
									<li class="navigation-item"><a href="#"><span>Beneficial Ownership</span></a></li>
									<li class="navigation-item"><a href="#"><span>Calculators</span></a></li>
									<li class="navigation-item"><a href="#"><span>Direct Deposit</span></a></li>
									<li class="navigation-item"><a href="#"><span>Fraud Prevention</span></a></li>
									<li class="navigation-item"><a href="#"><span>Overdraft Services</span></a></li>
									<li class="navigation-item"><a href="#"><span>Switch Kit</span></a></li>
								</ul>
							</li>
							<li class="navigation-item">
								<a href="#"><span>Card Services</span></a>
								<ul class="navigation-group">
									<li class="navigation-item"><a href="#"><span>Credit Cards</span></a></li>
									<li class="navigation-item"><a href="#"><span>Debit Cards</span></a></li>
									<li class="navigation-item"><a href="#"><span>Gift Cards</span></a></li>
									<li class="navigation-item"><a href="#"><span>Prepaid Cards</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="navigation-links-menu">
						<ul class="navigation-group">
							<li class="navigation-item">
								<a href="#"><span>Online Services</span></a>
								<ul class="navigation-group">
									<li class="navigation-item"><a href="#"><span>Apply for a Loan</span></a></li>
									<li class="navigation-item"><a href="#"><span>Apply for a Mortgage</span></a></li>
									<li class="navigation-item"><a href="#"><span>eStatements</span></a></li>
									<li class="navigation-item"><a href="#"><span>Make a Loan Payment</span></a></li>
									<li class="navigation-item"><a href="#"><span>Make an Appointmen</span></a></li>
									<li class="navigation-item"><a href="#"><span>Mobile App</span></a></li>
									<li class="navigation-item"><a href="#"><span>Mobile Deposit</span></a></li>
									<li class="navigation-item"><a href="#"><span>Online Banking</span></a></li>
									<li class="navigation-item"><a href="#"><span>Online Banking Guides</span></a></li>
									<li class="navigation-item"><a href="#"><span>Open an Account</span></a></li>
									<li class="navigation-item"><a href="#"><span>Rates</span></a></li>
									<li class="navigation-item"><a href="#"><span>Reorder Checks</span></a></li>
									<li class="navigation-item"><a href="#"><span>Text Banking</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="navigation-links-menu">
						<ul class="navigation-group">
							<li class="navigation-item">
								<a href="#"><span>Information</span></a>
								<ul class="navigation-group">
									<li class="navigation-item"><a href="#"><span>Services</span></a></li>
									<li class="navigation-item"><a href="#"><span>Locations</span></a></li>
									<li class="navigation-item"><a href="#"><span>News</span></a></li>
									<li class="navigation-item"><a href="#"><span>Products</span></a></li>
									<li class="navigation-item"><a href="#"><span>Image Credits</span></a></li>
								</ul>
							</li>
							<li class="navigation-item">
								<a href="#"><span>Contact</span></a>
								<ul class="navigation-group">
									<li class="navigation-item"><span>Corporate Headquarters: 85 Broad Street, New York, NY 10004</span></li>
									<li class="navigation-item"><a href="#"><span>Routing Number: 111923607</span></a></li>
									<li class="navigation-item"><a href="#"><span>1-123-456-7890</span></a></li>
									<li class="navigation-item"><a href="#"><span>example@ex.com</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>	
			</div>

			<div class="copyright">
				2024 © greatidee uab
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
