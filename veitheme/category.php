<?php get_header(); ?>
<!-- Wrapper Hero -->

<div class="wrapper-hero-img " style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url(get_theme_mod('allartical_bg_image', get_template_directory_uri() . '../images/milky-way-and-mountains-night-landscape-1536x1053.jpg')); ?>');">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-content text-center">
                    <h1><?php single_cat_title(); ?></h1>
                    <p><?php echo category_description(); ?></p>
                    <div class="button-back">
                        <img src="<?php echo get_template_directory_uri(); ?>/icon/img_memphis2.png" alt="Category Banner" class="img-fluid">
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a href="<?php echo home_url(); ?>">Home</a>
                        <i class='bx bx-chevron-right'></i>
                        <span><?php single_cat_title(); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$category = get_queried_object();
$cat_id = $category->term_id;
$paged = max(1, get_query_var('paged') ? get_query_var('paged') : get_query_var('page'));


$args = array(
    'cat' => $cat_id,
    'posts_per_page' => 6,
    'paged' => $paged
);


$query = new WP_Query($args);
?>

<section class="py-5" style="background-color: #181818;">
    <div class="container">
        <div class="row g-4">
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="post-card h-100 p-3 rounded shadow-sm position-relative">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumb mb-3 overflow-hidden rounded" style="height: 200px;">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', ['class' => 'img-fluid w-100 h-100 object-fit-cover transition']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="post-content">
                                <h4><a href="<?php the_permalink(); ?>" class="text-light text-decoration-none"><?php the_title(); ?></a></h4>
                                <p class="small mb-2"><?php echo get_the_date(); ?> | <?php comments_number(); ?></p>
                                <p class="text-light"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="col-12 text-center text-white">
                    <p>No posts found in this category.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="col-12 d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    $big = 999999999; // dummy number
                    $pages = paginate_links(array(
                        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format'    => '?paged=%#%',
                        'current'   => max(1, get_query_var('paged')),
                        'total'     => $query->max_num_pages,
                        'prev_text' => '« Previous',
                        'next_text' => 'Next »',
                        'type'      => 'array',
                    ));

                    if (!empty($pages)) {
                        foreach ($pages as $page) {
                            $active = strpos($page, 'current') !== false ? ' active' : '';
                            echo '<li class="page-item' . $active . '">' . str_replace('page-numbers', 'page-link', $page) . '</li>';
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- contact -->
<div class="newsletter-main">
    <div class="container">
        <div class="newsletter" data-aos="fade-up" data-aos-once="true">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <div class="text text-light">
                        <h1>Need Help with Articles or Assignments?</h1>
                        <h4>We're here to support you! Whether it's a question, suggestion, or collaboration — feel free to reach out.</h4>

                        <ul style="list-style-type: none; padding-left: 0; margin-top: 15px;">
                            <li>📘 Get expert advice on your topic</li>
                            <li>✏️ Request new articles or resources</li>
                            <li>🤝 Quick response within 24 hours</li>
                        </ul>

                        <p class="mt-3" style="font-size: 14px; color: #888;">
                            Trusted by 500+ students. Your privacy is 100% safe with us.
                        </p>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="button">
                        <!-- Name Field -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           
                        <?php
						echo do_shortcode('[contact-form-7 id="de9e9cf" title="footer form_copy"]');
						?>
                            
                        </div>
                        <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="email">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                        </div> -->

                        <!-- Email Field -->
                        <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                            <div class="email">
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                        </div> -->

                        <!-- Phone Field -->
                        <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                            <div class="email">
                                <input type="tel" class="form-control" placeholder="Your Phone Number">
                            </div>
                        </div> -->

                        <!-- Submit Button -->
                        <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
                            <button class="sign-up w-100">
                                <a href="#"><i class='bx bx-send'></i>
                                    <span>Contact Now</span></a>
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>