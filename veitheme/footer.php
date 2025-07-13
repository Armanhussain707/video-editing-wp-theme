<div class="footer ">
	<div class="container-fluid">
		<div class="row mt-5">
			<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 f-logo">
				<img src="<?php bloginfo('template_url'); ?>\icon\vei-new-logo-25 (1).png " class="img-fluid h-100 w-100 " alt="">
			</div>
			<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 f-nav ">
				<?php
				wp_nav_menu(
					array(
						'menu'              => 'Secondary Menu',
						'theme_location'    => 'secondary',
						'depth'             => 3,
						'container_id'      => 'homepage',
						'menu_class'        => 'f-nav',
						'container_class'        => 'nav-menu ',
						'menu_id'        => 'navbarNavDropdown',
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new wp_bootstrap_navwalker()
					)
				);
				?>
				<hr>
			</div>
		</div>

		<div class="row foot-text">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="row">
					<?php
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Address Widgets")) : ?><?php endif; ?>
					<?php
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Useful Links Widgets")) : ?><?php endif; ?>

					<?php
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Our Partner Widgets")) : ?><?php endif; ?>

					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 foot-4 mt-md-0 mt-4">
						<h4>Let Us Contact You</h4>
						<!-- <form action="#"> -->
						<?php
						echo do_shortcode('[contact-form-7 id="5d31de5" title="footer form"]');
						?>
						<!-- </form> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer ends here -->
	<!-- Search Modal -->
	<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header border-0">
					<h5 class="modal-title" id="searchModalLabel">Search</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<div class="input-group">
							<input type="text" name="s" class="form-control" placeholder="Type to search...">
							<button type="submit" class="btn btn-primary">Search</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
<?php wp_footer(); ?>

<script src="<?php bloginfo('template_url') ?>/js/script.js"></script>
<!-- Bootstrap JS -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
	crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- counter  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"
	integrity="sha512-oy0NXKQt2trzxMo6JXDYvDcqNJRQPnL56ABDoPdC+vsIOJnU+OLuc3QP3TJAnsNKXUXVpit5xRYKTiij3ov9Qg=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<!-- Optional JavaScript -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
	AOS.init({
		duration: 1500,
	});
</script>
<!-- Navbar Hover jquery -->
<script>
	jQuery(document).ready(function($) {
		// Show dropdown on hover and hide when mouse leaves
		$('.navbar-nav .dropdown').hover(
			function() {
				$(this).find('.dropdown-menu').stop(true, true).slideDown(300); // Show smoothly
			},
			function() {
				$(this).find('.dropdown-menu').stop(true, true).slideUp(300); // Hide smoothly
			}
		);
	});
</script>

</body>

</html>