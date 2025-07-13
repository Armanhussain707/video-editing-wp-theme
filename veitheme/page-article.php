<?php
/* Template Name: Articles Page */
get_header();
?>


<!-- wrapper hero -->

<div class="wrapper-hero-img " style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url(get_theme_mod('allartical_bg_image', get_template_directory_uri() . '../images/milky-way-and-mountains-night-landscape-1536x1053.jpg')); ?>');">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-content text-center">
                    <h1><?php echo get_theme_mod('allartical_banner_text_sec', 'All Artical'); ?></h1>
                    <p><?php echo get_theme_mod('allartical_banner_subtext_sec', 'Delhis no.1 video editing institute'); ?></p>
                    <div class="button-back">
                        <img src="<?php echo get_template_directory_uri(); ?>\icon\img_memphis2.png" alt="About Us Banner" class="img-fluid">

                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a href="<?php echo home_url(); ?>">Home</a>
                        <i class='bx bx-chevron-right'></i>
                        <span>All Articals</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- articles -->
<div class="article-main py-5">
    <div class="container-fluid">
        <div class="row g-4"> <!-- gap between rows/columns -->

            <?php
            $args = array(
                'posts_per_page' => 5,
                'category_name'  => 'articles'
            );
            $custom_query = new WP_Query($args);

            if ($custom_query->have_posts()) :
                while ($custom_query->have_posts()) : $custom_query->the_post();
            ?>

                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="article-box w-100 d-flex flex-column h-100" style="background: none;">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark d-flex flex-column h-100">

                                <!-- Image -->
                                <div class="article-img" style="overflow: hidden; height: 243px;">
                                    <?php the_post_thumbnail('medium', ['class' => 'w-100 h-100 object-fit-cover']); ?>
                                </div>

                                <!-- Title & Excerpt -->
                                <div class="article-title p-3 d-flex flex-column justify-content-between flex-grow-1">
                                    <h3 class="h6 mb-2"><?php the_title(); ?></h3>

                                    <p class="excerpt text-muted mb-3" style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                ">
                                        <?php the_excerpt(); ?>
                                    </p>

                                    <hr class="mt-auto">
                                    <p class="d-flex justify-content-between small text-muted mb-0">
                                        <span><?php echo get_the_date(); ?></span>
                                        <span>
                                            <?php
                                            $comments = get_comments_number();
                                            echo $comments > 0 ? "$comments Comments" : "No Comments";
                                            ?>
                                        </span>
                                    </p>
                                </div>

                            </a>
                        </div>
                    </div>

            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<h2>Not Found</h2>';
            endif;
            ?>

        </div>
    </div>
</div>

<?




?>

<?php get_footer(); ?>