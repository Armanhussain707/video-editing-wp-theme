<?php get_header(); ?>
<!-- header -->
<!-- top btn -->
<a href="#homepage">
  <div class="go-top-btn" id="topBtn">
    <i class='bx bx-arrow-to-top'></i>
  </div>
</a>
<!-- hero banner -->
<div class="hero-banner">
  <div class="hero-overlay"></div>
  <img src="<?php echo get_theme_mod('slider_image1'); ?>" style="object-fit: cover; background-image: linear-gradient(90deg, #070b20cc 30%, #ffffff00 100%);height: 100vh; width:100%; margin-right: 40px;" alt="">
  <div class="container-fluid">
    <div class="banner-text" data-aos="fade-right" data-aos-once="true">
      <h1><?php echo get_theme_mod('slider_text_setting', 'Start your career into video editing'); ?></h1>
      <h4><?php echo get_theme_mod('slider_subtext_setting', 'Courses at our Video Editing Institute in Delhi make you a job-ready professional video editor from level zero.'); ?>
      </h4>
      <button class="gradient-btn mt-lg-4 mt-5">
        <a href="#">Check Courses</a>
      </button>
    </div>
  </div>
</div>

<!-- banner card -->
<div class="banner-card">
  <div class="container-fluid">
    <div class="row">
      <?php query_posts('posts_per_page=4&cat=4'); ?>
      <?php
      if (have_posts()) :
        while (have_posts()) :
          the_post();
      ?>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card" data-aos="fade-up" data-aos-once="true">
              <div class="card-body">
                <p><i class='bx bx-camera'></i></p>
                <h4><?php the_title(); ?></h4>
                <p><?php the_excerpt(); ?></p>
              </div>
            </div>
          </div>
        <?php
        endwhile;
      else:
        ?>
        <h2>Not Found</h2>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- custom content type  -->
<!-- <div class="col-md-8">
            <?php
            $the_slug = 'about-us';
            $args = array(
              'name'        => $the_slug,
              'post_type'   => 'page',
              'post_status' => 'publish',
              'numberposts' => 1
            );
            $my_posts = get_posts($args);
            // var_dump($my_posts[0]);
            // echo $my_posts[0]->post_title;
            if ($my_posts) :
            ?>
                <div class="title-box clearfix ">
                    <h2 class="title-box_primary"><?php echo $my_posts[0]->post_title; ?></h2>
                </div>
                <?php //echo $my_posts[0]->post_content; 
                ?>
                <?php
                echo wp_trim_words(get_the_content(), 50);
                ?>
                <a href="<?php $my_posts[0]->guid; ?>?page_id=<?php echo $my_posts[0]->ID; ?>" title="read more" class="btn-inline " target="_self">read more</a>
            <?php
            else :
              echo 'No post found';
            endif;
            ?>
        </div>  -->


