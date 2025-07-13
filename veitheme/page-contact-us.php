<?php get_header(); ?>


<!-- wrapper hero -->
<div class="wrapper-hero-img">


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-content text-center">
                    <h1><?php echo get_theme_mod('contact_banner_text_setting', 'Contact Us'); ?></h1>
                    <p><?php echo get_theme_mod('contact_banner_subtext_setting', 'Get in touch and let us know how we can help.'); ?></p>
                    <div class="button-back">
                        <img src="<?php echo get_template_directory_uri(); ?>\icon\img_memphis2.png" alt="About Us Banner" class="img-fluid">

                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a href="<?php echo home_url(); ?>">Home</a>
                        <i class='bx bx-chevron-right'></i>
                        <span>Contact us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- get in touch -->
<div class="get-touch-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="get-touch-heading text-center mb-5" data-aos="fade-up" data-aos-once="true">
                    <h6><?php echo get_theme_mod('getintouch_text_setting', 'get in touch'); ?></h6>
                    <h1><?php echo get_theme_mod('getintouch_subtext_setting', 'have any questions?'); ?></h1>
                    <p><?php echo get_theme_mod('getintouch_second_subtext_setting', 'Contact for Video Editing Courses in Rohini'); ?></p>
                </div>
            </div>

            <div class="col-md-4 mt-5 mb-3 g-lg-5" data-aos="fade-up" data-aos-once="true">
                <div class="location">
                    <img src="<?php echo get_theme_mod('cards1_image'); ?>" class="img-fluid" alt="">
                    <h3><?php echo get_theme_mod('cards1_text_setting', 'location'); ?></h3>
                    <p><?php echo get_theme_mod('cards1_subtext_setting', 'Block C-9/15, 4th Floor, Opposite Metro Pillar No 399, Sector- 7, New Delhi - India'); ?></p>
                </div>
            </div>

            <div class="col-md-4 mt-5 mb-3 g-lg-5" data-aos="fade-up" data-aos-once="true" data-aos-delay="200">
                <div class="get-email">
                    <img src="<?php echo get_theme_mod('cards2_image'); ?>" class="img-fluid" alt="">
                    <h3><?php echo get_theme_mod('cards2_text_setting', 'email us'); ?></h3>
                    <p><?php echo get_theme_mod('cards2_subtext_setting', 'info@admec.co.in'); ?></p>
                </div>
            </div>

            <div class="col-md-4 mt-5 mb-3 g-lg-5" data-aos="fade-up" data-aos-once="true" data-aos-delay="400">
                <div class="call">
                    <img src="<?php echo get_theme_mod('cards3_image'); ?>" class="img-fluid" alt="">
                    <h3><?php echo get_theme_mod('cards3_text_setting', 'call us'); ?></h3>
                    <p><?php echo get_theme_mod('cards3_subtext_setting', '+91-9811-818-122'); ?></p>
                    <p><?php echo get_theme_mod('cards3_second_subtext_setting', '+91-9911-782-350'); ?></p>
                </div>
            </div>

            <div class="col-12">
                <div class="map mt-5" data-aos="fade-up" data-aos-once="true">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.3491192490383!2d77.12102421459703!3d28.70911078736279!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d015fc7285ae3%3A0x6b0d619671ba366f!2sADMEC%20-%20Graphic%20Design%20%7C%20Web%20Development%20%7C%20CAD%20%7C%20Video%20Editing%20Institute%20Rohini%20Delhi!5e0!3m2!1sen!2sin!4v1679139611512!5m2!1sen!2sin"
                        height="500" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-form-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form-heading text-center mb-5" data-aos="fade-up" data-aos-once="true">
                    <h1><?php echo get_theme_mod('contact_us_form_title', 'Send us a message'); ?></h1>
                    <p><?php echo get_theme_mod('contact_us_form_paragraph', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                            ullamcorper mattis, pulvinar dapibus leo.'); ?></p>
                </div>
            </div>

            <div class="contact-form mx-auto text-light">
                <!-- <?php
                        echo do_shortcode('[contact-form-7 id="28d8d8e" title="Contact Us Form"]');
                        ?> -->

                <?php
                $form_shortcode = get_theme_mod('contact_us_form_shortcode');
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

<?php get_footer(); ?>