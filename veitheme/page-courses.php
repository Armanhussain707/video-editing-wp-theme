<?php

/* Template Name: All Courses Page */
get_header();

?>



<!-- wrapper hero -->
<div class="wrapper-hero-img" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url(get_theme_mod('allcourses_bg_image', get_template_directory_uri() . '../images/milky-way-and-mountains-night-landscape-1536x1053.jpg')); ?>');">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-content text-center">
                    <h1><?php echo get_theme_mod('All Courses_banner_text_setting', 'All Courses'); ?></h1>
                    <p><?php echo get_theme_mod('allcourses_banner_subtext_setting', 'Read latest articles at Video Editing Institute on useful topics like photo editing, color
                            grading, video editing, color corrections, chrome keying, etc.'); ?></p>
                    <p><?php echo get_theme_mod('All Courses_banner_subtext_setting', ''); ?></p>
                    <div class="button-back">
                        <img src="<?php echo get_template_directory_uri(); ?>\icon\img_memphis2.png" alt="About Us Banner" class="img-fluid">

                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a href="<?php echo home_url(); ?>">Home</a>
                        <i class='bx bx-chevron-right'></i>
                        <span>Courses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- courses -->
<div class="course-main">
    <div class="container">
        <?php
        // Query for all courses with pagination
        $args = array(
            'post_type' => 'courses',
            'posts_per_page' => 5, // Limit to 5 courses per page
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Add pagination support
        );
        $courses_query = new WP_Query($args);

        // Loop through all the courses
        if ($courses_query->have_posts()) :
            while ($courses_query->have_posts()) : $courses_query->the_post();
                // Custom fields
                $button_text = get_post_meta(get_the_ID(), 'add_button_text', true);
                $button_url = get_post_meta(get_the_ID(), 'add_button_url', true);
                $duration = get_post_meta(get_the_ID(), 'add_duration', true);
                $training_type = get_post_meta(get_the_ID(), 'add_training_type', true);
                $training_mode = get_post_meta(get_the_ID(), 'add_training_mode', true);
                $course_type = get_post_meta(get_the_ID(), 'add_course_type', true);
                $description = get_post_meta(get_the_ID(), 'add_description', true);
                $course_image = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Get course image
        ?>

                <!-- Course 1 -->
                <div class="course-wrapper" data-aos="fade-up" data-aos-once="true">
                    <div class="row">
                        <div class="col-md-5 gx-md-5">
                            <div class="course-img text-center">
                                <img src="<?php echo esc_url($course_image); ?>" class="img-fluid  object-fit-cover" alt="">
                                <!-- <div class="social-icon mt-4">
                                    <?php
                                    $socials = array('facebook', 'twitter', 'youtube', 'linkedin');

                                    foreach ($socials as $social) {
                                        $url = get_theme_mod("social_{$social}_url", '#');
                                        $icon_class = get_theme_mod("social_{$social}_icon", "bx bxl-{$social}");
                                        if ($url && $icon_class) {
                                            echo "<a href='" . esc_url($url) . "' target='_blank'><i class='" . esc_attr($icon_class) . "'></i></a>";
                                        }
                                    }
                                    ?>

                                </div> -->
                            </div>
                        </div>

                        <div class="col-md-7 gx-md-5">
                            <div class="course-detail mt-4 mt-md-0">
                                <h3 style="color: white;">
                                    <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none link-primary">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <h5><span>Duration: </span><?php echo esc_html($duration); ?></h5>
                                <h5><span>Training Type: </span><?php echo esc_html($training_type); ?></h5>
                                <h5><span>Training Mode: </span><?php echo esc_html($training_mode); ?></h5>
                                <h5><span>Course Type: </span><?php echo esc_html($course_type); ?></h5>
                                <p><?php echo esc_html($description); ?></p>
                                <?php
                                // Fallback: agar custom button URL empty ho toh post permalink use karein
                                $final_button_url = !empty($button_url) ? $button_url : get_the_permalink();
                                ?>

                                <button class="gradient-btn mt-4 mt-lg-5">
                                    <a href="<?php echo esc_url($final_button_url); ?>">
                                        <?php echo esc_html($button_text ? $button_text : 'View Details'); ?>
                                    </a>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        <?php else : ?>
            <p>No courses found.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>

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
                'total'     => $courses_query->max_num_pages, // Corrected to use the custom WP_Query
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

<?php get_footer(); ?>