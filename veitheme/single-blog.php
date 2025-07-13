<?php get_header(); ?>
<!-- wrapper hero -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">



            <div class="wrapper-hero-img">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="wrapper-content text-center">
                                <h1><?php the_title(); ?></h1>
                                <p><?php the_excerpt(); ?></p>
                                <div class="button-back">
                                    <img src="<?php echo get_template_directory_uri(); ?>\icon\img_memphis2.png" alt="About Us Banner" class="img-fluid">

                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-3">
                                    <a href="<?php echo home_url(); ?>">Home</a>
                                    <i class='bx bx-chevron-right'></i>
                                    <span>About us</span>
                                </div>
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
                                <div class="latest-post">
                                    <h2>latest post</h2>
                                    <div class="tab-flex">
                                        <!-- 1 -->
                                        <div class="d-flex align-items-center pt-3 pb-3">
                                            <div class="latest-post-img">
                                                <img src="images/Adobe-Premiere-Pro-Master-Course.webp" class="img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="latest-post-title px-3">
                                                <a href="#">
                                                    <h4>What skill based courses our Video Editing Institute offers?</h4>
                                                </a>
                                                <p> July 7, 2022 <span> No Comments </span></p>
                                            </div>
                                        </div>

                                        <!-- 2 -->
                                        <div class="d-flex align-items-center pt-3 pb-3">
                                            <div class="latest-post-img">
                                                <img src="images/Adobe-Premiere-Pro-Master-Course.webp" class="img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="latest-post-title px-3">
                                                <a href="#">
                                                    <h4>Join Video Editing Course in Rohini for 4 Months with Live Project
                                                        Training
                                                    </h4>
                                                </a>
                                                <p> July 7, 2022 <span> No Comments </span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-flex">
                                        <!-- 3 -->
                                        <div class="d-flex align-items-center pt-3 pb-3">
                                            <div class="latest-post-img">
                                                <img src="images/Adobe-Premiere-Pro-Master-Course.webp" class="img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="latest-post-title px-3">
                                                <a href="#">
                                                    <h4>What makes us one of the leading video editing training institutes in
                                                        Rohini?</h4>
                                                </a>
                                                <p> July 7, 2022 <span> No Comments </span></p>
                                            </div>
                                        </div>

                                        <!-- 4 -->
                                        <div class="d-flex align-items-center pt-3 pb-3">
                                            <div class="latest-post-img">
                                                <img src="images/Adobe-Premiere-Pro-Master-Course.webp" class="img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="latest-post-title px-3">
                                                <a href="#">
                                                    <h4>Surprising Facts on The History of Video Editing</h4>
                                                </a>
                                                <p> July 7, 2022 <span> No Comments </span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-flex">
                                        <!-- 5 -->
                                        <div class="d-flex align-items-center pt-3 pb-3">
                                            <div class="latest-post-img">
                                                <img src="images/Adobe-Premiere-Pro-Master-Course.webp" class="img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="latest-post-title px-3">
                                                <a href="#">
                                                    <h4>Which One is Better for Photo Editing – Lightroom or Photoshop?</h4>
                                                </a>
                                                <p> July 7, 2022 <span> No Comments </span></p>
                                            </div>
                                        </div>

                                        <!-- 6 -->
                                        <div class="d-flex align-items-center pt-3 pb-3">
                                            <div class="latest-post-img">
                                                <img src="images/Adobe-Premiere-Pro-Master-Course.webp" class="img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="latest-post-title px-3">
                                                <a href="#">
                                                    <h4>The Best Place to Join Video Editing Classes in Delhi?</h4>
                                                </a>
                                                <p> July 7, 2022 <span> No Comments </span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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