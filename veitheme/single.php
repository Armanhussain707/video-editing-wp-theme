<?php get_header(); ?>
<!-- wrapper hero -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

            <!-- wrapper hero -->

            <div class="wrapper-hero-img">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8">
                            <div class="wrapper-img-content text-center">
                                <div class="wrapper-btn">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                                        }
                                    }
                                    ?>
                                </div>

                                <h1><?php the_title(); ?></h1>

                                <p>
                                    <?php the_author(); ?>
                                    <span><?php echo get_the_date(); ?></span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="article-main">
                <div class="container">
                    <div class="row">
                        <!-- blog content -->
                        <div class="col-lg-8 gx-lg-5">
                            <div class="blog-content-details">
                                <?php if (has_post_thumbnail()) : ?>
                                    <!-- featured image -->
                                    <div class="post-featured-img mb-4">
                                        <?php the_post_thumbnail('full', ['class' => 'img-fluid w-100 rounded']); ?>
                                        <br>
                                        <br>
                                        <?php the_excerpt(); ?>

                                    </div>
                                <?php endif; ?>
                                <!-- blog detail -->
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- blog sidebar -->
                        <div class="col-lg-4 gx-lg-5">
                            <div class="blog-sidebar">
                                <!-- blog search -->
                                <div class="blog-search mb-5">
                                    <div class="d-flex">
                                        <input type="search" class="form-control mt-4" placeholder="Search" />
                                        <button type="submit">
                                            <i class='bx bx-search-alt-2'></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- latest post -->
                                <?php
                                $latest_posts = new WP_Query(array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 10,
                                    'post_status'    => 'publish',
                                    'category_name'  => 'articles , all-articles , video-editing-courses' // category slugs separated by comma
                                ));

                                if ($latest_posts->have_posts()) :
                                    $count = 0;
                                    echo '<div class="tab-flex">';
                                    while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                                        <div class="d-flex align-items-center pt-3 pb-3">
                                            <div class="latest-post-title px-3">
                                                <a href="<?php the_permalink(); ?>">
                                                    <h4 class="b-head"><?php the_title(); ?></h4>
                                                </a>
                                                <p><?php echo get_the_date(); ?></p>
                                            </div>
                                        </div>
                                <?php
                                        $count++;
                                        if ($count % 2 == 0 && $count < 6) {
                                            echo '</div><div class="tab-flex">';
                                        }
                                    endwhile;
                                    echo '</div>';
                                    wp_reset_postdata();
                                else :
                                    echo '<p>No posts found in Video Editing or Courses category.</p>';
                                endif;
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 
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
                                    contact -7 
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
            </div> -->

            <!-- footer -->

    <?php endwhile;
endif; ?>


    <?php get_footer(); ?>