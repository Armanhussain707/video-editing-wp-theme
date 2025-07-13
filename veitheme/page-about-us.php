<?php get_header(); ?>
<!-- wrapper hero -->
<div class="wrapper-hero-img " style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url(get_theme_mod('aboutus_bg_image', get_template_directory_uri() . '../images/milky-way-and-mountains-night-landscape-1536x1053.jpg')); ?>');">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="wrapper-content text-center">
          <h1><?php echo get_theme_mod('about_banner_text_setting', 'About Us'); ?></h1>
          <p><?php echo get_theme_mod('about_banner_subtext_setting', 'Delhis no.1 video editing institute'); ?></p>
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

<!-- about us mid banner -->
<?php if (get_theme_mod('who_we_are_section', true)) : ?>
  <div class="mid-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6 col-xs-12 d-flex align-items-center gx-lg-5"
          data-aos="fade-right" data-aos-once="true">
          <div class="mid-text">
            <h6><?php echo get_theme_mod('who_we_are_tittle', 'Who We Are'); ?></h6>
            <h1><?php echo get_theme_mod('who_we_are_subtext', 'One of the Best Video Editing Institutes in Delhi'); ?></h1>
            <p><?php echo get_theme_mod('who_we_are_sec_subtext', 'VEI, one of the best video editing training Institutes in Delhi is a well-known education
              institute for imparting training in audio-video editing and filmmaking. The education
              partner of
              ADMEC is established with the vision to bring out creative editors from young aspirants and
              professional job seeker.'); ?>
            </p>
            <div class="button-back">
              <img src="<?php echo get_theme_mod('who_we_are_image1'); ?>" alt="" class="img-fluid">
            </div>
            <button class="gradient-btn mt-5">
              <a href="<?php echo esc_url(get_theme_mod('who_we_are_btn_url', '#')); ?>" target="_blank">
                <?php echo esc_html(get_theme_mod('who_we_are_btn_text', 'Read More')); ?>
              </a>
            </button>
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6 col-xs-12 gx-lg-5">
          <div class="galaxy">
            <img src="<?php echo get_theme_mod('who_we_are_image2'); ?>" alt="" class="img-fluid" id="img1"
              data-aos="fade-up" data-aos-once="true">
            <img src="<?php echo get_theme_mod('who_we_are_image3'); ?>" alt=""
              class="img-fluid" id="img2" data-aos="fade-down" data-aos-once="true">
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- our objectives mid banner -->
<?php if (get_theme_mod('our_objective', true)) : ?>
  <div class="mid-banner our-objective">
    <div class="container-fluid">
      <div class="row obj-reverse">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 gx-lg-5">
          <div class="galaxy">
            <img src="<?php echo get_theme_mod('our_objective_image2'); ?>" alt="" class="img-fluid" id="img1"
              data-aos="fade-up" data-aos-once="true">
            <img src="<?php echo get_theme_mod('our_objective_image3'); ?>" alt=""
              class="img-fluid" id="img2" data-aos="fade-down" data-aos-once="true">
          </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 gx-lg-5 d-flex align-items-center"
          data-aos="fade-right" data-aos-once="true">
          <div class="mid-text">
            <h6><?php echo get_theme_mod('our_objective_tittle', 'our objective'); ?></h6>
            <h1><?php echo get_theme_mod('our_objective_subtext', 'A Dedicated Video Editing Institute in Delhi'); ?></h1>
            <p><?php echo get_theme_mod('our_objective_sec_subtext', 'We are a team of dedicated instructors who are committed to build your editing skills and
                                       make you a job-ready video editor for the industry.'); ?></p>
            <button class="gradient-btn mt-5">
              <a href="<?php echo esc_url(get_theme_mod('our_objective_btn_url', '#')); ?>" target="_blank">
                <?php echo esc_html(get_theme_mod('our_objective_btn_text', 'Read More')); ?>
              </a>
            </button>
            <div class="objective-button-back">
              <img src="<?php echo get_theme_mod('our_objective_image1'); ?>" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- what we offer -->
<div class="institute-feature">
  <div class="container-fluid">
    <div class="row" data-aos="fade-up" data-aos-once="true">
      <div class="col-12">
        <div class="institute-feature-heading text-center">
          <h6><?php echo get_theme_mod('whatweoffer_text_setting', 'what we offer'); ?></h6>
          <h1><?php echo get_theme_mod('whatweoffer_subtext_setting', 'We make you a post production artist'); ?></h1>
        </div>
      </div>
    </div>

    <div class="feature-wrapper mt-md-5 mt-3">
      <div class="row" data-aos="fade-up" data-aos-once="true">
        <!-- 1 -->
        <div class="col-md-4 gx-lg-5">
          <div class="feature-box-wrapper">
            <div class="feature-box">
              <div class="feature-box-img">
                <img src="<?php echo get_theme_mod('vision_image1'); ?>" style='width:460px; height:460px' alt="">
              </div>
              <div class="feature-box-overlay"></div>
            </div>
            <div class="feature-box-content d-flex flex-wrap align-content-center justify-content-end">
              <div class="feature-icon w-100">
                <i class="<?php echo esc_attr(get_theme_mod('vision_logo_image1', 'fa-solid fa-camera')); ?> pb-4"></i>

              </div>
              <div class="feature-title">
                <h3><?php echo get_theme_mod('vision_text_setting', 'vision'); ?></h3>
              </div>
              <div class="feature-desc">
                <p><?php echo get_theme_mod('vision_subtext_setting', 'To provide world class video editing training by experts'); ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- 2 -->
        <div class="col-md-4 gx-lg-5">
          <div class="feature-box-wrapper">
            <div class="feature-box">
              <div class="feature-box-img">
                <img src="<?php echo get_theme_mod('mission_image2'); ?>" style='width:460px; height:460px' alt="">
              </div>
              <div class="feature-box-overlay"></div>
            </div>
            <div class="feature-box-content d-flex flex-wrap align-content-center justify-content-end">
              <div class="feature-icon w-100">
                <i class="<?php echo esc_attr(get_theme_mod('mission_logo_image2', 'fa-solid fa-camera')); ?> pb-4"></i>
              </div>
              <div class="feature-title">
                <h3><?php echo get_theme_mod('mission_text_setting', 'mission'); ?></h3>
              </div>
              <div class="feature-desc">
                <p><?php echo get_theme_mod('mission_subtext_setting', 'Let you accomplish your dream of becoming a video editor'); ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- 3 -->
        <div class="col-md-4 gx-lg-5">
          <div class="feature-box-wrapper">
            <div class="feature-box">
              <div class="feature-box-img">
                <img src="<?php echo get_theme_mod('motto_image3'); ?>" style='width:460px; height:460px' alt="">
              </div>
              <div class="feature-box-overlay"></div>
            </div>
            <div class="feature-box-content d-flex flex-wrap align-content-center justify-content-end">
              <div class="feature-icon w-100">
                <i class="<?php echo esc_attr(get_theme_mod('motto_logo_image3', 'fa-solid fa-camera')); ?> pb-4"></i>
              </div>
              <div class="feature-title">
                <h3><?php echo get_theme_mod('motto_text_setting', 'motto'); ?></h3>
              </div>
              <div class="feature-desc">
                <p><?php echo get_theme_mod('motto_subtext_setting', 'Professionals video editing training for passionate learners'); ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- all brand -->
<?php if (get_theme_mod('About_leading_app_text_sec', true)) : ?>
  <div class="all-brand" style="background-image:linear-gradient(90deg, #070b20cc 30%, #ffffff00 100%),
    linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('<?php echo esc_url(get_theme_mod('all_brand_bg_image', get_template_directory_uri() . '../images/milky-way-and-mountains-night-landscape-1536x1053.jpg')); ?>');">
    <div class="container-fluid">
      <div class="row">
        <div class=" col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 brand-text" data-aos="fade-up"
          data-aos-once="true">
          <h1><?php echo get_theme_mod('About_leading_app_text_setting', 'Get video editing training on leading applications'); ?></h1>
          <p><?php echo get_theme_mod('About_leading_app_subtext_setting', 'At our video editing institute, you will learn the professional industry leading software applications only.'); ?></p>
        </div>
        <div class="button-back">
          <img src="<?php echo get_theme_mod('About_leading_app_image10'); ?>" alt="" class="img-fluid">
        </div>
        <!-- 1 -->
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 brand" data-aos="fade-up" data-aos-once="true">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link1', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image1'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 2 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link2', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image2'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 3 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link3', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image3'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 4 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link4', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image4'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 5 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link5', '#')); ?>">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image5'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 6 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link6', '#')); ?>">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image6'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 7 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link7', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image7'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 8 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link8', '#')); ?>">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image8'); ?>" alt="" class="img-fluid" />
                </div>
              </a>
            </div>
            <!-- 9 -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
              <a href="<?php echo esc_url(get_theme_mod('About_leading_app_image_link9', '#')); ?>" target="_blank">
                <div class="box">
                  <img src="<?php echo get_theme_mod('About_leading_app_image9'); ?>" alt="" class="img-fluid" />
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
              <h1 class="count"><?php echo get_theme_mod('about_counter1_setting'); ?></h1>
              <p><?php echo get_theme_mod('about_counter1_text_setting'); ?></p>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-md-3 col-sm-6 col-xl-3 m-auto">
            <div class="counter-text">
              <h1 class="count"><?php echo get_theme_mod('about_counter2_setting'); ?></h1>
              <p><?php echo get_theme_mod('about_counter2_text_setting'); ?></p>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-md-3 col-sm-6 col-xl-3 m-auto">
            <div class="counter-text">
              <h1 class="count"><?php echo get_theme_mod('about_counter3_setting'); ?></h1>
              <p><?php echo get_theme_mod('about_counter3_text_setting'); ?></p>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-md-3 col-sm-6 col-xl-3 m-auto">
            <div class="counter-text">
              <h1 class="count"><?php echo get_theme_mod('about_counter4_setting'); ?></h1>
              <p><?php echo get_theme_mod('about_counter4_text_setting'); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- team -->
