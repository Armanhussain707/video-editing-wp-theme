<?php

get_header(); ?>


<?php
if (have_posts()) :
    while (have_posts()) : the_post();
?>

        <!-- Single Course Banner -->
        <div class="single-course-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-10 col-sm-12 col-12">
                        <div class="wrapper-content">
                            <h1><?php the_title(); ?></h1>
                            <p><?php echo get_post_meta(get_the_ID(), 'add_top_description', true); ?></p>
                            <div class="gradient-btn">
                                <a href="#popmake-1048" class="Downlode-brochure">Download Brochure</a>
                                <a href="#popmake-513">Apply Now</a>
                            </div>
                            <br>
                            <a href="tel:9090909090">Or Call US: 9090909090</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-12 col-12">
                        <div class="pp-img d-none d-lg-block">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('full'); ?>" class="img-fluid object-fit-cover" alt="Course Image">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Main Single Detail -->
        <div class="course-main-single">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-10 col-sm-12 col-12" data-aos="fade-up" data-aos-once="true">
                        <div class="post-production-wrapper text-center overflow-hidden">
                            <div class="pp-desc">
                                <button class="gradient-btn mt-4 my-4">
                                    <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'add_button_url', true)); ?>" class="tab">
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'add_button_text', true)); ?>
                                    </a>
                                </button>
                                <p><span>Duration:</span> <?php echo esc_html(get_post_meta(get_the_ID(), 'add_duration', true)); ?></p>
                                <p><span>Training Type:</span> <?php echo esc_html(get_post_meta(get_the_ID(), 'add_training_type', true)); ?></p>
                                <p><span>Training Mode:</span> <?php echo esc_html(get_post_meta(get_the_ID(), 'add_training_mode', true)); ?></p>
                                <p><span>Course Type:</span> <?php echo esc_html(get_post_meta(get_the_ID(), 'add_course_type', true)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <!-- Course Detail Section -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 gx-lg-5 m-5">
                        <div class="post-production-course" data-aos="fade-up" data-aos-once="true">
                            <p><?php echo esc_html(get_post_meta(get_the_ID(), 'add_description', true)); ?></p>
                            <div class="pp-software mt-5 mb-5 mb-md-0">
                                <h2><?php the_title(); ?></h2>
                                <p><?php the_content(); ?></p>
                                <div class="pp-software-img" data-aos="fade-up" data-aos-once="true">
                                    <?php
                                    $software_icons = get_post_meta(get_the_ID(), 'software_icons', true);
                                    if (!empty($software_icons)) :
                                    ?>
                                        <div class="pp-software-img" data-aos="fade-up" data-aos-once="true">
                                            <?php foreach ($software_icons as $icon_id): ?>
                                                <img src="<?php echo esc_url(wp_get_attachment_url($icon_id)); ?>" alt="Software Icon" />
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php
    endwhile;
endif;

?>



<!-- contact -->
<div class="newsletter-main">
    <div class="container">
        <div class="newsletter" data-aos="fade-up" data-aos-once="true">
            <div class="row">
                <div class="info-form col-xl-8 col-lg-8 col-md-8 col-sm-6 col-xs-12">
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
                        <!-- contact -7  -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <?php
                            echo do_shortcode('[contact-form-7 id="de9e9cf" title="footer form_copy"]');
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>