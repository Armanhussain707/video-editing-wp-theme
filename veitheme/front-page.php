<?php get_header(); ?>
<!-- header -->
<!-- top btn -->
<a href="#homepage">
  <div class="go-top-btn" id="topBtn">
    <i class='bx bx-arrow-to-top'></i>
  </div>
</a>
<!-- hero banner -->
<?php if (get_theme_mod('enable_slider_text_section', true)) : ?>
  <div class="hero-banner">
    <div class="hero-overlay"></div>

    <img src="<?php echo get_theme_mod('slider_image1'); ?>" alt="Hero Image">

    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8 col-md-10 banner-text" data-aos="fade-right" data-aos-once="true">
          <h1><?php echo get_theme_mod('slider_text_setting', 'Start your career into video editing'); ?></h1>
          <h4><?php echo get_theme_mod('slider_subtext_setting', 'Courses at our Video Editing Institute in Delhi make you a job-ready professional video editor from level zero.'); ?></h4>
          <button class="gradient-btn mt-3 mt-lg-4">

            <a href="<?php echo esc_url(get_theme_mod('home_banner_button_url', '#')); ?>" target="_blank">
              <?php echo esc_html(get_theme_mod('home_banner_button_text', 'Check Courses')); ?>
            </a>

          </button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- banner card -->
<?php if (get_theme_mod('enable_banner_card_section', true)) : ?>
  <div class="banner-card">
    <div class="container-fluid">
      <div class="row">
        <!-- 1 -->
        <div class="col-lg-4 col-md-12 col-sm-12 col-xl-4 col-xs-12 mt-5">
          <div class="card" data-aos="fade-up" data-aos-once="true">
            <div class="card-body">
              <i class="<?php echo esc_attr(get_theme_mod('banner_card_icon1', 'fa-solid fa-camera')); ?> pb-4"></i>
              <h4><?php echo get_theme_mod('banner_card_title1'); ?></h4>
              <p><?php echo get_theme_mod('banner_card_desc1'); ?></p>
            </div>
          </div>
        </div>

        <!-- 2 -->
        <div class="col-lg-4 col-md-12 col-sm-12 col-xl-4 col-xs-12 mt-5">
          <div class="card" data-aos="fade-up" data-aos-once="true">
            <div class="card-body">
              <i class="<?php echo esc_attr(get_theme_mod('banner_card_icon2', 'fa-solid fa-camera')); ?> pb-4"></i>
              <h4><?php echo get_theme_mod('banner_card_title2'); ?></h4>
              <p><?php echo get_theme_mod('banner_card_desc2'); ?></p>
            </div>
          </div>
        </div>

        <!-- 3 -->
        <div class="col-lg-4 col-md-12 col-sm-12 col-xl-4 col-xs-12 mt-5">
          <div class="card" data-aos="fade-up" data-aos-once="true">
            <div class="card-body">
              <i class="<?php echo esc_attr(get_theme_mod('banner_card_icon3', 'fa-solid fa-camera')); ?> pb-4"></i>
              <h4><?php echo get_theme_mod('banner_card_title3'); ?></h4>
              <p><?php echo get_theme_mod('banner_card_desc3'); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

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
                <div class="clearfix title-box">
                    <h2 class="title-box_primary"><?php echo $my_posts[0]->post_title; ?></h2>
                </div>
                <?php //echo $my_posts[0]->post_content; 
                ?>
                <?php
                echo wp_trim_words(get_the_content(), 50);
                ?>
                <a href="<?php $my_posts[0]->guid; ?>?page_id=<?php echo $my_posts[0]->ID; ?>" title="read more" class="btn-inline" target="_self">read more</a>
            <?php
            else :
              echo 'No post found';
            endif;
            ?>
        </div>  -->


<!-- about us mid banner -->
<?php if (get_theme_mod('whoweare_text_section', true)) : ?>
  <div class="mid-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6 col-xs-12 d-flex align-items-center gx-lg-5"
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
              <a href="<?php echo esc_url(get_theme_mod('aboutus_banner_button_url', '#')); ?>" target="_blank">
                <?php echo esc_html(get_theme_mod('aboutus_button_text', 'Read More')); ?>
              </a>
            </button>
          </div>
        </div>
        <div class="button-back">
          <img src="<?php echo get_theme_mod('whoweare_image1'); ?>" alt="" class="img-fluid">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6 col-xs-12 gx-lg-5">
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
<?php endif; ?>