<div class="team-main">
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-lg-8">
        <div class="team-heading text-center" data-aos="fade-up" data-aos-once="true">
          <h6 class='xyz'><?php echo get_theme_mod('about_team_small_heading'); ?></h6>
          <h1><?php echo get_theme_mod('about_team_main_heading'); ?></h1>
        </div>
      </div>
    </div>

    <div class="team-wrapper" data-aos="fade-up" data-aos-once="true">
      <div class="row mt-5">
        <div class="slide-team mb-4">
          <!-- 1 -->
          <div class="col-md-4">
            <div class="team-fixed">
              <div class="team-box">
                <img class='img-fluid team-img' src="<?php echo get_theme_mod('about_team__image1'); ?>" alt="Team img">
                <div class="team-box-content">
                  <h3 class="name"><?php echo get_theme_mod('about_team1_h3'); ?></h3>
                  <span class="post"><?php echo get_theme_mod('about_team1_span'); ?></span>
                  <p class="exp"><?php echo get_theme_mod('about_team1_para'); ?></p>
                </div>
              </div>
            </div>
          </div>


          <!-- 2 -->
          <div class="col-md-4">
            <div class="team-fixed">
              <div class="team-box">
                <img class='img-fluid team-img' src="<?php echo get_theme_mod('about_team__image2'); ?>" alt="Team img">
                <div class="team-box-content">
                  <h3 class="name"><?php echo get_theme_mod('about_team2_h3'); ?></h3>
                  <span class="post"><?php echo get_theme_mod('about_team2_span'); ?></span>
                  <p class="exp"><?php echo get_theme_mod('about_team2_para'); ?></p>
                </div>
              </div>
            </div>
          </div>


          <!-- 3 -->
          <div class="col-md-4">
            <div class="team-fixed">
              <div class="team-box">
                <img class='img-fluid team-img' src="<?php echo get_theme_mod('about_team__image3'); ?>" alt="Team img">
                <div class="team-box-content">
                  <h3 class="name"><?php echo get_theme_mod('about_team3_h3'); ?></h3>
                  <span class="post"><?php echo get_theme_mod('about_team3_span'); ?></span>
                  <p class="exp"><?php echo get_theme_mod('about_team3_para'); ?></p>
                </div>
              </div>
            </div>
          </div>


          <!-- 4 -->
          <div class="col-md-4">
            <div class="team-fixed">
              <div class="team-box">
                <img class='img-fluid team-img' src="<?php echo get_theme_mod('about_team__image4'); ?>" alt="Team img">
                <div class="team-box-content">
                  <h3 class="name"><?php echo get_theme_mod('about_team4_h3'); ?></h3>
                  <span class="post"><?php echo get_theme_mod('about_team4_span'); ?></span>
                  <p class="exp"><?php echo get_theme_mod('about_team4_para'); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 5 -->
        <!-- <div class="col-md-4">
          <div class="team-fixed">
            <div class="team-box">
              <img class='img-fluid team-img' src="<?php echo get_theme_mod('about_team__image5'); ?>" alt="Team img">
              <div class="team-box-content">
                <h3 class="name"><?php echo get_theme_mod('about_team5_h3'); ?></h3>
                <span class="post"><?php the_content(); ?></span>
                <p class="exp"><?php the_excerpt(); ?></p>
              </div>
            </div>
          </div>
        </div> -->


        <!-- 6 -->
        <!-- <div class="col-md-4">
          <div class="team-fixed">
            <div class="team-box">
              <img class='img-fluid team-img' src="<?php echo get_theme_mod('about_team__image6'); ?>" alt="Team img">
              <div class="team-box-content">
                <h3 class="name"><?php echo get_theme_mod('about_team6_h3'); ?></h3>
                <span class="post"><?php the_content(); ?></span>
                <p class="exp"><?php the_excerpt(); ?></p>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>


    <div class="d-flex justify-content-center mt-5">
      <button class="gradient-btn">
        <a href="<?php echo esc_url(get_theme_mod('aboutus_team_button_url', '#')); ?>" target="_blank">
          <?php echo esc_html(get_theme_mod('aboutus_team_button_text', 'Read More')); ?>
        </a>
      </button>
    </div>
  </div>