<!-- about us mid banner -->
<div class="mid-banner">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 gx-lg-5 d-flex align-items-center"
        data-aos="fade-right" data-aos-once="true">
        <div class="mid-text">
          <h6><?php echo get_theme_mod('whoweare_text_setting', 'Who We Are'); ?></h6>
          <h1><?php echo get_theme_mod('whoweare_subtext_setting', 'One of the Best Video Editing Institutes in Delhi'); ?></h1>
          <p><?php echo get_theme_mod('whoweare_second_subtext_setting', 'VEI, one of the best video editing training Institutes in Delhi is a well-known education
              institute for imparting training in audio-video editing and filmmaking. The education
              partner of
              ADMEC is established with the vision to bring out creative editors from young aspirants and
              professional job seeker.'); ?>
          </p>
          <button class="gradient-btn mt-5">
            <a href="http://localhost/video_editing_institute/video_theme/about-us/">Read More</a>
          </button>
        </div>
      </div>
      <div class="button-back">
        <img src="<?php echo get_theme_mod('whoweare_image1'); ?>" alt="" class="img-fluid">
      </div>
      <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 gx-lg-5">
        <div class="galaxy">
          <img src="<?php echo get_theme_mod('whoweare_image2'); ?>" alt="" class="img-fluid" id="img1"
            data-aos="fade-up" data-aos-once="true">
          <img src="<?php echo get_theme_mod('whoweare_image3'); ?>" alt=""
            class="img-fluid" id="img2" data-aos="fade-down" data-aos-once="true">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- all software -->
<!-- what we offer section  -->
<div class="software">
  <div class="container-fluid">
    <div class="row">
      <?php query_posts('posts_per_page=4&cat=5'); ?>
      <?php
      if (have_posts()) : while (have_posts()) : the_post();
      ?>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
            <div class="up-text text-center">
              <h6 data-aos="fade-up" data-aos-once="true"><?php the_title(); ?></h6>
              <h1 data-aos="fade-up" data-aos-once="true"><?php the_content(); ?></h1>
            <?php
          endwhile;
          wp_reset_query(); ?>
          <?php else : ?>
            <h2>Not Found</h2>
          <?php endif; ?>
            </div>
          </div>
    </div>

    <div class="row">
      <?php query_posts('posts_per_page=6&cat=6'); ?>
      <?php
      if (have_posts()) : while (have_posts()) : the_post();
      ?>
          <!-- 1 -->
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="card" data-aos="zoom-in-up" data-aos-once=" true" data-aos-delay="200">
              <p class="card-img-top"> <?php the_post_thumbnail(); ?></p>
              <div class="card-body-2">


                <h5 class="card-title"><?php the_title(); ?></h5>
                <p class="card-text"><?php the_excerpt(); ?></p>
                <button class="gradient-btn mt-4">
                  <a href="#">need action</a>
                </button>
              </div>
            </div>
          </div>

        <?php
        endwhile;
        wp_reset_query(); ?>


      <?php else : ?>
        <h2>Not Found</h2>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- all brand -->
<div class="all-brand">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 brand-text" data-aos="fade-up"
        data-aos-once="true">
        <h1><?php echo get_theme_mod('leading_app_text_setting', 'Get video editing training on leading applications'); ?></h1>
        <p><?php echo get_theme_mod('leading_app_subtext_setting', 'At our video editing institute, you will learn the professional industry leading software applications only.'); ?></p>
      </div>
      <div class="button-back">
        <img src="<?php echo get_theme_mod('leading_app_image10'); ?>" alt="" class="img-fluid">
      </div>

      <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 brand" data-aos="fade-up" data-aos-once="true">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="https://www.admecindia.co.in/course/best-photoshop-master-course/" target="_blank">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image1'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="https://www.admecindia.co.in/course/best-cinema-4d-master-course/" target="_blank">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image2'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="https://www.admecindia.co.in/course/best-adobe-illustrator-master-course/" target="_blank">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image3'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="https://www.admecindia.co.in/course/best-adobe-premiere-pro-master-course/" target="_blank">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image4'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="#">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image5'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="#">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image6'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="https://www.admecindia.co.in/course/best-adobe-after-effects-master-course/" target="_blank">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image7'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="#">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image8'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
            <a href="https://www.admecindia.co.in/course/lightroom-course/" target="_blank">
              <div class="box">
                <img src="<?php echo get_theme_mod('leading_app_image9'); ?>" alt="" class="img-fluid" />
              </div>
            </a>
          </div>

        </div>
      </div>
    </div>

    <!-- counter -->
    <div class="counter" data-aos="fade-up" data-aos-once="true">
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 m-auto">
          <div class="counter-text">
            <h1 class="count"><?php echo get_theme_mod('home_counter1_setting'); ?></h1>
            <p><?php echo get_theme_mod('home_counter1_text_setting'); ?></p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 m-auto">
          <div class="counter-text">
            <h1 class="count"><?php echo get_theme_mod('home_counter2_setting'); ?></h1>
            <p><?php echo get_theme_mod('home_counter2_text_setting'); ?></p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 m-auto">
          <div class="counter-text">
            <h1 class="count"><?php echo get_theme_mod('home_counter3_setting'); ?></h1>
            <p><?php echo get_theme_mod('home_counter3_text_setting'); ?></p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 m-auto">
          <div class="counter-text">
            <h1 class="count"><?php echo get_theme_mod('home_counter4_setting'); ?></h1>
            <p><?php echo get_theme_mod('home_counter1_text_setting'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- why choose us bg all -->
<div class="bg-all">
  <div class="container-fluid">
    <div class="long-card">
      <div class="row">

        <?php query_posts('posts_per_page=4&cat=8'); ?>
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
        ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 g-0 l-text text-center">
              <h6 data-aos="fade-up" data-aos-once="true"><?php the_title(); ?></h6>
              <h1 data-aos="fade-up" data-aos-once="true"><?php the_content(); ?></h1>
            </div>
          <?php
          endwhile;
          wp_reset_query(); ?>
        <?php else : ?>
          <h2>Not Found</h2>
        <?php endif; ?>
      </div>
      <div class="l-card">
        <div class="row">
          <?php query_posts('posts_per_page=4&cat=9'); ?>
          <?php
          if (have_posts()) : while (have_posts()) : the_post();
          ?>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="b-box" data-aos="fade-up" data-aos-once="true">
                  <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2">
                      <p class='m-3'><?php the_post_thumbnail(); ?></p>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10">
                      <h1><?php the_title(); ?></h1>
                      <p><?php the_content(); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            endwhile;
            wp_reset_query(); ?>
          <?php else : ?>
            <h2>Not Found</h2>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- blog -->
<div class="blog">
  <div class="container-fluid">
    <div class="row d-flex align-items-center">
      <?php query_posts('posts_per_page=4&cat=11'); ?>
      <?php
      if (have_posts()) : while (have_posts()) : the_post();
      ?>
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="b-text" data-aos="fade-up" data-aos-once="true">
              <h6><?php the_title(); ?></h6>
              <!-- <h1><?php the_excerpt(); ?></h1> -->
              <p><?php the_content(); ?></p>
              <button class="gradient-btn mt-4 mt-lg-5">
                <a href="#">Discover more</a>
              </button>
            </div>
          </div>
        <?php
        endwhile;
        wp_reset_query(); ?>
      <?php else : ?>
        <h2>Not Found</h2>
      <?php endif; ?>


      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 b-img">
        <div class="box">
          <?php query_posts('posts_per_page=4&cat=12'); ?>
          <?php
          if (have_posts()) : while (have_posts()) : the_post();
          ?>
              <div class="row blog-box align-items-center" data-aos="fade-up" data-aos-once="true">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <p><?php the_post_thumbnail(); ?></p>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 px-sm-4">

                  <a style="text-decoration:none;" href="<?php the_permalink(); ?>">
                    <h4><?php the_title(); ?></h4>
                  </a>
                  <p><?php the_content(); ?></p>
                </div>
              </div>

            <?php
            endwhile;
            wp_reset_query(); ?>
          <?php else : ?>
            <h2>Not Found</h2>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- contact -->
<div class="contact">
  <div class="container-fluid">
    <div class="c-text text-center mb-4">

      <h6 data-aos="fade-down" data-aos-once="true"><?php echo get_theme_mod('home_contact_heading'); ?></h6>
      <h1 data-aos="fade-down" data-aos-once="true" data-aos-delay="100"><?php echo get_theme_mod('home_contact_sub_heading'); ?></h1>
      <p data-aos="fade-down" data-aos-once="true" data-aos-delay="200"><?php echo get_theme_mod('home_contact_para'); ?></p>
    </div>
    <div class="form">
      <div class="form-wrap mb-100">
        <div id="survey-form" data-aos="fade-up" data-aos-once="true">
          <?php
          echo do_shortcode('[contact-form-7 id="9443166" title="Contact Form"]');
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>