<!-- all software -->
<!-- what we offer section  -->

<?php if (get_theme_mod('software_section', true)) : ?>
  <div class="software">
    <div class="container-fluid">
      <!-- ✅ Software Section Title and Description -->
      <?php
      $software_title = get_theme_mod('software_section_title', 'Our Software Solutions');
      $software_description = get_theme_mod('software_section_description', 'Discover the best software solutions for your needs.');

      ?>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
          <div class="text-center over up-text">
            <!-- ✅ Dynamic Section Title -->
            <h6 data-aos="fade-up" data-aos-once="true"><?php echo esc_html($software_title); ?></h6>
            <!-- ✅ Dynamic Section Description -->
            <h1 data-aos="fade-up" data-aos-once="true"><?php echo esc_html($software_description); ?></h1>
          </div>
        </div>
      </div>

      <!-- <div class="row">
      <?php query_posts('posts_per_page=4&cat=5'); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
            <div class="text-center over up-text">
              <h6 data-aos="fade-up" data-aos-once="true"><?php the_title(); ?></h6>
              <h1 data-aos="fade-up" data-aos-once="true"><?php the_content(); ?></h1>
            </div>
          </div>
      <?php endwhile;
        wp_reset_query(); ?>
      <?php else : ?>
        <h2>Not Found</h2>
      <?php endif; ?>
    </div> -->

      <!-- softwere Card Section  -->
      <div class="row">
        <!-- 1 -->
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="card" data-aos="zoom-in-up" data-aos-once=" true" data-aos-delay="200">
            <img class="card-img-top" src="<?php echo get_theme_mod('software_section_image'); ?>" alt="ONE">
            <div class="card-body-2">
              <h5 class="card-title"><?php echo get_theme_mod("software_section_heading"); ?></h5>
              <p class="card-text"><?php echo get_theme_mod('software_section_paragraph'); ?></p>
              <button class="gradient-btn mb-4">
                <a href="<?php echo esc_url(get_theme_mod('software_section_button_url1', '#')); ?>" target="_blank" class="gradient-btn mb-4">
                  <?php echo esc_html(get_theme_mod('software_section_button_text1', 'Explore Courses')); ?>
                </a>
              </button>
            </div>
          </div>
        </div>
        <!-- 2 -->
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="card" data-aos="zoom-in-up" data-aos-once="true" data-aos-delay="400">
            <img class="card-img-top" src="<?php echo get_theme_mod('software_section_image2'); ?>" alt="Card TWO">
            <div class="card-body-2">
              <h5 class="card-title"><?php echo get_theme_mod("software_section_heading2"); ?></h5>
              <p class="card-text"><?php echo get_theme_mod('software_section_paragraph2'); ?></p>
              <button class="gradient-btn mb-4">
                <a href="<?php echo esc_url(get_theme_mod('software_section_button_url2', '#')); ?>" target="_blank" class="gradient-btn mb-4">
                  <?php echo esc_html(get_theme_mod('software_section_button_text2', 'Explore Courses')); ?>
                </a>
              </button>
            </div>
          </div>
        </div>
        <!-- 3 -->
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="card" data-aos="zoom-in-up" data-aos-once="true" data-aos-delay="600">
            <img class="card-img-top" src="<?php echo get_theme_mod('software_section_image3'); ?>" alt="Card image THREE">
            <div class="card-body-2">
              <h5 class="card-title"><?php echo get_theme_mod("software_section_heading3"); ?></h5>
              <p class="card-text"><?php echo get_theme_mod('software_section_paragraph3'); ?></p>
              <button class="gradient-btn mb-4">
                <a href="<?php echo esc_url(get_theme_mod('software_section_button_url3', '#')); ?>" target="_blank" class="gradient-btn mb-4">
                  <?php echo esc_html(get_theme_mod('software_section_button_text3', 'Explore Courses')); ?>
                </a>
              </button>
            </div>
          </div>
        </div>
        <!-- 4 -->
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="card" data-aos="zoom-in-up" data-aos-once="true" data-aos-delay="200">
            <img class="card-img-top" src="<?php echo get_theme_mod('software_section_image4'); ?>" alt="Card image 4TH">
            <div class="card-body-2">
              <h5 class="card-title"><?php echo get_theme_mod("software_section_heading4"); ?></h5>
              <p class="card-text"><?php echo get_theme_mod('software_section_paragraph4'); ?></p>
              <button class="gradient-btn mb-4">
                <a href="<?php echo esc_url(get_theme_mod('software_section_button_url4', '#')); ?>" target="_blank" class="gradient-btn mb-4">
                  <?php echo esc_html(get_theme_mod('software_section_button_text4', 'Explore Courses')); ?>
                </a>
              </button>
            </div>
          </div>
        </div>
        <!-- 5 -->
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="card" data-aos="zoom-in-up" data-aos-once="true" data-aos-delay="400">
            <img class="card-img-top" src="<?php echo get_theme_mod('software_section_image5'); ?>" alt="Card image 5TH">
            <div class="card-body-2">
              <h5 class="card-title"><?php echo get_theme_mod("software_section_heading5"); ?></h5>
              <p class="card-text"><?php echo get_theme_mod('software_section_paragraph5'); ?></p>
              <button class="gradient-btn mb-4">
                <a href="<?php echo esc_url(get_theme_mod('software_section_button_url5', '#')); ?>" target="_blank" class="gradient-btn mb-4">
                  <?php echo esc_html(get_theme_mod('software_section_button_text5', 'Explore Courses')); ?>
                </a>
              </button>
            </div>
          </div>
        </div>
        <!-- 6 -->
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="card" data-aos="zoom-in-up" data-aos-once="true" data-aos-delay="600">
            <img class="card-img-top" src="<?php echo get_theme_mod('software_section_image6'); ?>" alt="Card image 6TH">
            <div class="card-body-2">
              <h5 class="card-title"><?php echo get_theme_mod("software_section_heading6"); ?></h5>
              <p class="card-text"><?php echo get_theme_mod('software_section_paragraph6'); ?></p>
              <button class="gradient-btn mb-4">
                <a href="<?php echo esc_url(get_theme_mod('software_section_button_url6', '#')); ?>" target="_blank" class="gradient-btn mb-4">
                  <?php echo esc_html(get_theme_mod('software_section_button_text6', 'Explore Courses')); ?>
                </a>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>