</div>

<!-- </div>
</div> -->



<!-- testimonial feedback -->
<div class="testimonial-main">
  <div class="testimonial-button-back">
    <img src="<?php bloginfo('template_url'); ?>/./icon/img_memphis2.png" alt="" class="img-fluid">
  </div>

  <div class="testimonial-button-back-2">
    <img src="<?php bloginfo('template_url'); ?>/./icon/img_memphis2.png" alt="" class="img-fluid">
  </div>
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-lg-8">
        <div class="testimonial-heading text-center">
          <h6 class='xyz'><?php echo get_theme_mod('about_testimonial_banner_text'); ?></h6>
          <h1><?php echo get_theme_mod('testimonials_banner_subtext_setting'); ?></h1>
        </div>
      </div>
    </div>

    <div class="testimonial-wrapper mt-5">
      <div class="row">
        <div class="testimonial-slide">
          <?php query_posts('posts_per_page=6&cat=62'); ?>
          <?php
          if (have_posts()) : while (have_posts()) : the_post();
          ?>

              <!-- feedback 1 -->
              <div class="col-md-4 g-5">
                <div class="testimonial-card">
                  <div class="face front-face ">
                    <p class='profile'> <?php the_post_thumbnail('thumbnail'); ?></p>
                    <div class="pt-3 text-uppercase name">
                      <?php the_title(); ?>
                    </div>
                    <div class="designation"><?php the_content(); ?></div>
                  </div>
                  <div class="face back-face">
                    <span>
                      <i class='bx bxs-quote-left'></i>
                    </span>
                    <div class="testimonial">
                      <p><?php the_excerpt(); ?></p>
                    </div>
                    <span>
                      <i class='bx bxs-quote-right'></i>
                    </span>
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
      <div class="d-flex justify-content-center">
        <button class="gradient-btn">
          <a href="<?php echo esc_url(get_theme_mod('aboutus_Testimonial_button_url', '#')); ?>" target="_blank">
            <?php echo esc_html(get_theme_mod('aboutus_Testimonial_button_text', 'Read More')); ?>
          </a>
        </button>
      </div>

    </div>
  </div>
</div>

<!-- Optional JavaScript -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="js/script.js"></script>

<script>
  AOS.init({
    duration: 1500,
  });
  $(document).ready(function() {
    // team slider
    $('.slide-team').slick({
      dots: false,
      draggable: true,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 3000,
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      touchThreshold: 1000,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false
          }
        }
      ]
    });

    // testimonals
    $('.testimonial-slide').slick({
      dots: false,
      arrows: false,
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  })
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
  crossorigin="anonymous">
</script>

<?php get_footer(); ?>