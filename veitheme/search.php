<?php get_header(); ?>

<?php
// Get background image from Customizer
$bg_image = get_theme_mod('search_bg_image')
	? esc_url(get_theme_mod('search_bg_image'))
	: get_template_directory_uri() . '/images/default-bg.jpg';
?>

<div class="search-result py-5" style="background: url('<?php echo $bg_image; ?>') no-repeat center center / cover;">
	<div class="container">
		<div class="row">
			<!-- Search Results -->
			<div class="col-md-8">
				<?php if (have_posts()) : ?>
					<h2 class="text-white mb-4">Search Results for: "<?php echo get_search_query(); ?>"</h2>

					<?php while (have_posts()) : the_post(); ?>
						<div class="card mb-4 shadow bg-dark text-white p-3">
							<div class="row g-0 align-items-center">
								<!-- Thumbnail and Date (Left) -->
								<div class="col-md-4 text-center">
									<?php if (has_post_thumbnail()) : ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('large', [
												'class' => 'img-fluid rounded mb-2',
												'style' => 'max-width: 100%; height: auto;'
											]); ?>
										</a>
									<?php endif; ?>
									<small class="text-light d-block"><?php echo get_the_date(); ?></small>
								</div>

								<!-- Content (Right) -->
								<div class="col-md-8">
									<div class="card-body ps-md-4">
										<h3 class="h5">
											<a href="<?php the_permalink(); ?>" class="text-info text-decoration-none">
												<?php the_title(); ?>
											</a>
										</h3>
									
										<p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
										<button class="gradient-btn d-none d-lg-block my-2 text-black" type="submit">
											<a href="<?php the_permalink(); ?>" class="btn btn-outline-info btn-sm m-0 p-2"><span class="ser p-2">Read More</span></a>
										</button>

									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>

					<!-- Pagination -->
					<div class="col-12 d-flex justify-content-center mt-5">
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<?php
								global $wp_query;
								$big = 999999999; // Unlikely integer
								$pages = paginate_links(array(
									'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
									'format'    => '?paged=%#%',
									'current'   => max(1, get_query_var('paged')),
									'total'     => $wp_query->max_num_pages, // Use main WP_Query
									'prev_text' => 'Previous',
									'next_text' => 'Next',
									'type'      => 'array',
								));

								if (!empty($pages)) {
									foreach ($pages as $page) {
										echo '<li class="page-item">' . str_replace('page-numbers', 'page-link', $page) . '</li>';
									}
								}
								?>
							</ul>
						</nav>
					</div>


				<?php else : ?>
					<div class="alert alert-warning">No results found. Try again.</div>
				<?php endif; ?>
			</div>

			<!-- Sidebar -->
			<div class="col-md-4 d-none d-md-block">
				<div class="course-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>