<!-- all brand -->
<?php if (get_theme_mod('leading_app_text_sec', true)) : ?>
  <div class="all-brand " style="background-image:linear-gradient(90deg, #070b20cc 30%, #ffffff00 100%),
    linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('<?php echo esc_url(get_theme_mod('all_brand_bg_image', get_template_directory_uri() . '../images/milky-way-and-mountains-night-landscape-1536x1053.jpg')); ?>');">

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6 col-xs-12 brand-text" data-aos="fade-up" data-aos-once="true">
          <h1 class="over"><?php echo get_theme_mod('leading_app_text_setting', 'Get video editing training on leading applications'); ?></h1>
          <p><?php echo get_theme_mod('leading_app_subtext_setting', 'At our video editing institute, you will learn the professional industry leading software applications only.'); ?></p>
        </div>
        <div class="button-back">
          <img src="<?php echo get_theme_mod('leading_app_image10'); ?>" alt="" class="img-fluid">
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6 col-xs-12 brand" data-aos="fade-up" data-aos-once="true">
          <div class="row">
            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link1', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image1'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link2', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image2'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link3', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image3'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link4', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image4'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link5', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image5'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link6', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image6'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link7', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image7'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link8', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('leading_app_image8'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>

            <div class="col-6 col-lg-4 col-md-4 col-sm-6 col-xl-4">
              <a href="<?php echo esc_url(get_theme_mod('leading_app_image_link9', '#')); ?>" target="_blank">
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
          <div class="col-12 col-lg-3 col-md-3 col-sm-6 col-xl-3 m-auto">
            <div class="counter-text">
              <h1 class="count"><?php echo get_theme_mod('home_counter1_setting'); ?></h1>
              <p><?php echo get_theme_mod('home_counter1_text_setting'); ?></p>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-md-3 col-sm-6 col-xl-3 m-auto">
            <div class="counter-text">
              <h1 class="count"><?php echo get_theme_mod('home_counter2_setting'); ?></h1>
              <p><?php echo get_theme_mod('home_counter2_text_setting'); ?></p>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-md-3 col-sm-6 col-xl-3 m-auto">
            <div class="counter-text">
              <h1 class="count"><?php echo get_theme_mod('home_counter3_setting'); ?></h1>
              <p><?php echo get_theme_mod('home_counter3_text_setting'); ?></p>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-md-3 col-sm-6 col-xl-3 m-auto">
            <div class="counter-text">
              <h1 class="count"><?php echo get_theme_mod('home_counter4_setting'); ?></h1>
              <p><?php echo get_theme_mod('home_counter4_text_setting'); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- why choose us bg all -->
