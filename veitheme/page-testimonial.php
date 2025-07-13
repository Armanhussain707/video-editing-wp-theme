<?php get_header();
get_header('header2');

?>

<!-- wrapper hero -->
<div class="wrapper-hero-img">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-10 col-sm-12 col-12">
                <div class="wrapper-content text-center">
                    <h1><?php echo get_theme_mod('testimonial_banner_text_setting', 'Testimonial'); ?></h1>
                    <p><?php echo get_theme_mod('testimonial_banner_subtext_setting', 'Read latest articles at Video Editing Institute on useful topics like photo editing, color
                            grading, video editing, color corrections, chrome keying, etc.'); ?></p>
                    <div class="button-back">
                    <img src="<?php echo get_template_directory_uri(); ?>\icon\img_memphis2.png" alt="About Us Banner" class="img-fluid  object-fit-cover">

                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a href="<?php echo home_url(); ?>">Home</a>
                        <i class='bx bx-chevron-right'></i>
                        <span>Testimonial</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- testimonials -->


<div class="testimonial-main">
    <div class="container">


        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Pagination support
        $args = array(
            'post_type'      => 'testimonials',
            'posts_per_page' => 4, // Show 4 testimonials per page
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => 'DESC'
        );
        $query = new WP_Query($args);
        $count = 0; // Counter for alternating layout

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $name = get_the_title(); // Testimonial Name
                $applied_for = get_post_meta(get_the_ID(), 'testimonial_applied_for', true);
                $job = get_post_meta(get_the_ID(), 'testimonial_job', true);
                $excerpt = get_the_excerpt(); // Short testimonial summary
                $testimonial_image = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Featured image

                $count++; // Increase counter
        ?>

                <!-- Alternating layout -->
                <div class="row justify-content-between align-items-center <?php echo ($count % 2 == 0) ? 'py-5 py-lg-3 testimonial-wrapper flex-column-reverse align-items-sm-center flex-md-row' : 'testimonial-wrapper'; ?>"
                    data-aos="fade-up" data-aos-once="true">

                    <?php if ($count % 2 != 0) : // Odd posts: Text first, Image second 
                    ?>
                        <!-- Text Content First -->
                        <div class="col-md-6">
                            <div class="testimonial-content">
                                <span><i class='bx bxs-quote-alt-left'></i> <?php echo esc_html($name); ?></span>
                                <h3>Course Applied: <?php echo esc_html($applied_for); ?></h3>
                                <h3>Job: <?php echo esc_html($job); ?></h3>
                                <p><?php echo esc_html($excerpt); ?></p>
                            </div>
                        </div>

                        <!-- Image Second -->
                        <div class="col-md-6 d-flex justify-content-center">
                            <div class="testimonial-img">
                                <img src="<?php echo esc_url($testimonial_image); ?>" class="img-fluid" alt="Testimonial Image">
                            </div>
                        </div>

                    <?php else : // Even posts: Image first, Text second 
                    ?>
                        <!-- Image First -->
                        <div class="col-md-6 d-flex justify-content-center">
                            <div class="testimonial-img">
                                <img src="<?php echo esc_url($testimonial_image); ?>" class="img-fluid" alt="Testimonial Image">
                            </div>
                        </div>

                        <!-- Text Content Second -->
                        <div class="col-md-6">
                            <div class="testimonial-content">
                                <span><i class='bx bxs-quote-alt-left'></i> <?php echo esc_html($name); ?></span>
                                <h3>Course Applied: <?php echo esc_html($applied_for); ?></h3>
                                <h3>Job: <?php echo esc_html($job); ?></h3>
                                <p><?php echo esc_html($excerpt); ?></p>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>

        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="text-center">No testimonials found.</p>';
        endif;
        ?>

        <!-- Pagination -->
        <div class="col-12 d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    $big = 999999999; // Need an unlikely integer
                    $pages = paginate_links(array(
                        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format'    => '?paged=%#%',
                        'current'   => max(1, get_query_var('paged')),
                        'total'     => $query->max_num_pages,
                        'prev_text' => 'Previous',
                        'next_text' => 'Next',
                        'type'      => 'array', // This makes it return an array instead of echoing
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



    </div>
</div>




<?php get_footer(); ?>