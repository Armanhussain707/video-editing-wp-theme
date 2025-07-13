<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (is_search()) { ?>
        <meta name="robots" content="noindex, nofollow" />
    <?php } ?>

    <title>
        <?php
        if (function_exists('is_tag') && is_tag()) {
            single_tag_title("Tag Archive for &quot;");
            echo '&quot; - ';
        } elseif (is_archive()) {
            wp_title('');
            echo ' Archive - ';
        } elseif (is_search()) {
            echo 'Search for &quot;' . esc_html(get_search_query()) . '&quot; - ';
        } elseif (!(is_404()) && (is_single()) || (is_page())) {
            wp_title('');
            echo ' - ';
        } elseif (is_404()) {
            echo 'Not Found - ';
        }
        if (is_home()) {
            bloginfo('name');
            echo ' - ';
            bloginfo('description');
        } else {
            bloginfo('name');
        }
        if ($paged > 1) {
            echo ' - page ' . $paged;
        }
        ?>
    </title>
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- slick -->
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/slick.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/slick.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/slick-theme.min.css">

    <!-- font Awesome  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- -----------------------------------------------------------------------  -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" /> -->

    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/main.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/home.css">



    <link rel="shortcut icon" href="/favicon.ico">

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

    <?php wp_head(); ?>
</head>

<body>

    <?php if (get_theme_mod('enable_dynamic_logo_section', true)) : ?>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg" id="homepage">
                
                                <a class="navbar-brand" href="<?php echo home_url(); ?>">
                                    <img src="<?php echo get_theme_mod('dynamic_logo_image'); ?>" alt="logo">
                                </a>
                
                                <a href="<?php echo home_url(); ?>" class="tablet-logo">
                                    <img src="<?php echo get_theme_mod('dynamic_logo_image'); ?>" alt="logo">
                                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class='bx bx-menu'></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse me-5 pe-5" id="navbarNavDropdown">


                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'depth'           => 2, // Allows sub-menu items
                        'container'       => 'div', // Use a div for the container
                        'container_class' => 'nav-menu', // Class for the container
                        'container_id'    => 'navbarNavDropdown', // ID for the container
                        'menu_class'      => 'navbar-nav ms-auto', // Classes for the menu items
                        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                        'walker'          => new wp_bootstrap_navwalker(), // Use the custom walker
                    ));
                    ?>
                    <?php if (get_theme_mod('enable_header_search', true)) : ?>
                        <ul class="navbar-nav  pe-5 me-5 my-2">
                            <li class="nav-item">
                                <a href="#" class="nav-link  ms-3 " data-bs-toggle="modal" data-bs-target="#searchModal">
                                    <i class="fas fa-search fa-lg  "></i>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="fix-btn">
                    <button class="gradient-btn d-none d-lg-block px-4 text-black" type="submit">
                        <a href="<?php echo esc_url(get_theme_mod('header_button_url', '#popmake-513')); ?>">
                            <?php echo esc_html(get_theme_mod('header_button_text', 'Apply Now')); ?>
                        </a>
                    </button>
                </div>
            </nav>
        </div>
    <?php endif; ?>

    <!-- top btn -->
    <a href="#homepage">
        <div class="go-top-btn" id="topBtn">
            <i class='bx bx-arrow-to-top'></i>
        </div>
    </a>