<?php if (get_theme_mod('counter_sec', true)) : ?>
  <div class="bg-all">
    <div class="container-fluid">
      <div class="long-card">
        <div class="row">
          <?php query_posts('posts_per_page=1&cat=59'); ?>
          <?php
          if (have_posts()) : while (have_posts()) : the_post();
          ?>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-xs-12 g-0 text-center l-text">
                <h6 data-aos="fade-up" data-aos-once="true"><?php echo get_theme_mod('chouse_us_title') ?></h6>
                <h1  data-aos="fade-up" data-aos-once="true"><?php echo get_theme_mod('chouse_us_content') ?></h1>
              </div>
            <?php
            endwhile;
            wp_reset_query(); ?>
          <?php else : ?>
            <h2>Not Found</h2>
          <?php endif; ?>
        </div>
        <!-- why choose us 4 boxes -->
        <div class="l-card">
          <div class="row">
            <?php query_posts('posts_per_page=4&cat=59'); ?>
            <?php
            if (have_posts()) : while (have_posts()) : the_post();
            ?>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 col-xs-12">
                  <div class="b-box" data-aos="fade-up" data-aos-once="true">
                    <div class="row">
                      <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 col-xs-2">
                        <p class='m-3'><?php the_post_thumbnail(); ?></p>
                        <!-- <p class='m-3'><i class="bx bx-certification"></i></p> -->
                      </div>
                      <div class="col-lg-10 col-md-10 col-sm-10 col-xl-10 col-xs-10">
                        <h1>
                          <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                          </a>
                        </h1>
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
<?php endif; ?>


<!-- blog -->
<div class="blog">
  <div class="container-fluid">
    <div class="d-flex row align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 col-xs-12">
        <div class="b-text" data-aos="fade-up" data-aos-once="true">
          <h6><?php echo get_theme_mod('discover_title') ?></h6>
          <h1><?php echo get_theme_mod('discover_content') ?></h1>
          <p><?php echo get_theme_mod('discover_para') ?></p>
          <button class="gradient-btn mt-4 mt-lg-5">

            <a href="<?php echo esc_url(get_theme_mod('discover_btn_url', '#')); ?>" target="_blank">
              <?php echo esc_html(get_theme_mod('discover_btn_text', 'Discover more')); ?>
            </a>
          </button>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 col-xs-12 b-img">
        <div class="box">
          <?php query_posts('posts_per_page=4&cat=61'); ?>
          <?php
          if (have_posts()) : while (have_posts()) : the_post();
          ?>
              <div class="row align-items-center blog-box" data-aos="fade-up" data-aos-once="true">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 col-xs-3">
                  <p><?php the_post_thumbnail(); ?></p>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xl-9 col-xs-9 px-sm-4">
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
    <div class="text-center c-text mb-4">
      <h6 data-aos="fade-down" data-aos-once="true"><?php echo get_theme_mod('home_contact_heading'); ?></h6>
      <h1 data-aos="fade-down" data-aos-once="true" data-aos-delay="100"><?php echo get_theme_mod('home_contact_sub_heading'); ?></h1>
      <p data-aos="fade-down" data-aos-once="true" data-aos-delay="200"><?php echo get_theme_mod('home_contact_para'); ?></p>
    </div>
    <div class="form">
      <div class="form-wrap mb-100">
        <div id="survey-form" data-aos="fade-up" data-aos-once="true">
          <!-- <?php
                echo do_shortcode('[contact-form-7 id="9443166" title="Contact Form"]');
                ?> -->

          <?php
          $form_shortcode = get_theme_mod('home_contact_form_shortcode');
          if (!empty($form_shortcode)) {
            echo do_shortcode($form_shortcode);
          } else {
            echo '<p style="color: red;">Please add a contact form shortcode in Customizer.</p>';
          }
          ?>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="space"></div>


<?php get_footer(); ?>