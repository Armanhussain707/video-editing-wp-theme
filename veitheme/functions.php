<?php
//navwalker
require_once("wp_bootstrap_navwalker.php");

// Add RSS links to <head> section
// automatic_feed_links();

//Enabling Support for Post Thumbnails
add_theme_support('post-thumbnails');

// Load jQuery
if (!is_admin()) {
	// wp_deregister_script('jquery');
	// wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"), false);
	// wp_enqueue_script('jquery');
}

function arman_enqueue_theme_scripts()
{

	// Bootstrap JS + Popper
	wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'arman_enqueue_theme_scripts');

// Clean up the <head>
function removeHeadLinks()
{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

// Declare sidebar widget zone
// if (function_exists('register_sidebar')) {
// 	register_sidebar(array(
// 		'name' => 'Sidebar Widgets',
// 		'id'   => 'sidebar-widgets',
// 		'description'   => 'These are widgets for the sidebar.',
// 		'before_widget' => '<div id="%1$s" class="widget %2$s">',
// 		'after_widget'  => '</div>',
// 		'before_title'  => '<h2>',
// 		'after_title'   => '</h2>'
// 	));
// }

function register_custom_menus()
{
	register_nav_menus(array(
		'articles_menu' => __('Articles Menu', 'your-theme'),
		'courses_menu' => __('Courses Menu', 'your-theme'),
	));
}
add_action('after_setup_theme', 'register_custom_menus');


// navbar scroll down hide up show 
//function arman_enqueue_scripts() {
//   wp_enqueue_script('jquery'); // jQuery load karega
// }
// add_action('wp_enqueue_scripts', 'arman_enqueue_scripts');



// Register Custom Navigation Walker
function register_navwalker()
{
	require_once get_template_directory() . '/wp_bootstrap_navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

// Register a custom menu
function theme_setup()
{
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'your-theme-slug'),
	));
}
add_action('after_setup_theme', 'theme_setup');

function add_menu_link_class($atts, $item, $args)
{
	if ($args->theme_location === 'primary' && in_array('menu-item-has-children', $item->classes)) {
		$atts['href'] = '#'; // Remove this if you want parent link to be clickable
		$atts['data-bs-toggle'] = 'dropdown';
		$atts['aria-expanded'] = 'false';
		$atts['class'] = 'nav-link dropdown-toggle';
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 3);

// here is footer widgets code 
// address widget area
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Address Widgets',
		'id'   => 'address-widgets',
		'description'   => 'This is for footer address.',
		'before_widget' => '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 foot-1">',
		'after_widget'  => '</div>'
	));
}
// useful links widget 
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Useful Links Widgets',
		'id'   => 'useful-links-widgets',
		'description'   => 'This is for footer useful links.',
		'before_widget' => '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 foot-2">',
		'after_widget'  => '</div>'
	));
}
// our partner widget 
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Our Partner Widgets',
		'id'   => 'our-partner-widgets',
		'description'   => 'This is for footer partners.',
		'before_widget' => '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 foot-3">',
		'after_widget'  => '</div>'
	));
}

function admec_customize_register($wp_customize)
{
	$wp_customize->add_section(
		'mytheme_footer_options_sec',
		array(
			'title' => __('Footer Settings', 'admectheme'),
			'priority' => 100,
			'capability' => 'edit_theme_options',
			'description' => __("Change footer options here", 'admectheme'),
		)
	);

	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'default' => '#000'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color_control', array(
		'label' => __('Footer background color', 'admectheme'),
		'section' => 'mytheme_footer_options_sec',
		'settings' => 'footer_bg_color',
		'priority' => 10
	)));
}
add_action('customize_register', 'admec_customize_register');




//Custom Post Type "Courses" register
function arman_register_courses_cpt()
{
	$labels = array(
		'name'               => 'Courses',
		'singular_name'      => 'Course',
		'menu_name'          => 'Courses',
		'name_admin_bar'     => 'Course',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Course',
		'new_item'           => 'New Course',
		'edit_item'          => 'Edit Course',
		'view_item'          => 'View Course',
		'all_items'          => 'All Courses',
		'search_items'       => 'Search Courses',
		'not_found'          => 'No courses found.',
		'not_found_in_trash' => 'No courses found in Trash.',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-welcome-learn-more', // 🎓 icon
		'query_var'          => true,
		'rewrite'            => array('slug' => 'courses'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),

	);

	register_post_type('courses', $args);
}

// ✅  Custom Taxonomy - "Course Categories" 
function arman_register_course_categories_taxonomy()
{
	$labels = array(
		'name'              => 'Course Categories',
		'singular_name'     => 'Course Category',
		'search_items'      => 'Search Categories',
		'all_items'         => 'All Categories',
		'edit_item'         => 'Edit Category',
		'update_item'       => 'Update Category',
		'add_new_item'      => 'Add New Category',
		'new_item_name'     => 'New Category Name',
		'menu_name'         => 'Categories',
	);

	register_taxonomy('course_category', 'courses', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'course-category'),
	));
}

// ✅  Custom Taxonomy - "Course Tags" 
function arman_register_course_tags_taxonomy()
{
	$labels = array(
		'name'                       => 'Course Tags',
		'singular_name'              => 'Course Tag',
		'search_items'               => 'Search Tags',
		'popular_items'              => 'Popular Tags',
		'all_items'                  => 'All Tags',
		'edit_item'                  => 'Edit Tag',
		'update_item'                => 'Update Tag',
		'add_new_item'               => 'Add New Tag',
		'new_item_name'              => 'New Tag Name',
		'separate_items_with_commas' => 'Separate tags with commas',
		'add_or_remove_items'        => 'Add or remove tags',
		'choose_from_most_used'      => 'Choose from the most used tags',
		'menu_name'                  => 'Tags',
	);

	register_taxonomy('course_tag', 'courses', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array('slug' => 'course-tag'),
	));
}

// Sab kuch ek saath register karwana
function arman_init_courses_cpt_with_taxonomies()
{
	arman_register_courses_cpt();
	arman_register_course_categories_taxonomy();
	arman_register_course_tags_taxonomy();
}
add_action('init', 'arman_init_courses_cpt_with_taxonomies');

// ✅ Courses CPT ke liye Custom Fields Register karna
function arman_courses_custom_fields()
{
	add_meta_box(
		'arman_courses_fields', // ID
		'Course Extra Details', // Title
		'arman_courses_fields_callback', // Callback function
		'courses', // Post type
		'normal', // Context
		'high' // Priority
	);
}
add_action('add_meta_boxes', 'arman_courses_custom_fields');

// -----------field with code ---------------- 

// ✅ Callback function jo fields show karega
function arman_courses_fields_callback($post)
{
	// Nonce field for security
	wp_nonce_field('arman_courses_save_fields', 'arman_courses_nonce');

	// Get existing values
	$button_text = get_post_meta($post->ID, 'add_button_text', true);
	$button_url = get_post_meta($post->ID, 'add_button_url', true);
	$duration = get_post_meta($post->ID, 'add_duration', true);
	$training_type = get_post_meta($post->ID, 'add_training_type', true);
	$training_mode = get_post_meta($post->ID, 'add_training_mode', true);
	$course_type = get_post_meta($post->ID, 'add_course_type', true);
	$description = get_post_meta($post->ID, 'add_description', true);


?>

	<p><label><b>Button Text:</b></label><br>
		<input type="text" name="add_button_text" value="<?php echo esc_attr($button_text); ?>" class="widefat" />
	</p>

	<p><label><b>Button URL:</b></label><br>
		<input type="text" name="add_button_url" value="<?php echo esc_attr($button_url); ?>" class="widefat" />
	</p>

	<p><label><b>Duration:</b></label><br>
		<input type="text" name="add_duration" value="<?php echo esc_attr($duration); ?>" class="widefat" />
	</p>

	<p><label><b>Training Type:</b></label><br>
		<input type="text" name="add_training_type" value="<?php echo esc_attr($training_type); ?>" class="widefat" />
	</p>

	<p><label><b>Training Mode:</b></label><br>
		<input type="text" name="add_training_mode" value="<?php echo esc_attr($training_mode); ?>" class="widefat" />
	</p>

	<p><label><b>Course Type:</b></label><br>
		<input type="text" name="add_course_type" value="<?php echo esc_attr($course_type); ?>" class="widefat" />
	</p>

	<p><label><b>Course Description:</b></label><br>
		<textarea name="add_description" rows="5" class="widefat"><?php echo esc_textarea($description); ?></textarea>
	</p>

	<hr>


<?php
}

// ✅ Save karne ka code
function arman_courses_save_custom_fields($post_id)
{
	// Security check
	if (!isset($_POST['arman_courses_nonce']) || !wp_verify_nonce($_POST['arman_courses_nonce'], 'arman_courses_save_fields')) {
		return;
	}

	// Auto Save ko ignore karo
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Permission check
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Save each field
	$fields = [
		'add_button_text',
		'add_button_url',
		'add_duration',
		'add_training_type',
		'add_training_mode',
		'add_course_type',
		'add_description'
	];

	foreach ($fields as $field) {
		if (isset($_POST[$field])) {
			update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
		}
	}
}
add_action('save_post', 'arman_courses_save_custom_fields');


function custom_social_links_customizer($wp_customize)
{
	// Section
	$wp_customize->add_section('social_links_section', array(
		'title' => __('Social Media Links', 'yourtheme'),
		'priority' => 120,
	));

	// Social links array (Facebook, Twitter, YouTube, LinkedIn)
	$socials = array('facebook', 'twitter', 'youtube', 'linkedin');

	foreach ($socials as $social) {
		// URL
		$wp_customize->add_setting("social_{$social}_url", array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control("social_{$social}_url", array(
			'label' => ucfirst($social) . ' URL',
			'section' => 'social_links_section',
			'type' => 'url',
		));

		// Icon Class
		$wp_customize->add_setting("social_{$social}_icon", array(
			'default' => "bx bxl-{$social}",
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control("social_{$social}_icon", array(
			'label' => ucfirst($social) . ' Icon Class',
			'section' => 'social_links_section',
			'type' => 'text',
		));
	}
}
add_action('customize_register', 'custom_social_links_customizer');





function create_testimonial_post_type()
{
	$labels = array(
		'name'               => 'Testimonials',
		'singular_name'      => 'Testimonial',
		'menu_name'          => 'Testimonials',
		'name_admin_bar'     => 'Testimonial',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Testimonial',
		'new_item'           => 'New Testimonial',
		'edit_item'          => 'Edit Testimonial',
		'view_item'          => 'View Testimonial',
		'all_items'          => 'All Testimonials',
		'search_items'       => 'Search Testimonials',
		'not_found'          => 'No testimonials found.',
		'not_found_in_trash' => 'No testimonials found in Trash.',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'testimonials'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-format-quote',
		'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
	);

	register_post_type('testimonials', $args);
}
add_action('init', 'create_testimonial_post_type');

// Add Custom Meta Boxes for "Applied For" and "Job"
function add_testimonial_meta_boxes()
{
	add_meta_box(
		'testimonial_details_meta_box',
		'Testimonial Details',
		'display_testimonial_meta_box',
		'testimonials',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

// Display the Custom Fields in the Admin Panel
function display_testimonial_meta_box($post)
{
	$applied_for = get_post_meta($post->ID, 'testimonial_applied_for', true);
	$job = get_post_meta($post->ID, 'testimonial_job', true);
?>
	<label for="testimonial_applied_for">Applied For:</label>
	<input type="text" id="testimonial_applied_for" name="testimonial_applied_for" value="<?php echo esc_attr($applied_for); ?>" style="width:100%;">

	<br><br>

	<label for="testimonial_job">Job:</label>
	<input type="text" id="testimonial_job" name="testimonial_job" value="<?php echo esc_attr($job); ?>" style="width:100%;">
<?php
}

// Save the Meta Box Data
function save_testimonial_meta_data($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	if (isset($_POST['testimonial_applied_for'])) {
		update_post_meta($post_id, 'testimonial_applied_for', sanitize_text_field($_POST['testimonial_applied_for']));
	}

	if (isset($_POST['testimonial_job'])) {
		update_post_meta($post_id, 'testimonial_job', sanitize_text_field($_POST['testimonial_job']));
	}
}
add_action('save_post', 'save_testimonial_meta_data');

// this is for pagination 

// Limit search results to 5 per page
function arman_limit_search_results($query)
{
	if (!is_admin() && $query->is_main_query() && $query->is_search()) {
		$query->set('posts_per_page', 5);
	}
}
add_action('pre_get_posts', 'arman_limit_search_results');

function wpbeginner_numeric_posts_nav()
{

	if (is_singular())
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ($wp_query->max_num_pages <= 1)
		return;

	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
	$max   = intval($wp_query->max_num_pages);

	/** Add current page to the array */
	if ($paged >= 1)
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if (($paged + 2) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/** Previous Post Link */
	if (get_previous_posts_link())
		printf('<li>%s</li>' . "\n", get_previous_posts_link());

	/** Link to first page, plus ellipses if necessary */
	if (! in_array(1, $links)) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

		if (! in_array(2, $links))
			echo '<li>…</li>';
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array) $links as $link) {
		$class = $paged == $link ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/** Link to last page, plus ellipses if necessary */
	if (! in_array($max, $links)) {
		if (! in_array($max - 1, $links))
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/** Next Post Link */
	if (get_next_posts_link())
		printf('<li>%s</li>' . "\n", get_next_posts_link());

	echo '</ul></div>' . "\n";
}

//slider content
function slider_content($wp_customize) {}
add_action('customize_register', 'slider_content');

// who we are 
function whoweare_content($wp_customize) {}
add_action('customize_register', 'whoweare_content');

// leading applications  section code is here
function leading_app_content($wp_customize) {}
add_action('customize_register', 'leading_app_content');

// logo dynamic  
function dynamic_logo($wp_customize)
{
	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('enable_dynamic_logo_section', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('enable_dynamic_logo_section', array(
		'type'    => 'checkbox',
		'section' => 'dynamic_logo',
		'label'   => __('Enable Logo & Button Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide the logo and Apply Now button section on homepage.', 'prolific-theme'),
	));

	$wp_customize->add_section('dynamic_logo', array(
		'title'       => __('Chose Your Logo', 'prolific-theme'),
		'priority'    => 1,
		'description' => __(' You may Customize  your logo here ', 'prolific-theme')
	));
	$wp_customize->add_setting('dynamic_logo_image', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/logo_vittor-pre1buru2i34db6zrpsa2459jsdra7s8hs6qhv4we8.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'dynamic_logo_image_control', array(
		'label' => 'Upload Logo Image ',
		'priority' => 30,
		'section' => 'dynamic_logo',
		'settings' => 'dynamic_logo_image',
	)));

	$wp_customize->add_section('dynamic_logo', array(
		'title'       => __('Logo & Apply Now Button', 'prolific-theme'),
		'priority'    => 1,
		'description' => __('Customize Apply Now button text, URL, and visibility.', 'prolific-theme'),
	));


	// Header Button Text Setting
	$wp_customize->add_setting('header_button_text', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Check Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));

	// Home Banner Button Text Control
	$wp_customize->add_control('header_button_text', array(
		'type'        => 'text',
		'section'     => 'dynamic_logo', // your existing section ID
		'label'       => __('Button Text', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// Home Banner Button URL Setting
	$wp_customize->add_setting('header_button_url', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('header_button_url', array(
		'type'        => 'url',
		'section'     => 'dynamic_logo',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));
}
add_action('customize_register', 'dynamic_logo');

// serch panel code 

function theme_customize_register($wp_customize)
{
	$wp_customize->add_section('search_section', array(
		'title'    => __('Search Page Background', 'yourtheme'),
		'priority' => 120,
	));

	$wp_customize->add_setting('search_bg_image', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'search_bg_image', array(
		'label'    => __('Search Background Image', 'yourtheme'),
		'section'  => 'search_section',
		'settings' => 'search_bg_image',
	)));
}
add_action('customize_register', 'theme_customize_register');


// Home Page Panel 
function home_panel($wp_customize)
{
	$wp_customize->add_panel('home_panel', array(
		'title' => 'Home Page Panel',
		'description' => 'This is home page panel ',
		'priority' => 10,
	));



	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('enable_slider_text_section', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('enable_slider_text_section', array(
		'type'    => 'checkbox',
		'section' => 'slider_text_sec',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));

	$wp_customize->add_section('slider_text_sec', array(
		'title'       => __('Home Page Banner Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'		  => 'home_panel',
		'description' => __('Customize the layout of your site homepage', 'prolific-theme')
	));
	$wp_customize->add_setting('slider_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Start your career into video editing',
	));
	$wp_customize->add_control('slider_text_setting', array(
		'type' => 'text',
		'section' => 'slider_text_sec',
		'label' => __('Main Banner Title'),
		'description' => __('Enter title of not more than 15 Words.'),
	));


	//second line of slider
	$wp_customize->add_setting('slider_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonials at our Video Editing Institute in Delhi make you a job-ready professional video editor from level zero.',
	));
	$wp_customize->add_control('slider_subtext_setting', array(
		'type' => 'text',
		'section' => 'slider_text_sec',
		'label' => __('Main Banner Sub Title'),
		'description' => __('Enter title of not more than 35 Words.'),
	));
	//banner image change
	$wp_customize->add_setting('slider_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('../images/male-video-editor-working-on-his-personal-computer-with-big-blank-display.jpg'),
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'slider_image1_control', array(
		'label' => 'Banner Image',
		'priority' => 20,
		'section' => 'slider_text_sec',
		'settings' => 'slider_image1',
	)));



	// Home Banner Button Text Setting
	$wp_customize->add_setting('home_banner_button_text', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Check Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));

	// Home Banner Button Text Control
	$wp_customize->add_control('home_banner_button_text', array(
		'type'        => 'text',
		'section'     => 'slider_text_sec', // your existing section ID
		'label'       => __('Button Text', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// Home Banner Button URL Setting
	$wp_customize->add_setting('home_banner_button_url', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('home_banner_button_url', array(
		'type'        => 'url',
		'section'     => 'slider_text_sec',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));

	//banner Card change

	$wp_customize->add_section('banner_card_section', array(
		'title'       => __('Home Page Banner Card', 'prolific-theme'),
		'priority'    => 30,
		'panel'		  => 'home_panel',
		'description' => __('Customize the layout of your site homepage', 'prolific-theme')
	));

	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('enable_banner_card_section', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('enable_banner_card_section', array(
		'type'    => 'checkbox',
		'section' => 'banner_card_section',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));


	//Font Awesome icon Image1
	$wp_customize->add_setting('banner_card_icon1', array(
		'default'           => 'fa-solid fa-camera', // Default Font Awesome icon
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('banner_card_icon1_control', array(
		'label'       => __('Banner Card Icon 1', 'prolific-theme'),
		'section'     => 'banner_card_section',
		'type'        => 'text',
		'description' => __('Enter Font Awesome  class e.g. fa-solid fa-star', 'prolific-theme'),
		'settings'    => 'banner_card_icon1',
	));


	// Title1
	$wp_customize->add_setting('banner_card_title1', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Card Solutions',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('banner_card_title1', array(
		'type'        => 'text',
		'section'     => 'banner_card_section',
		'label'       => __('Banner Section Title1'),
		'description' => __('Enter title for the card section.'),
	));

	// Description1
	$wp_customize->add_setting("banner_card_desc1", array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Card Solutions',
		'sanitize_callback' => 'sanitize_text_field',

	));

	$wp_customize->add_control("banner_card_desc1", array(
		'type'        => 'text',
		'section'     => 'banner_card_section',
		'label'       => __('Banner Section desc1'),
		'description' => __('Enter title for the card section.'),
	));




	//Font Awesome icon Image2
	$wp_customize->add_setting('banner_card_icon2', array(
		'default'           => 'fa-solid fa-camera', // Default Font Awesome icon
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('banner_card_icon2_control', array(
		'label'       => __('Banner Card Icon 2', 'prolific-theme'),
		'section'     => 'banner_card_section',
		'type'        => 'text',
		'description' => __('Enter Font Awesome  class e.g. fa-solid fa-star', 'prolific-theme'),
		'settings'    => 'banner_card_icon2',
	));


	// Title2
	$wp_customize->add_setting('banner_card_title2', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Card Solutions',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('banner_card_title2', array(
		'type'        => 'text',
		'section'     => 'banner_card_section',
		'label'       => __('Banner Section Title2'),
		'description' => __('Enter title for the card section.'),
	));

	// Description2
	$wp_customize->add_setting("banner_card_desc2", array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Card Solutions',
		'sanitize_callback' => 'sanitize_text_field',

	));

	$wp_customize->add_control("banner_card_desc2", array(
		'type'        => 'text',
		'section'     => 'banner_card_section',
		'label'       => __('Banner Section desc2'),
		'description' => __('Enter title for the card section.'),
	));

	//Font Awesome icon Image3
	$wp_customize->add_setting('banner_card_icon3', array(
		'default'           => 'fa-solid fa-camera', // Default Font Awesome icon
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('banner_card_icon3_control', array(
		'label'       => __('Banner Card Icon 3', 'prolific-theme'),
		'section'     => 'banner_card_section',
		'type'        => 'text',
		'description' => __('Enter Font Awesome  class e.g. fa-solid fa-star', 'prolific-theme'),
		'settings'    => 'banner_card_icon3',
	));

	// Title3
	$wp_customize->add_setting('banner_card_title3', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Card Solutions',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('banner_card_title3', array(
		'type'        => 'text',
		'section'     => 'banner_card_section',
		'label'       => __('Banner Section Title3'),
		'description' => __('Enter title for the card section.'),
	));

	// Description3
	$wp_customize->add_setting("banner_card_desc3", array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Card Solutions',
		'sanitize_callback' => 'sanitize_text_field',

	));

	$wp_customize->add_control("banner_card_desc3", array(
		'type'        => 'text',
		'section'     => 'banner_card_section',
		'label'       => __('Banner Section desc3'),
		'description' => __('Enter title for the card section.'),
	));

	// -----------------------------------------------------

	$wp_customize->add_section('whoweare_text_sec', array(
		'title'       => __('Home & About Who We Are Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'		  => 'home_panel',
		'description' => __('Customize the layout of your who we are content ', 'prolific-theme')
	));

	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('whoweare_text_section', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('whoweare_text_section', array(
		'type'    => 'checkbox',
		'section' => 'whoweare_text_sec',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));

	$wp_customize->add_setting('whoweare_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Who We Are',
	));

	$wp_customize->add_control('whoweare_text_setting', array(
		'type' => 'text',
		'section' => 'whoweare_text_sec',
		'label' => __('Who We Are Section Title'),
		'description' => __('Enter title of not more than 15 Words.'),
	));

	//second line of slider
	$wp_customize->add_setting('whoweare_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'One of the Best Video Editing Institutes in Delhi',
	));

	$wp_customize->add_control('whoweare_subtext_setting', array(
		'type' => 'text',
		'section' => 'whoweare_text_sec',
		'label' => __('Who We Are Section Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));
	//second line of slider
	$wp_customize->add_setting('whoweare_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'VEI, one of the best video editing training Institutes in Delhi is a well-known education
		institute for imparting training in audio-video editing and filmmaking. The education
		partner of ADMEC is established with the vision to bring out creative editors from young aspirants and
		professional job seeker.',
	));

	$wp_customize->add_control('whoweare_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'whoweare_text_sec',
		'label' => __('Who We Are Section Sub Text'),
		'description' => __('Enter subtext here '),
	));
	// aboutus Section Button Text Setting
	$wp_customize->add_setting('aboutus_button_text', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));


	$wp_customize->add_control('aboutus_button_text', array(
		'type'        => 'text',
		'section'     => 'whoweare_text_sec', // your existing section ID
		'label'       => __('Button Text2', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('aboutus_banner_button_url', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('aboutus_banner_button_url', array(
		'type'        => 'url',
		'section'     => 'whoweare_text_sec',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));


	// Software Section Button Text Setting
	$wp_customize->add_setting('software_section_button_text2', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));


	$wp_customize->add_control('software_section_button_text2', array(
		'type'        => 'text',
		'section'     => 'software_section', // your existing section ID
		'label'       => __('Button Text2', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('software_section_button_url2', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('software_section_button_url2', array(
		'type'        => 'url',
		'section'     => 'software_section',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));

	//banner image change
	$wp_customize->add_setting('whoweare_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => '' // get_theme_file_uri('\icon\img_memphis2.png'), 

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'whoweare_image1_control', array(
		'label' => 'Button BG Logo Upload Image 1',
		'priority' => 20,
		'section' => 'whoweare_text_sec',
		'settings' => 'whoweare_image1',
	)));
	$wp_customize->add_setting('whoweare_image2', array(
		'capability'        => 'edit_theme_options',
		'default' => '' // get_theme_file_uri('./images/milky-way-and-mountains-night-landscape-1536x1053.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'whoweare_image2_control', array(
		'label' => 'Upload poster BG Image 2',
		'priority' => 20,
		'section' => 'whoweare_text_sec',
		'settings' => 'whoweare_image2',
	)));
	$wp_customize->add_setting('whoweare_image3', array(
		'capability'        => 'edit_theme_options',
		'default' => "" // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'whoweare_image3_control', array(
		'label' => 'Upload poster Image 3',
		'priority' => 20,
		'section' => 'whoweare_text_sec',
		'settings' => 'whoweare_image3',
	)));

	// ✅✅ Naw Section: Software Section Settings
	$wp_customize->add_section('software_section', array(
		'title'       => __('Software Section Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'       => 'home_panel',
		'description' => __('Customize the Software Section', 'prolific-theme'),
	));


	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('software_section', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('software_section', array(
		'type'    => 'checkbox',
		'section' => 'software_section',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));
	//  Software Section Title
	$wp_customize->add_setting('software_section_title', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Software Solutions',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('software_section_title', array(
		'type'        => 'text',
		'section'     => 'software_section',
		'label'       => __('Software Section Title'),
		'description' => __('Enter title for the software section.'),
	));

	//  Software Section Description
	$wp_customize->add_setting('software_section_description', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Discover the best software solutions for your needs.',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control('software_section_description', array(
		'type'        => 'textarea',
		'section'     => 'software_section',
		'label'       => __('Software Section Description'),
		'description' => __('Enter a brief description for the software section.'),
	));


	// Software card Image Upload Option
	$wp_customize->add_setting('software_section_image', array(
		'capability' => 'edit_theme_options',
		'default'    => '',

	));

	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'software_section_image_control',
		array(
			'label'       => __('Upload Software Section Image'),
			'section'     => 'software_section',
			'description' => __('Upload an image for the software section.'),
			'settings'    => 'software_section_image',
		)
	));

	// ✅ Software Card Section Heading 
	$wp_customize->add_setting('software_section_heading', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Software Courses',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('software_section_heading', array(
		'type'        => 'text',
		'section'     => 'software_section',
		'label'       => __('Software Section Title'),
		'description' => __('Enter title for the software courses section.'),
	));

	//  Software Card Section Paragraph
	$wp_customize->add_setting('software_section_paragraph', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Discover the best software solutions for your needs.',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control('software_section_paragraph', array(
		'type'        => 'textarea',
		'section'     => 'software_section',
		'label'       => __('Software Section paragraph'),
		'paragraph' => __('Enter a paragraph in  software section.'),
	));



	// Software Section Button Text Setting
	$wp_customize->add_setting('software_section_button_text1', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));

	// Software Section Button Text Control
	$wp_customize->add_control('software_section_button_text1', array(
		'type'        => 'text',
		'section'     => 'software_section', // your existing section ID
		'label'       => __('Button Text1', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	//  Button URL Setting
	$wp_customize->add_setting('software_section_button_url1', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('software_section_button_url1', array(
		'type'        => 'url',
		'section'     => 'software_section',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));

	//  Software Section Image2 Upload Option
	$wp_customize->add_setting('software_section_image2', array(
		'capability'        => 'edit_theme_options',
		'default' => "", // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'software_section_image2_control', array(
		'label'       => __('Upload Software Section Image2'),
		'section'     => 'software_section',
		'description' => __('Upload an image for the software section.'),
		'settings'    => 'software_section_image2',
	)));


	// ✅ Software Card Section Heading 
	$wp_customize->add_setting('software_section_heading2', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Software Courses',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('software_section_heading2', array(
		'type'        => 'text',
		'section'     => 'software_section',
		'label'       => __('Software Section Title'),
		'description' => __('Enter title for the software courses section.'),
	));

	//  Software Card Section Paragraph
	$wp_customize->add_setting('software_section_paragraph2', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Discover the best software solutions for your needs.',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control('software_section_paragraph2', array(
		'type'        => 'textarea',
		'section'     => 'software_section',
		'label'       => __('Software Section paragraph'),
		'paragraph' => __('Enter a paragraph in  software section.'),
	));
	// Software Section Button Text Setting
	$wp_customize->add_setting('software_section_button_text2', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));


	$wp_customize->add_control('software_section_button_text2', array(
		'type'        => 'text',
		'section'     => 'software_section', // your existing section ID
		'label'       => __('Button Text2', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('software_section_button_url2', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('software_section_button_url2', array(
		'type'        => 'url',
		'section'     => 'software_section',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));


	//  Software Section Image3 Upload Option
	$wp_customize->add_setting('software_section_image3', array(
		'capability'        => 'edit_theme_options',
		'default' => "", // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'software_section_image3_control', array(
		'label'       => __('Upload Software Section Image3'),
		'section'     => 'software_section',
		'description' => __('Upload an image for the software section.'),
		'settings'    => 'software_section_image3',
	)));

	// ✅ Software Card Section Heading 
	$wp_customize->add_setting('software_section_heading3', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Software Courses',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('software_section_heading3', array(
		'type'        => 'text',
		'section'     => 'software_section',
		'label'       => __('Software Section Title'),
		'description' => __('Enter title for the software courses section.'),
	));

	//  Software Card Section Paragraph
	$wp_customize->add_setting('software_section_paragraph3', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Discover the best software solutions for your needs.',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control('software_section_paragraph3', array(
		'type'        => 'textarea',
		'section'     => 'software_section',
		'label'       => __('Software Section paragraph'),
		'paragraph' => __('Enter a paragraph in  software section.'),
	));

	// Software Section Button Text Setting
	$wp_customize->add_setting('software_section_button_text3', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));

	// Software Section Button Text Control
	$wp_customize->add_control('software_section_button_text3', array(
		'type'        => 'text',
		'section'     => 'software_section', // your existing section ID
		'label'       => __('Button Text3', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('software_section_button_url3', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('software_section_button_url3', array(
		'type'        => 'url',
		'section'     => 'software_section',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));

	//  Software Section Image4 Upload Option
	$wp_customize->add_setting('software_section_image4', array(
		'capability'        => 'edit_theme_options',
		'default' => "", // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'software_section_image4_control', array(
		'label'       => __('Upload Software Section Image4'),
		'section'     => 'software_section',
		'description' => __('Upload an image for the software section.'),
		'settings'    => 'software_section_image4',
	)));

	// ✅ Software Card Section Heading 
	$wp_customize->add_setting('software_section_heading4', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Software Courses',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('software_section_heading4', array(
		'type'        => 'text',
		'section'     => 'software_section',
		'label'       => __('Software Section Title'),
		'description' => __('Enter title for the software courses section.'),
	));

	//  Software Card Section Paragraph
	$wp_customize->add_setting('software_section_paragraph4', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Discover the best software solutions for your needs.',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control('software_section_paragraph4', array(
		'type'        => 'textarea',
		'section'     => 'software_section',
		'label'       => __('Software Section paragraph'),
		'paragraph' => __('Enter a paragraph in  software section.'),
	));

	// Software Section Button Text Setting
	$wp_customize->add_setting('software_section_button_text4', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));

	// Software Section Button Text Control
	$wp_customize->add_control('software_section_button_text4', array(
		'type'        => 'text',
		'section'     => 'software_section', // your existing section ID
		'label'       => __('Button Text4', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('software_section_button_url4', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('software_section_button_url4', array(
		'type'        => 'url',
		'section'     => 'software_section',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));


	//  Software Section Image5 Upload Option
	$wp_customize->add_setting('software_section_image5', array(
		'capability'        => 'edit_theme_options',
		'default' => "", // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'software_section_image5_control', array(
		'label'       => __('Upload Software Section Image5'),
		'section'     => 'software_section',
		'description' => __('Upload an image for the software section.'),
		'settings'    => 'software_section_image5',
	)));


	// ✅ Software Card Section Heading 
	$wp_customize->add_setting('software_section_heading5', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Software Courses',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('software_section_heading5', array(
		'type'        => 'text',
		'section'     => 'software_section',
		'label'       => __('Software Section Title'),
		'description' => __('Enter title for the software courses section.'),
	));

	//  Software Card Section Paragraph
	$wp_customize->add_setting('software_section_paragraph5', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Discover the best software solutions for your needs.',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control('software_section_paragraph5', array(
		'type'        => 'textarea',
		'section'     => 'software_section',
		'label'       => __('Software Section paragraph'),
		'paragraph' => __('Enter a paragraph in  software section.'),
	));

	// Software Section Button Text Setting
	$wp_customize->add_setting('software_section_button_text5', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));

	// Software Section Button Text Control
	$wp_customize->add_control('software_section_button_text5', array(
		'type'        => 'text',
		'section'     => 'software_section', // your existing section ID
		'label'       => __('Button Text5', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('software_section_button_url5', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('software_section_button_url5', array(
		'type'        => 'url',
		'section'     => 'software_section',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));


	//  Software Section Image6 Upload Option
	$wp_customize->add_setting('software_section_image6', array(
		'capability'        => 'edit_theme_options',
		'default' =>  get_theme_file_uri('\Software\After-Effects.webp'), // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'software_section_image6_control', array(
		'label'       => __('Upload Software Section Image6'),
		'section'     => 'software_section',
		'description' => __('Upload an image for the software section.'),
		'settings'    => 'software_section_image6',
	)));


	// ✅ Software Card Section Heading 
	$wp_customize->add_setting('software_section_heading6', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Our Software Courses',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('software_section_heading6', array(
		'type'        => 'text',
		'section'     => 'software_section',
		'label'       => __('Software Section Title'),
		'description' => __('Enter title for the software courses section.'),
	));

	//  Software Card Section Paragraph
	$wp_customize->add_setting('software_section_paragraph6', array(
		'capability' => 'edit_theme_options',
		'default'    => 'Discover the best software solutions for your needs.',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control('software_section_paragraph6', array(
		'type'        => 'textarea',
		'section'     => 'software_section',
		'label'       => __('Software Section paragraph'),
		'paragraph' => __('Enter a paragraph in  software section.'),
	));

	// Software Section Button Text Setting
	$wp_customize->add_setting('software_section_button_text6', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));

	// Software Section Button Text Control
	$wp_customize->add_control('software_section_button_text6', array(
		'type'        => 'text',
		'section'     => 'software_section', // your existing section ID
		'label'       => __('Button Text6', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('software_section_button_url6', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('software_section_button_url6', array(
		'type'        => 'url',
		'section'     => 'software_section',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));

	// home page leading section
	$wp_customize->add_section('leading_app_text_sec', array(
		'title'       => __('HomePage Leading applications Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'		  => 'home_panel',
		'description' => __('Customize the layout of your leading applications section ', 'prolific-theme')
	));


	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('leading_app_text_sec', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('leading_app_text_sec', array(
		'type'    => 'checkbox',
		'section' => 'leading_app_text_sec',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));

	$wp_customize->add_setting('leading_app_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Get video editing training on leading applications',
	));

	$wp_customize->add_control('leading_app_text_setting', array(
		'type' => 'text',
		'section' => 'leading_app_text_sec',
		'label' => __('Leading Application Section Title'),
		'description' => __('Enter title of not more than 15 Words.'),
	));

	$wp_customize->add_setting('all_brand_bg_image', array(
		'default'           => get_template_directory_uri() . '/images/default-bg.jpg',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'all_brand_bg_image', array(
		'label'    => __('All Brand Section Background Image', 'your-theme-slug'),
		'section'  => 'leading_app_text_sec',
		'settings' => 'all_brand_bg_image',
	)));


	//second line of section text
	$wp_customize->add_setting('leading_app_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'At our video editing institute, you will learn the professional industry leading software applications only',
	));

	$wp_customize->add_control('leading_app_subtext_setting', array(
		'type' => 'text',
		'section' => 'leading_app_text_sec',
		'label' => __('Leading Application Section Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	//banner image change
	// image 1
	$wp_customize->add_setting('leading_app_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/ps-removebg-preview.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image1_control', array(
		'label' => 'Upload Image 1',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image1',
	)));
	// Add custom link setting for App image 1
	$wp_customize->add_setting('leading_app_image_link1', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link1_control', array(
		'label'    => __('Image 1 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link1',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 2
	$wp_customize->add_setting('leading_app_image2', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Cinema-4D-Logo__1_-removebg-preview.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image2_control', array(
		'label' => 'Upload Image 2',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image2',
	)));
	// Add custom link setting for App image 2
	$wp_customize->add_setting('leading_app_image_link2', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link2_control', array(
		'label'    => __('Image 2 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link2',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 3
	$wp_customize->add_setting('leading_app_image3', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Ai.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image3_control', array(
		'label' => 'Upload Image 3',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image3',
	)));
	// Add custom link setting for App image 3
	$wp_customize->add_setting('leading_app_image_link3', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link3_control', array(
		'label'    => __('Image 3 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link3',
		'description' => __('Enter the URL where image 1 should link to'),
	));
	// image 4
	$wp_customize->add_setting('leading_app_image4', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Pr-removebg-preview.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image4_control', array(
		'label' => 'Upload Image 4',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image4',
	)));
	// Add custom link setting for App image 4
	$wp_customize->add_setting('leading_app_image_link4', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link4_control', array(
		'label'    => __('Image 4 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link4',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 5
	$wp_customize->add_setting('leading_app_image5', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/A au.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image5_control', array(
		'label' => 'Upload Image 5',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image5',
	)));
	// Add custom link setting for App image 5
	$wp_customize->add_setting('leading_app_image_link5', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link5_control', array(
		'label'    => __('Image 5 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link5',
		'description' => __('Enter the URL where image 1 should link to'),
	));


	// image 6 
	$wp_customize->add_setting('leading_app_image6', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Me.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image6_control', array(
		'label' => 'Upload Image 6',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image6',
	)));
	// Add custom link setting for App image 6
	$wp_customize->add_setting('leading_app_image_link6', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link6_control', array(
		'label'    => __('Image 6 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link6',
		'description' => __('Enter the URL where image 1 should link to'),
	));
	// image 7

	$wp_customize->add_setting('leading_app_image7', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./Software/Ae.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image7_control', array(
		'label' => 'Upload Image 7',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image7',
	)));
	// Add custom link setting for App image 7
	$wp_customize->add_setting('leading_app_image_link7', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link7_control', array(
		'label'    => __('Image 7 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link7',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 8

	$wp_customize->add_setting('leading_app_image8', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Br.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image8_control', array(
		'label' => 'Upload Image 8',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image8',
	)));
	// Add custom link setting for App image 8
	$wp_customize->add_setting('leading_app_image_link8', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link8_control', array(
		'label'    => __('Image 8 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link8',
		'description' => __('Enter the URL where image 1 should link to'),
	));
	// image 9 
	$wp_customize->add_setting('leading_app_image9', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Lr.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image9_control', array(
		'label' => 'Upload Image 9',
		'priority' => 20,
		'section' => 'leading_app_text_sec',
		'settings' => 'leading_app_image9',
	)));
	// Add custom link setting for App image 9
	$wp_customize->add_setting('leading_app_image_link9', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('leading_app_image_link9_control', array(
		'label'    => __('Image 9 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'leading_app_text_sec',
		'settings' => 'leading_app_image_link9',
		'description' => __('Enter the URL where image 1 should link to'),
	));
	// // image 10 
	// $wp_customize->add_setting('leading_app_image10', array(
	// 	'capability'        => 'edit_theme_options',
	// 	'default' => get_theme_file_uri('./icon/img_memphis2.png'),
	// ));

	// $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'leading_app_image10_control', array(
	// 	'label' => 'Upload Image 10',
	// 	'priority' => 20,
	// 	'section' => 'leading_app_text_sec',
	// 	'settings' => 'leading_app_image10',
	// )));
	// // Add custom link setting for App image 10
	// $wp_customize->add_setting('leading_app_image_link10', array(
	// 	'default'           => 'https://www.admecindia.co.in/',
	// 	'sanitize_callback' => 'esc_url_raw',
	// ));

	// $wp_customize->add_control('leading_app_image_link10_control', array(
	// 	'label'    => __('Image 10 Link', 'prolific-theme'),
	// 	'priority' => 20,
	// 	'type'     => 'url',
	// 	'section'  => 'leading_app_text_sec',
	// 	'settings' => 'leading_app_image_link10',
	// 	'description' => __('Enter the URL where image 1 should link to'),
	// ));

	// home counter 1 settings 
	$wp_customize->add_section('counter_sec', array(
		'title'       => __('Home Counter Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'home_panel',
		'description' => __('Customize the layout of your Home counter ', 'prolific-theme')
	));


	$wp_customize->add_setting('home_counter1_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '5000+',
	));

	$wp_customize->add_control('home_counter1_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter 1'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('home_counter1_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Happy Students',
	));

	$wp_customize->add_control('home_counter1_text_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter Text 1'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	// home counter 2 settings 
	$wp_customize->add_setting('home_counter2_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '18+',
	));

	$wp_customize->add_control('home_counter2_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter 2'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('home_counter2_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'YEARS EXPERIENCE',
	));

	$wp_customize->add_control('home_counter2_text_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter Text 2'),
		// 		'description' => __('Enter text of not more than 35 Words.'),
	));

	// home counter 3 settings 
	$wp_customize->add_setting('home_counter3_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '50+',
	));

	$wp_customize->add_control('home_counter3_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter 3'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('home_counter3_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'CARRER TestimonialS',
	));

	$wp_customize->add_control('home_counter3_text_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter Text 3'),
		// 		'description' => __('Enter text of not more than 35 Words.'),
	));

	// home counter 4 settings 
	$wp_customize->add_setting('home_counter4_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '100+',
	));

	$wp_customize->add_control('home_counter4_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter 4'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('home_counter4_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'EVENT & QUIZZES',
	));

	$wp_customize->add_control('home_counter4_text_setting', array(
		'type' => 'text',
		'section' => 'counter_sec',
		'label' => __('Home Counter Text 4'),
		// 		'description' => __('Enter text of not more than 35 Words.'),
	));

	// Section: Chouse Us Section
	$wp_customize->add_section('chouse_us_sec', array(
		'title'       => __('Chouse Us', 'prolific-theme'),
		'priority'    => 40,
		'panel'		  => 'home_panel',
		'description' => __('Customize the WHY CHOOSE US section.', 'prolific-theme'),
	));

	// Title Setting
	$wp_customize->add_setting('chouse_us_title', array(
		'default'           => 'WHY CHOOSE US',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('chouse_us_title', array(
		'label'   => __('Title', 'prolific-theme'),
		'section' => 'chouse_us_sec',
		'type'    => 'text',
	));

	//Chouse US Content Setting
	$wp_customize->add_setting('chouse_us_content', array(
		'default'           => 'Delhi’s No.1 Video Editing Institute',
		'sanitize_callback' => 'wp_kses_post',
	));

	$wp_customize->add_control('chouse_us_content', array(
		'label'   => __('Heading', 'prolific-theme'),
		'section' => 'chouse_us_sec',
		'type'    => 'textarea',
	));

	// home contact setting 
	$wp_customize->add_section('home_contact', array(
		'title'       => __('Home Contact Settings', 'prolific-theme'),
		'priority'    => 40,
		'panel'    => 'home_panel',
		'description' => __('Customize the layout of your Home contact ', 'prolific-theme')
	));
	$wp_customize->add_setting('home_contact_heading', array(
		'capability' => 'edit_theme_options',
		'default' => 'CONTACT US NOW',
	));

	$wp_customize->add_control('home_contact_heading', array(
		'type' => 'text',
		'section' => 'home_contact',
		'label' => __('Home Contact Heading'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('home_contact_sub_heading', array(
		'capability' => 'edit_theme_options',
		'default' => 'Schedule Your Live Demo',
	));

	$wp_customize->add_control('home_contact_sub_heading', array(
		'type' => 'text',
		'section' => 'home_contact',
		'label' => __('Home Contact Sub Heading'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('home_contact_para', array(
		'capability' => 'edit_theme_options',
		'default' => 'Interested in learning with our video editing institute?  Apply now and schedule a free demo session with our expert today..',
	));

	$wp_customize->add_control('home_contact_para', array(
		'type' => 'text',
		'section' => 'home_contact',
		'label' => __('Home Contact Paragraph'),
		// 		'description' => __('Enter Page title '),
	));

	// Contact Form Shortcode Field
	$wp_customize->add_setting('home_contact_form_shortcode', array(
		'capability'        => 'edit_theme_options',
		'default'           => '[contact-form-7 id="9443166" title="Contact Form"]', // Default example
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('home_contact_form_shortcode', array(
		'type'        => 'text',
		'section'     => 'home_contact',
		'label'       => __('Contact Form 7 Shortcode'),
		'description' => __('Paste your Contact Form 7 shortcode here (e.g., [contact-form-7 id="9443166" title="Contact Form"])'),
	));


	// Section: Discover More Section
	$wp_customize->add_section('discover_section', array(
		'title'       => __('STAY UPDATED', 'prolific-theme'),
		'priority'    => 30,
		'panel'		  => 'home_panel',
		'description' => __('Customize the Discover more content section.', 'prolific-theme'),
	));

	// Title Setting
	$wp_customize->add_setting('discover_title', array(
		'default'           => 'Welcome to Our Service',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('discover_title', array(
		'label'   => __('Title', 'prolific-theme'),
		'section' => 'discover_section',
		'type'    => 'text',
	));

	// Content Setting
	$wp_customize->add_setting('discover_content', array(
		'default'           => 'This is your customizable content paragraph for the Discover section.',
		'sanitize_callback' => 'wp_kses_post',
	));

	$wp_customize->add_control('discover_content', array(
		'label'   => __('Content', 'prolific-theme'),
		'section' => 'discover_section',
		'type'    => 'textarea',
	));

	// para Setting
	$wp_customize->add_setting('discover_para', array(
		'default'           => 'This is your customizable content paragraph for the Discover section.',
		'sanitize_callback' => 'wp_kses_post',
	));

	$wp_customize->add_control('discover_para', array(
		'label'   => __('paragraph', 'prolific-theme'),
		'section' => 'discover_section',
		'type'    => 'textarea',
	));

	// Button Text Setting
	$wp_customize->add_setting('discover_btn_text', array(
		'default'           => 'Discover more',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('discover_btn_text', array(
		'label'   => __('Button Text', 'prolific-theme'),
		'section' => 'discover_section',
		'type'    => 'text',
	));

	// Button URL Setting
	$wp_customize->add_setting('discover_btn_url', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('discover_btn_url', array(
		'label'   => __('Button URL', 'prolific-theme'),
		'section' => 'discover_section',
		'type'    => 'url',
	));
}
add_action('customize_register', 'home_panel');

// About Us Panel 
function about_content($wp_customize)
{
	$wp_customize->add_panel('about_panel', array(
		'title' => 'About Us ',
		'description' => 'This is panel Description',
		'priority' => 10,
	));

	// about us banner section 
	$wp_customize->add_section('about_banner_text_sec', array(
		'title'       => __('About Us Banner Settings', 'prolific-theme'),
		'priority'    => 10,
		'panel'		  => 'about_panel',
		'description' => __('Customize the layout of your About Us Banner ', 'prolific-theme')
	));
	$wp_customize->add_setting('about_banner_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'About Us',
	));

	$wp_customize->add_control('about_banner_text_setting', array(
		'type' => 'text',
		'section' => 'about_banner_text_sec',
		'label' => __('About Us Banner Title'),
		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('aboutus_bg_image', array(
		'default'   => get_template_directory_uri() . '/images/default-bg.jpg',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aboutus_bg_image', array(
		'label'    => __('All About Banner Section Background Image', 'your-theme-slug'),
		'section'  => 'about_banner_text_sec',
		'settings' => 'aboutus_bg_image',
	)));

	//second line of banner
	$wp_customize->add_setting('about_banner_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Delhi no.1 video editing institute',
	));

	$wp_customize->add_control('about_banner_subtext_setting', array(
		'type' => 'text',
		'section' => 'about_banner_text_sec',
		'label' => __('About Us Banner Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	// who we Are section 
	// headding 
	$wp_customize->add_section('who_we_are', array(
		'title' => __('Who We Are '),
		'priority' => 10,
		'panel' => 'about_panel',
		'description' => __('Customize the layout of your who we are content', 'prolific-theme')
	));

	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('who_we_are_section', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('who_we_are_section', array(
		'type'    => 'checkbox',
		'section' => 'who_we_are',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));

	// first line of heading

	$wp_customize->add_setting('who_we_are_tittle', array(
		'capability' => 'edit_theme_options',
		'default' => 'Who We Are',
	));

	$wp_customize->add_control('who_we_are_tittle', array(
		'type' => 'text',
		'section' => 'who_we_are',
		'label' => __('Who We Are Section Title'),
		'description' => __('Enter title of not more than 15 Words.'),
	));

	//subtext  line of heading

	$wp_customize->add_setting('who_we_are_subtext', array(
		'capability' => 'edit_theme_options',
		'default' => 'One of the Best Video Editing Institutes in Delhi',
	));

	$wp_customize->add_control('who_we_are_subtext', array(
		'type' => 'text',
		'section' => 'who_we_are',
		'label' => __('Who We Are Section Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));


	$wp_customize->add_setting('who_we_are_sec_subtext', array(
		'capability' => 'edit_theme_options',
		'default' => 'VEI, one of the best video editing training Institutes in Delhi is a well-known education
		institute for imparting training in audio-video editing and filmmaking. The education
		partner of ADMEC is established with the vision to bring out creative editors from young aspirants and
		professional job seeker.',
	));

	$wp_customize->add_control('who_we_are_sec_subtext', array(
		'type' => 'text',
		'section' => 'who_we_are',
		'label' => __('Who We Are Section Sub Text'),
		'description' => __('Enter subtext here '),
	));
	// aboutus Section Button Text Setting
	$wp_customize->add_setting('who_we_are_btn_text', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));


	$wp_customize->add_control('who_we_are_btn_text', array(
		'type'        => 'text',
		'section'     => 'who_we_are', // your existing section ID
		'label'       => __('Button Text2', 'prolific-theme'),
		'description' => __('Enter text for the software section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('who_we_are_btn_url', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('who_we_are_btn_url', array(
		'type'        => 'url',
		'section'     => 'who_we_are',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in software section.', 'prolific-theme'),
	));


	//who_we_are banner image change
	$wp_customize->add_setting('who_we_are_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => '' // get_theme_file_uri('\icon\img_memphis2.png'), 

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'who_we_are_image1', array(
		'label' => 'Upload Button BG Logo  Image 1',
		'priority' => 20,
		'section' => 'who_we_are',
		'settings' => 'who_we_are_image1',
	)));
	$wp_customize->add_setting('who_we_are_image2', array(
		'capability'        => 'edit_theme_options',
		'default' => '' // get_theme_file_uri('./images/milky-way-and-mountains-night-landscape-1536x1053.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'who_we_are_image2', array(
		'label' => 'Upload poster BG Image 2',
		'priority' => 20,
		'section' => 'who_we_are',
		'settings' => 'who_we_are_image2',
	)));
	$wp_customize->add_setting('who_we_are_image3', array(
		'capability'        => 'edit_theme_options',
		'default' => "" // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'who_we_are_image3', array(
		'label' => 'Upload poster Image 3',
		'priority' => 20,
		'section' => 'who_we_are',
		'settings' => 'who_we_are_image3',
	)));

	// ******************************************************
	// Our Objective
	// headding 
	$wp_customize->add_section('our_objective', array(
		'title' => __('Our Objective '),
		'priority' => 10,
		'panel' => 'about_panel',
		'description' => __('Customize the layout of your Our Objective', 'prolific-theme')
	));

	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('our_objective_section', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('our_objective_section', array(
		'type'    => 'checkbox',
		'section' => 'our_objective',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));


	//our_objective banner image change


	$wp_customize->add_setting('our_objective_image2', array(
		'capability'        => 'edit_theme_options',
		'default' => "" // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'our_objective_image2', array(
		'label' => 'Upload bg poster Image 2',
		'priority' => 20,
		'section' => 'our_objective',
		'settings' => 'our_objective_image2',
	)));
	$wp_customize->add_setting('our_objective_image3', array(
		'capability'        => 'edit_theme_options',
		'default' => "" // get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'our_objective_image3', array(
		'label' => 'Upload poster Image 3',
		'priority' => 20,
		'section' => 'our_objective',
		'settings' => 'our_objective_image3',
	)));

	$wp_customize->add_setting('our_objective_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => '' // get_theme_file_uri('\icon\img_memphis2.png'), 

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'our_objective_image1', array(
		'label' => 'Button BG Logo Upload Image 1',
		'priority' => 20,
		'section' => 'our_objective',
		'settings' => 'our_objective_image1',
	)));

	// first line of heading

	$wp_customize->add_setting('our_objective_tittle', array(
		'capability' => 'edit_theme_options',
		'default' => 'our objective',
	));

	$wp_customize->add_control('our_objective_tittle', array(
		'type' => 'text',
		'section' => 'our_objective',
		'label' => __('Our Objective Section Title'),
		'description' => __('Enter title of not more than 15 Words.'),
	));

	//subtext  line of heading

	$wp_customize->add_setting('our_objective_subtext', array(
		'capability' => 'edit_theme_options',
		'default' => 'A Dedicated Video Editing Institute in Delhi',
	));

	$wp_customize->add_control('our_objective_subtext', array(
		'type' => 'text',
		'section' => 'our_objective',
		'label' => __('Our Objective Section Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));


	$wp_customize->add_setting('our_objective_sec_subtext', array(
		'capability' => 'edit_theme_options',
		'default' => 'We are a team of dedicated instructors who are committed to build your editing skills and
                                       make you a job-ready video editor for the industry.',
	));

	$wp_customize->add_control('our_objective_sec_subtext', array(
		'type' => 'text',
		'section' => 'our_objective',
		'label' => __('Our Objective Section Sub Text'),
		'description' => __('Enter subtext here '),
	));
	// aboutus Section Button Text Setting
	$wp_customize->add_setting('our_objective_btn_text', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Read More', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));


	$wp_customize->add_control('our_objective_btn_text', array(
		'type'        => 'text',
		'section'     => 'our_objective', // your existing section ID
		'label'       => __('Button Text2', 'prolific-theme'),
		'description' => __('Enter text for the our_objective button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('our_objective_btn_url', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('our_objective_btn_url', array(
		'type'        => 'url',
		'section'     => 'our_objective',
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in our_objective.', 'prolific-theme'),
	));



	// ------------------------------------------------------------


	// what we offer section 
	// heading
	$wp_customize->add_section('what_we_offer', array(
		'title' => __('What we offer'),
		'priority' => 10,
		'panel' => 'about_panel',
		'description' => __('Customize the layout of your What we offer section ', 'prolific-theme')
	));

	// first line of heading
	$wp_customize->add_setting('whatweoffer_text_setting', array(
		'default' => 'What We Offer',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('whatweoffer_text_setting', array(
		'label' => 'Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter  title '),
		'settings' => 'whatweoffer_text_setting',
	));

	// second line of heading
	$wp_customize->add_setting('whatweoffer_subtext_setting', array(
		'default' => 'We Make You A Post Production Artist',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('whatweoffer_subtext_setting', array(
		'label' => 'Sub Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter sub title '),
		'settings' => 'whatweoffer_subtext_setting',
	));

	// what we offer logo poster and content  3 cards
	// vision
	// change poster image 1 
	$wp_customize->add_setting('vision_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vision_image1', array(
		'label' => 'Upload poster Image 1 ',
		'priority' => 10,
		'section' => 'what_we_offer',
		'settings' => 'vision_image1',
	)));
	// change logo image 1
	//Font Awesome icon Image1
	$wp_customize->add_setting('vision_logo_image1', array(
		'default'           => 'fa-solid fa-camera', // Default Font Awesome icon
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('vision_logo_image1', array(
		'label'       => __('Upload logo Image 1', 'prolific-theme'),
		'section'     => 'what_we_offer',
		'type'        => 'text',
		'description' => __('Enter Font Awesome  class e.g. fa-solid fa-star', 'prolific-theme'),
		'settings'    => 'vision_logo_image1',
	));

	// first line of text 
	$wp_customize->add_setting('vision_text_setting', array(
		'default' => 'VISION',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('vision_text_setting', array(
		'label' => 'Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter  text '),
		'settings' => 'vision_text_setting',
	));

	// second line of text
	$wp_customize->add_setting('vision_subtext_setting', array(
		'default' => 'To provide world class video editing training by experts',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('vision_subtext_setting', array(
		'label' => 'Sub Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter subtext  '),
		'settings' => 'vision_subtext_setting',
	));


	// mission
	// change poster image 2 
	$wp_customize->add_setting('mission_image2', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mission_image2', array(
		'label' => 'Upload poster Image 2 ',
		'priority' => 10,
		'section' => 'what_we_offer',
		'settings' => 'mission_image2',
	)));

	// change logo image  2
	//Font Awesome icon Image2
	$wp_customize->add_setting('mission_logo_image2', array(
		'default'           => 'fa-solid fa-camera', // Default Font Awesome icon
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mission_logo_image2', array(
		'label'       => __('Upload logo Image 1', 'prolific-theme'),
		'section'     => 'what_we_offer',
		'type'        => 'text',
		'description' => __('Enter Font Awesome  class e.g. fa-solid fa-star', 'prolific-theme'),
		'settings'    => 'mission_logo_image2',
	));
	// first line of text
	$wp_customize->add_setting('mission_text_setting', array(
		'default' => 'MISSION',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('mission_text_setting', array(
		'label' => 'Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter  text '),
		'settings' => 'mission_text_setting',
	));

	// second line of text
	$wp_customize->add_setting('mission_subtext_setting', array(
		'default' => 'Let you accomplish your dream of becoming a video editor',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('mission_subtext_setting', array(
		'label' => 'Sub Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter subtext  '),
		'settings' => 'mission_subtext_setting',
	));

	// motto

	// change poster image 3 
	$wp_customize->add_setting('motto_image3', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'motto_image3', array(
		'label' => 'Upload poster Image 3  ',
		'priority' => 10,
		'section' => 'what_we_offer',
		'settings' => 'motto_image3',
	)));
	// change logo image  3
	//Font Awesome icon Image3
	$wp_customize->add_setting('motto_logo_image3', array(
		'default'           => 'fa-solid fa-camera', // Default Font Awesome icon
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('motto_logo_image3', array(
		'label'       => __('Upload logo Image 3', 'prolific-theme'),
		'section'     => 'what_we_offer',
		'type'        => 'text',
		'description' => __('Enter Font Awesome  class e.g. fa-solid fa-star', 'prolific-theme'),
		'settings'    => 'motto_logo_image3',
	));
	// first line of text
	$wp_customize->add_setting('motto_text_setting', array(
		'default' => 'MOTTO',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('motto_text_setting', array(
		'label' => 'Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter  text '),
		'settings' => 'motto_text_setting',
	));

	// second line of text
	$wp_customize->add_setting('motto_subtext_setting', array(
		'default' => 'Professionals video editing training for passionate learners',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control('motto_subtext_setting', array(
		'label' => 'Sub Heading ',
		'type' => 'text',
		'section' => 'what_we_offer',
		'description' => __('Enter subtext  '),
		'settings' => 'motto_subtext_setting',
	));

	//--------------------------------------------------


	// About page leading section
	$wp_customize->add_section('About_leading_app_text_sec', array(
		'title'       => __('About Leading applications Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'		  => 'about_panel',
		'description' => __('Customize the layout of your leading applications section ', 'prolific-theme')
	));


	// Toggle Setting for Show/Hide section
	$wp_customize->add_setting('About_leading_app_text_sec', array(
		'default'           => true,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_validate_boolean',
	));

	// Toggle Control
	$wp_customize->add_control('About_leading_app_text_sec', array(
		'type'    => 'checkbox',
		'section' => 'About_leading_app_text_sec',
		'label'   => __('Enable Section', 'prolific-theme'),
		'description' => __('Toggle to show/hide section on homepage.', 'prolific-theme'),
	));

	$wp_customize->add_setting('About_leading_app_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Get video editing training on leading applications',
	));

	$wp_customize->add_control('About_leading_app_text_setting', array(
		'type' => 'text',
		'section' => 'About_leading_app_text_sec',
		'label' => __('Leading Application Section Title'),
		'description' => __('Enter title of not more than 15 Words.'),
	));

	$wp_customize->add_setting('About_all_brand_bg_image', array(
		'default'           => get_template_directory_uri() . '/images/default-bg.jpg',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_all_brand_bg_image', array(
		'label'    => __('All Brand Section Background Image', 'your-theme-slug'),
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_all_brand_bg_image',
	)));


	//second line of section text
	$wp_customize->add_setting('About_leading_app_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'At our video editing institute, you will learn the professional industry leading software applications only',
	));

	$wp_customize->add_control('About_leading_app_subtext_setting', array(
		'type' => 'text',
		'section' => 'About_leading_app_text_sec',
		'label' => __('Leading Application Section Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	//banner image change
	// image 1
	$wp_customize->add_setting('About_leading_app_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/ps-removebg-preview.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image1_control', array(
		'label' => 'Upload Image 1',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image1',
	)));
	// Add custom link setting for App image 1
	$wp_customize->add_setting('About_leading_app_image_link1', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link1_control', array(
		'label'    => __('Image 1 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link1',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 2
	$wp_customize->add_setting('About_leading_app_image2', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Cinema-4D-Logo__1_-removebg-preview.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image2_control', array(
		'label' => 'Upload Image 2',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image2',
	)));
	// Add custom link setting for App image 2
	$wp_customize->add_setting('About_leading_app_image_link2', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link2_control', array(
		'label'    => __('Image 2 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link2',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 3
	$wp_customize->add_setting('About_leading_app_image3', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Ai.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image3_control', array(
		'label' => 'Upload Image 3',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image3',
	)));
	// Add custom link setting for App image 3
	$wp_customize->add_setting('About_leading_app_image_link3', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link3_control', array(
		'label'    => __('Image 3 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link3',
		'description' => __('Enter the URL where image 1 should link to'),
	));
	// image 4
	$wp_customize->add_setting('About_leading_app_image4', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Pr-removebg-preview.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image4_control', array(
		'label' => 'Upload Image 4',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image4',
	)));
	// Add custom link setting for App image 4
	$wp_customize->add_setting('About_leading_app_image_link4', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link4_control', array(
		'label'    => __('Image 4 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link4',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 5
	$wp_customize->add_setting('About_leading_app_image5', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/A au.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image5_control', array(
		'label' => 'Upload Image 5',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image5',
	)));
	// Add custom link setting for App image 5
	$wp_customize->add_setting('About_leading_app_image_link5', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link5_control', array(
		'label'    => __('Image 5 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link5',
		'description' => __('Enter the URL where image 1 should link to'),
	));


	// image 6 
	$wp_customize->add_setting('About_leading_app_image6', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Me.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image6_control', array(
		'label' => 'Upload Image 6',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image6',
	)));
	// Add custom link setting for App image 6
	$wp_customize->add_setting('About_leading_app_image_link6', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link6_control', array(
		'label'    => __('Image 6 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link6',
		'description' => __('Enter the URL where image 1 should link to'),
	));
	// image 7

	$wp_customize->add_setting('About_leading_app_image7', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./Software/Ae.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image7_control', array(
		'label' => 'Upload Image 7',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image7',
	)));
	// Add custom link setting for App image 7
	$wp_customize->add_setting('About_leading_app_image_link7', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link7_control', array(
		'label'    => __('Image 7 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link7',
		'description' => __('Enter the URL where image 1 should link to'),
	));

	// image 8

	$wp_customize->add_setting('About_leading_app_image8', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Br.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image8_control', array(
		'label' => 'Upload Image 8',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image8',
	)));
	// Add custom link setting for App image 8
	$wp_customize->add_setting('About_leading_app_image_link8', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link8_control', array(
		'label'    => __('Image 8 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link8',
		'description' => __('Enter the URL where image 1 should link to'),
	));
	// image 9 
	$wp_customize->add_setting('About_leading_app_image9', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./icon/Lr.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'About_leading_app_image9_control', array(
		'label' => 'Upload Image 9',
		'priority' => 20,
		'section' => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image9',
	)));
	// Add custom link setting for App image 9
	$wp_customize->add_setting('About_leading_app_image_link9', array(
		'default'           => 'https://www.admecindia.co.in/',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('About_leading_app_image_link9_control', array(
		'label'    => __('Image 9 Link', 'prolific-theme'),
		'priority' => 20,
		'type'     => 'url',
		'section'  => 'About_leading_app_text_sec',
		'settings' => 'About_leading_app_image_link9',
		'description' => __('Enter the URL where image 1 should link to'),
	));



	// ___________________________
	// about_ counter 1 settings 
	$wp_customize->add_section('about_counter_sec', array(
		'title'       => __('About Counter Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'about_panel',
		'description' => __('Customize the layout of your About counter ', 'prolific-theme')
	));


	$wp_customize->add_setting('about_counter1_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '5000+',
	));

	$wp_customize->add_control('about_counter1_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('About Counter 1'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('about_counter1_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Happy Students',
	));

	$wp_customize->add_control('about_counter1_text_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('about_ Counter Text 1'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	// home counter 2 settings 
	$wp_customize->add_setting('about_counter2_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '18+',
	));

	$wp_customize->add_control('about_counter2_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('about Counter 2'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('about_counter2_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'YEARS EXPERIENCE',
	));

	$wp_customize->add_control('about_counter2_text_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('about Counter Text 2'),
		// 		'description' => __('Enter text of not more than 35 Words.'),
	));

	// home counter 3 settings 
	$wp_customize->add_setting('about_counter3_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '50+',
	));

	$wp_customize->add_control('about_counter3_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('about Counter 3'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('about_counter3_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'CARRER TestimonialS',
	));

	$wp_customize->add_control('about_counter3_text_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('about Counter Text 3'),
		// 		'description' => __('Enter text of not more than 35 Words.'),
	));

	// home counter 4 settings 
	$wp_customize->add_setting('about_counter4_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '100+',
	));

	$wp_customize->add_control('about_counter4_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('about Counter 4'),
		// 		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('about_counter4_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'EVENT & QUIZZES',
	));

	$wp_customize->add_control('about_counter4_text_setting', array(
		'type' => 'text',
		'section' => 'about_counter_sec',
		'label' => __('about Counter Text 4'),
		// 		'description' => __('Enter text of not more than 35 Words.'),
	));


	// Team section 

	$wp_customize->add_section('about_team_section', array(
		'title'       => __('About Page: Team Section', 'your-theme-slug'),
		'priority'    => 30,
		'panel'    => 'about_panel',
		'description' => __('Customize the About page Team section content and images.'),
	));

	// Heading (small)
	$wp_customize->add_setting('about_team_small_heading', array(
		'default'   => 'meet our team',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team_small_heading', array(
		'label'    => __('Small Heading', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'type'     => 'text',
	));

	// Heading (main)
	$wp_customize->add_setting('about_team_main_heading', array(
		'default'   => 'Experts at Video Editing Training Institute in Delhi',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team_main_heading', array(
		'label'    => __('Main Heading', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'type'     => 'text',
	));

	// Team Images
	// Add 6 image settings and controls
	// image 1 
	$wp_customize->add_setting('about_team__image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('\images\Promila-Mam.webp'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_team__image1', array(
		'label' => 'Upload Team 1',
		'priority' => 20,
		'section' => 'about_team_section',
		'settings' => 'about_team__image1',
	)));

	// Heading (H3)
	$wp_customize->add_setting('about_team1_h3', array(
		'default'   => 'Name',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team1_h3', array(
		'label'    => __('H3 Heading', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));


	// span
	$wp_customize->add_setting('about_team1_span', array(
		'default'   => 'post',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team1_span', array(
		'label'    => __('Post span', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));

	// paragrapgh
	$wp_customize->add_setting('about_team1_para', array(
		'default'   => 'Experience',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team1_para', array(
		'label'    => __('Experience paragrapgh', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));

	// image 2 
	$wp_customize->add_setting('about_team__image2', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('\images\Promila-Mam.webp'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_team__image2', array(
		'label' => 'Upload Team 2',
		'priority' => 20,
		'section' => 'about_team_section',
		'settings' => 'about_team__image2',
	)));

	// Heading (H3)
	$wp_customize->add_setting('about_team2_h3', array(
		'default'   => 'Name',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team2_h3', array(
		'label'    => __('H3 Heading', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));


	// span
	$wp_customize->add_setting('about_team2_span', array(
		'default'   => 'post',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team2_span', array(
		'label'    => __('Post span', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));

	// paragrapgh
	$wp_customize->add_setting('about_team2_para', array(
		'default'   => 'Experience',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team2_para', array(
		'label'    => __('Experience paragrapgh', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));
	// image 3
	$wp_customize->add_setting('about_team__image3', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('../images\Promila-Mam.webp'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_team__image3', array(
		'label' => 'Upload Team 3',
		'priority' => 20,
		'section' => 'about_team_section',
		'settings' => 'about_team__image3',
	)));

	// Heading (H3)
	$wp_customize->add_setting('about_team3_h3', array(
		'default'   => 'Name',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team3_h3', array(
		'label'    => __('H3 Heading', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));
	// span
	$wp_customize->add_setting('about_team3_span', array(
		'default'   => 'post',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team3_span', array(
		'label'    => __('Post span', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));

	// paragrapgh
	$wp_customize->add_setting('about_team3_para', array(
		'default'   => 'Experience',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team3_para', array(
		'label'    => __('Experience paragrapgh', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));
	// image 4 
	$wp_customize->add_setting('about_team__image4', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('\images\Promila-Mam.webp'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_team__image4', array(
		'label' => 'Upload Team 4',
		'priority' => 20,
		'section' => 'about_team_section',
		'settings' => 'about_team__image4',
	)));
	// Heading (H3)
	$wp_customize->add_setting('about_team4_h3', array(
		'default'   => 'Name',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team4_h3', array(
		'label'    => __('H3 Heading', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));
	// span
	$wp_customize->add_setting('about_team4_span', array(
		'default'   => 'post',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team4_span', array(
		'label'    => __('Post span', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));

	// paragrapgh
	$wp_customize->add_setting('about_team4_para', array(
		'default'   => 'Experience',
		'transport' => 'refresh',
	));

	$wp_customize->add_control('about_team4_para', array(
		'label'    => __('Experience paragrapgh', 'your-theme-slug'),
		'section'  => 'about_team_section',
		'priority' => 20,
		'type'     => 'text',
	));

	// image 5 
	// $wp_customize->add_setting('about_team__image5', array(
	// 	'capability'        => 'edit_theme_options',
	// 	'default' => get_theme_file_uri('\images\Promila-Mam.webp'),
	// ));

	// $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_team__image5', array(
	// 	'label' => 'Upload Team 5',
	// 	'priority' => 20,
	// 	'section' => 'about_team_section',
	// 	'settings' => 'about_team__image5',
	// )));
	// Heading (H3)
	// $wp_customize->add_setting('about_team5_h3', array(
	// 	'default'   => 'Name',
	// 	'transport' => 'refresh',
	// ));

	// $wp_customize->add_control('about_team5_h3', array(
	// 	'label'    => __('H3 Heading', 'your-theme-slug'),
	// 	'section'  => 'about_team_section',
	// 	'type'     => 'text',
	// ));

	// image 6 
	// $wp_customize->add_setting('about_team__image6', array(
	// 	'capability'        => 'edit_theme_options',
	// 	'default' => get_theme_file_uri('\images\Promila-Mam.webp'),
	// ));

	// $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_team__image6', array(
	// 	'label' => 'Upload Team 6',
	// 	'priority' => 20,
	// 	'section' => 'about_team_section',
	// 	'settings' => 'about_team__image6',
	// )));
	// Heading (H3)
	// $wp_customize->add_setting('about_team6_h3', array(
	// 	'default'   => 'Name',
	// 	'transport' => 'refresh',
	// ));

	// $wp_customize->add_control('about_team6_h3', array(
	// 	'label'    => __('H3 Heading', 'your-theme-slug'),
	// 	'section'  => 'about_team_section',
	// 	'type'     => 'text',
	// ));



	// aboutus Section Button Text Setting
	$wp_customize->add_setting('aboutus_team_button_text', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));


	$wp_customize->add_control('aboutus_team_button_text', array(
		'type'        => 'text',
		'section'     => 'about_team_section', // your existing section ID
		'priority' => 20,
		'label'       => __('Button Text', 'prolific-theme'),
		'description' => __('Enter text for the Team section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('aboutus_team_button_url', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('aboutus_team_button_url', array(
		'type'        => 'url',
		'section'     => 'about_team_section',
		'priority' => 20,
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in Team section.', 'prolific-theme'),
	));

	// About Testimonial 

	$wp_customize->add_section('about_testimonial_section', array(
		'title'       => __('Testimonial  Banner Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'about_panel',
		'description' => __('Customize the layout of your Testimonial  Banner ', 'prolific-theme')
	));
	$wp_customize->add_setting('about_testimonial_banner_text', array(
		'capability' => 'edit_theme_options',
		'default' => 'TESTIMONIALS ',
	));

	$wp_customize->add_control('about_testimonial_banner_text', array(
		'type' => 'text',
		'section' => 'about_testimonial_section',
		'label' => __('Testimonial Banner Title', 'prolific-theme'),
		'description' => __('Enter Page title ', 'prolific-theme'),
	));

	//second line of banner
	$wp_customize->add_setting('testimonials_banner_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Students Experience At Video Editing Institute',

	));

	$wp_customize->add_control('testimonials_banner_subtext_setting', array(
		'type' => 'text',
		'section' => 'about_testimonial_section',
		'label' => __('Testimonial Banner Text', 'prolific-theme'),
		'description' => __('Enter text of not more than 35 Words.', 'prolific-theme'),
	));


	// Testimonial Section Button Text Setting
	$wp_customize->add_setting('aboutus_Testimonial_button_text', array(
		'capability'        => 'edit_theme_options',
		'default'           => 'Explore Courses', // default button text
		'sanitize_callback' => 'sanitize_text_field',
	));


	$wp_customize->add_control('aboutus_Testimonial_button_text', array(
		'type'        => 'text',
		'section'     => 'about_testimonial_section', // your existing section ID
		'priority' => 20,
		'label'       => __('Button Text', 'prolific-theme'),
		'description' => __('Enter text for the TESTIMONIAL section button.', 'prolific-theme'),
	));

	// ✅ Button URL Setting
	$wp_customize->add_setting('aboutus_Testimonial_button_url', array(
		'capability'        => 'edit_theme_options',
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('aboutus_Testimonial_button_url', array(
		'type'        => 'url',
		'section'     => 'about_testimonial_section',
		'priority' => 20,
		'label'       => __('Button Link / URL', 'prolific-theme'),
		'description' => __('Enter the link for the button in TESTIMONIAL section.', 'prolific-theme'),
	));
}

add_action('customize_register', 'about_content');



// testimonial starts here 

function testimonial_banner_content($wp_customize)
{
	$wp_customize->add_panel('testimonial_panel', array(
		'title' => 'Testimonials Panel',
		'description' => 'This is testimonial panel ',
		'priority' => 10,
	));

	$wp_customize->add_section('testimonial_banner_text_sec', array(
		'title'       => __('Testimonial  Banner Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Customize the layout of your Testimonial  Banner ', 'prolific-theme')
	));
	$wp_customize->add_setting('testimonial_banner_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial ',
	));

	$wp_customize->add_control('testimonial_banner_text_setting', array(
		'type' => 'text',
		'section' => 'testimonial_banner_text_sec',
		'label' => __('Testimonial Banner Title'),
		'description' => __('Enter Page title '),
	));

	//second line of banner
	$wp_customize->add_setting('testimonial_banner_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Read latest articles at Video Editing Institute on useful topics like photo editing, color grading, video editing, color corrections, chrome keying, etc.',
	));

	$wp_customize->add_control('testimonial_banner_subtext_setting', array(
		'type' => 'text',
		'section' => 'testimonial_banner_text_sec',
		'label' => __('Testimonial  Banner Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));



	// first testimonial 
	$wp_customize->add_section('first_testimonial_text_sec', array(
		'title'       => __('First Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is first  testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('first_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('first_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'first_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//second line of text 
	$wp_customize->add_setting('first_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('first_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'first_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('first_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('first_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'first_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//fourth   line of slider
	$wp_customize->add_setting('first_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('first_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'first_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('first_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'first_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'first_testimonial_text_sec',
		'settings' => 'first_testimonial_image1',
	)));

	$wp_customize->add_setting('first_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('first_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'first_testimonial_text_sec',
		'settings' => 'first_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));


	// second testimonial 

	$wp_customize->add_section('second_testimonial_text_sec', array(
		'title'       => __('Second Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Second testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('second_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('second_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'second_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//second line of text 
	$wp_customize->add_setting('second_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('second_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'second_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('second_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('second_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'second_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//fourth   line of slider
	$wp_customize->add_setting('second_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('second_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'second_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('second_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'second_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'second_testimonial_text_sec',
		'settings' => 'second_testimonial_image1',
	)));

	$wp_customize->add_setting('second_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('second_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'second_testimonial_text_sec',
		'settings' => 'second_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));


	// third testimonial 

	$wp_customize->add_section('third_testimonial_text_sec', array(
		'title'       => __('Third Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Third testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('third_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('third_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'third_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('third_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('third_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'third_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('third_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('third_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'third_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//fourth   line of slider
	$wp_customize->add_setting('third_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('third_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'third_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('third_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'third_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'third_testimonial_text_sec',
		'settings' => 'third_testimonial_image1',
	)));

	$wp_customize->add_setting('third_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('third_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'third_testimonial_text_sec',
		'settings' => 'third_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));



	// fourth  testimonial 

	$wp_customize->add_section('fourth_testimonial_text_sec', array(
		'title'       => __('Fourth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Fourth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('fourth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('fourth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'fourth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('fourth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('fourth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'fourth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('fourth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('fourth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'fourth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//fourth   line of slider
	$wp_customize->add_setting('fourth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('fourth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'fourth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('fourth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fourth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'fourth_testimonial_text_sec',
		'settings' => 'fourth_testimonial_image1',
	)));

	$wp_customize->add_setting('fourth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('fourth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'fourth_testimonial_text_sec',
		'settings' => 'fourth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));




	// fifth  testimonial 

	$wp_customize->add_section('fifth_testimonial_text_sec', array(
		'title'       => __('Fifth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Fifth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('fifth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('fifth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'fifth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('fifth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('fifth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'fifth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('fifth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('fifth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'fifth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth   line of slider
	$wp_customize->add_setting('fifth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('fifth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'fifth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('fifth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fifth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'fifth_testimonial_text_sec',
		'settings' => 'fifth_testimonial_image1',
	)));

	$wp_customize->add_setting('fifth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('fifth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'fifth_testimonial_text_sec',
		'settings' => 'fifth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));



	// sixth  testimonial 

	$wp_customize->add_section('sixth_testimonial_text_sec', array(
		'title'       => __('Sixth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Sixth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('sixth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('sixth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'sixth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('sixth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('sixth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'sixth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('sixth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('sixth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'sixth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth   line of slider
	$wp_customize->add_setting('sixth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('sixth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'sixth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('sixth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sixth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'sixth_testimonial_text_sec',
		'settings' => 'sixth_testimonial_image1',
	)));

	$wp_customize->add_setting('sixth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('sixth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'sixth_testimonial_text_sec',
		'settings' => 'sixth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));




	// seventh  testimonial 

	$wp_customize->add_section('seventh_testimonial_text_sec', array(
		'title'       => __('Seventh Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Seventh Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('seventh_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('seventh_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'seventh_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('seventh_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('seventh_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'seventh_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('seventh_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('seventh_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'seventh_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth   line of slider
	$wp_customize->add_setting('seventh_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('seventh_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'seventh_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('seventh_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'seventh_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'seventh_testimonial_text_sec',
		'settings' => 'seventh_testimonial_image1',
	)));

	$wp_customize->add_setting('seventh_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('seventh_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'seventh_testimonial_text_sec',
		'settings' => 'seventh_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));




	// eight  testimonial 

	$wp_customize->add_section('eight_testimonial_text_sec', array(
		'title'       => __('Eight Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Eight Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('eight_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('eight_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'eight_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('eight_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('eight_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'eight_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('eight_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('eight_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'eight_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('eight_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('eight_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'eight_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('eight_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'eight_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'eight_testimonial_text_sec',
		'settings' => 'eight_testimonial_image1',
	)));


	$wp_customize->add_setting('eight_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('eight_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'eight_testimonial_text_sec',
		'settings' => 'eight_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// ninth  testimonial 

	$wp_customize->add_section('ninth_testimonial_text_sec', array(
		'title'       => __('Ninth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Ninth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('ninth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('ninth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'ninth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('ninth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('ninth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'ninth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('ninth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('ninth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'ninth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('ninth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('ninth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'ninth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('ninth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ninth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'ninth_testimonial_text_sec',
		'settings' => 'ninth_testimonial_image1',
	)));


	$wp_customize->add_setting('ninth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('ninth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'ninth_testimonial_text_sec',
		'settings' => 'ninth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// tenth  testimonial 

	$wp_customize->add_section('tenth_testimonial_text_sec', array(
		'title'       => __('Tenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Tenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('tenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('tenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'tenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('tenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('tenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'tenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('tenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('tenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'tenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('tenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('tenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'tenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('tenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'tenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'tenth_testimonial_text_sec',
		'settings' => 'tenth_testimonial_image1',
	)));


	$wp_customize->add_setting('tenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('tenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'tenth_testimonial_text_sec',
		'settings' => 'tenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// eleventh  testimonial 

	$wp_customize->add_section('eleventh_testimonial_text_sec', array(
		'title'       => __('Eleventh Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Eleventh Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('eleventh_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('eleventh_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'eleventh_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('eleventh_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('eleventh_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'eleventh_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('eleventh_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('eleventh_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'eleventh_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('eleventh_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('eleventh_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'eleventh_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('eleventh_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'eleventh_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'eleventh_testimonial_text_sec',
		'settings' => 'eleventh_testimonial_image1',
	)));


	$wp_customize->add_setting('eleventh_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('eleventh_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'eleventh_testimonial_text_sec',
		'settings' => 'eleventh_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// twelth  testimonial 

	$wp_customize->add_section('twelth_testimonial_text_sec', array(
		'title'       => __('Twelth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Twelth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('twelth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('twelth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'twelth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('twelth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('twelth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'twelth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('twelth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('twelth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'twelth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('twelth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('twelth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'twelth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('twelth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'twelth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'twelth_testimonial_text_sec',
		'settings' => 'twelth_testimonial_image1',
	)));


	$wp_customize->add_setting('twelth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('twelth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'twelth_testimonial_text_sec',
		'settings' => 'twelth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// thirteenth  testimonial 

	$wp_customize->add_section('thirteenth_testimonial_text_sec', array(
		'title'       => __('Thirteenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Thirteenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('thirteenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('thirteenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'thirteenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('thirteenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('thirteenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'thirteenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('thirteenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('thirteenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'thirteenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('thirteenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('thirteenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'thirteenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('thirteenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'thirteenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'thirteenth_testimonial_text_sec',
		'settings' => 'thirteenth_testimonial_image1',
	)));


	$wp_customize->add_setting('thirteenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('thirteenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'thirteenth_testimonial_text_sec',
		'settings' => 'thirteenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// fourteenth  testimonial 

	$wp_customize->add_section('fourteenth_testimonial_text_sec', array(
		'title'       => __('Fourteenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Fourteenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('fourteenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('fourteenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'fourteenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('fourteenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('fourteenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'fourteenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('fourteenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('fourteenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'fourteenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('fourteenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('fourteenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'fourteenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('fourteenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fourteenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'fourteenth_testimonial_text_sec',
		'settings' => 'fourteenth_testimonial_image1',
	)));


	$wp_customize->add_setting('fourteenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('fourteenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'fourteenth_testimonial_text_sec',
		'settings' => 'fourteenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// fifteenth  testimonial 

	$wp_customize->add_section('fifteenth_testimonial_text_sec', array(
		'title'       => __('Fifteenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Fifteenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('fifteenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('fifteenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'fifteenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('fifteenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('fifteenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'fifteenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('fifteenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('fifteenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'fifteenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('fifteenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('fifteenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'fifteenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('fifteenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fifteenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'fifteenth_testimonial_text_sec',
		'settings' => 'fifteenth_testimonial_image1',
	)));


	$wp_customize->add_setting('fifteenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('fifteenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'fifteenth_testimonial_text_sec',
		'settings' => 'fifteenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// sixteenth  testimonial 

	$wp_customize->add_section('sixteenth_testimonial_text_sec', array(
		'title'       => __('Sixteenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Sixteenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('sixteenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('sixteenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'sixteenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('sixteenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('sixteenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'sixteenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('sixteenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('sixteenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'sixteenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('sixteenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('sixteenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'sixteenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('sixteenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sixteenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'sixteenth_testimonial_text_sec',
		'settings' => 'sixteenth_testimonial_image1',
	)));


	$wp_customize->add_setting('sixteenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('sixteenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'sixteenth_testimonial_text_sec',
		'settings' => 'sixteenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// seventeenth  testimonial 

	$wp_customize->add_section('seventeenth_testimonial_text_sec', array(
		'title'       => __('Seventeenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Seventeenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('seventeenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('seventeenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'seventeenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('seventeenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('seventeenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'seventeenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('seventeenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('seventeenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'seventeenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('seventeenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('seventeenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'seventeenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('seventeenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'seventeenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'seventeenth_testimonial_text_sec',
		'settings' => 'seventeenth_testimonial_image1',
	)));


	$wp_customize->add_setting('seventeenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('seventeenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'seventeenth_testimonial_text_sec',
		'settings' => 'seventeenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// eighteenth  testimonial 

	$wp_customize->add_section('eighteenth_testimonial_text_sec', array(
		'title'       => __('Eighteenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Eighteenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('eighteenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('eighteenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'eighteenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('eighteenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('eighteenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'eighteenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('eighteenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('eighteenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'eighteenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('eighteenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('eighteenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'eighteenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('eighteenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'eighteenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'eighteenth_testimonial_text_sec',
		'settings' => 'eighteenth_testimonial_image1',
	)));


	$wp_customize->add_setting('eighteenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('eighteenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'eighteenth_testimonial_text_sec',
		'settings' => 'eighteenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// nineteenth  testimonial 

	$wp_customize->add_section('nineteenth_testimonial_text_sec', array(
		'title'       => __('Nineteenth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Nineteenth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('nineteenth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('nineteenth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'nineteenth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('nineteenth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('nineteenth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'nineteenth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('nineteenth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('nineteenth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'nineteenth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('nineteenth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('nineteenth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'nineteenth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('nineteenth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'nineteenth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'nineteenth_testimonial_text_sec',
		'settings' => 'nineteenth_testimonial_image1',
	)));


	$wp_customize->add_setting('nineteenth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('nineteenth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'nineteenth_testimonial_text_sec',
		'settings' => 'nineteenth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));





	// twentieth  testimonial 

	$wp_customize->add_section('twentieth_testimonial_text_sec', array(
		'title'       => __('Twentieth Testimonial Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'		 => 'testimonial_panel',
		'description' => __('Here is Twentieth Testimonial  ', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('twentieth_testimonial_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'name: rishikesh kushvaha',
	));
	$wp_customize->add_control('twentieth_testimonial_text_setting', array(
		'type' => 'text',
		'section' => 'twentieth_testimonial_text_sec',
		'label' => __('Add Name'),
		'description' => __('Enter Name of not more than 15 Words.'),
	));

	//third line of text 
	$wp_customize->add_setting('twentieth_testimonial_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Testimonial Applied: Post Production Premium',
	));

	$wp_customize->add_control('twentieth_testimonial_subtext_setting', array(
		'type' => 'text',
		'section' => 'twentieth_testimonial_text_sec',
		'label' => __('Add Testimonial Applied For'),
		'description' => __('Enter Testimonial name here'),
	));
	//third  line of slider
	$wp_customize->add_setting('twentieth_testimonial_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Job: Video Editor (TIOL TUBE)',
	));

	$wp_customize->add_control('twentieth_testimonial_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'twentieth_testimonial_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));

	//forth line of slider 
	$wp_customize->add_setting('twentieth_testimonial_third_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'I did post production Testimonial from this institute and I want to say that it is a place where
		you can come and join any of the Testimonial that they offer with full confidence. The staff is
		very cooperative and helpful . Currently I am placed with 3 lakhs+ pay package.',
	));

	$wp_customize->add_control('twentieth_testimonial_third_subtext_setting', array(
		'type' => 'text',
		'section' => 'twentieth_testimonial_text_sec',
		'label' => __('Add Description '),
		'description' => __('Enter Description here '),
	));

	//testimonial image change
	$wp_customize->add_setting('twentieth_testimonial_image1', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('./images/male-videographer-edits-and-cuts-footage-and-sound-on-his-person-1.jpg'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'twentieth_testimonial_image_control', array(
		'label' => 'Upload Photo ',
		'priority' => 20,
		'section' => 'twentieth_testimonial_text_sec',
		'settings' => 'twentieth_testimonial_image1',
	)));


	$wp_customize->add_setting('twentieth_testimonial_display', array(
		'default'     => true,
		'transport'   => 'refresh',
	));

	$wp_customize->add_control('twentieth_testimonial_display', array(
		'label' => 'Button Display',
		'section' => 'twentieth_testimonial_text_sec',
		'settings' => 'twentieth_testimonial_display',
		'type' => 'radio',
		'choices' => array(
			'show' => 'Show Button',
			'hide' => 'Hide Button',
		),
	));
}
add_action('customize_register', 'testimonial_banner_content');

// All courses page 
// all courses Panel 
function courses_content($wp_customize)
{
	$wp_customize->add_panel('all_courses_panel', array(
		'title' => 'All courses  ',
		'description' => 'This is panel Description',
		'priority' => 10,
	));

	// all_courses_panel banner section 
	$wp_customize->add_section('allcourses_banner', array(
		'title'       => __('all courses Banner Settings', 'prolific-theme'),
		'priority'    => 10,
		'panel'		  => 'all_courses_panel',
		'description' => __('Customize the layout of your All courses Banner ', 'prolific-theme')
	));
	$wp_customize->add_setting('allcourses_banner_text_sec', array(
		'capability' => 'edit_theme_options',
		'default' => 'All courses',
	));

	$wp_customize->add_control('allcourses_banner_text_sec', array(
		'type' => 'text',
		'section' => 'allcourses_banner',
		'label' => __('all courses Banner Title'),
		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('allcourses_bg_image', array(
		'default'   => get_template_directory_uri() . '/images/default-bg.jpg',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'allcourses_bg_image', array(
		'label'    => __('All all Courses Banner Section Background Image', 'your-theme-slug'),
		'section'  => 'allcourses_banner',
		'settings' => 'allcourses_bg_image',
	)));

	$wp_customize->add_setting('allcourses_banner_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Read latest articles at Video Editing Institute on useful topics like photo editing, color
                            grading, video editing, color corrections, chrome keying, etc.',
	));

	$wp_customize->add_control('allcourses_banner_subtext_setting', array(
		'type' => 'text',
		'section' => 'allcourses_banner',
		'label' => __('Courses Banner Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));
}

add_action('customize_register', 'courses_content');



// Aritcal page 
function artical_content($wp_customize)
{
	$wp_customize->add_panel('all_artical_panel', array(
		'title' => 'All artical  ',
		'description' => 'This is panel Description',
		'priority' => 10,
	));

	// all_artical_panel banner section 
	$wp_customize->add_section('allartical_banner', array(
		'title'       => __('all Artical Banner Settings', 'prolific-theme'),
		'priority'    => 10,
		'panel'		  => 'all_artical_panel',
		'description' => __('Customize the layout of your All Artical Banner ', 'prolific-theme')
	));
	$wp_customize->add_setting('allartical_banner_text_sec', array(
		'capability' => 'edit_theme_options',
		'default' => 'All Artical',
	));

	$wp_customize->add_control('allartical_banner_text_sec', array(
		'type' => 'text',
		'section' => 'allartical_banner',
		'label' => __('all Artical Banner Title'),
		'description' => __('Enter Page title '),
	));

	$wp_customize->add_setting('allartical_banner_subtext_sec', array(
		'capability' => 'edit_theme_options',
		'default' => 'Read latest articles at Video Editing Institute on useful topics like photo editing, color
                            grading, video editing, color corrections, chrome keying, etc.',
	));

	$wp_customize->add_control('allartical_banner_subtext_sec', array(
		'type' => 'text',
		'section' => 'allartical_banner',
		'label' => __('All Artical Banner Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	$wp_customize->add_setting('allartical_bg_image', array(
		'default'   => get_template_directory_uri() . '/images/default-bg.jpg',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'allartical_bg_image', array(
		'label'    => __('All  Artical Banner Section Background Image', 'your-theme-slug'),
		'section'  => 'allartical_banner',
		'settings' => 'allartical_bg_image',
	)));
}

add_action('customize_register', 'artical_content');


// contact us page 

function contact_banner_content($wp_customize) {}
add_action('customize_register', 'contact_banner_content');

// contact page panel 
function contactus_panel($wp_customize)
{

	$wp_customize->add_panel('contact_us_panel', array(
		'title' => 'Contact Us Page Panel',
		'description' => 'This is contact page panel ',
		'priority' => 10,
	));

	// contact banner text settings 

	$wp_customize->add_section('contact_banner_text_sec', array(
		'title'       => __('Contact Us Banner Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'contact_us_panel',
		'description' => __('Customize the layout of your Contact Us Banner ', 'prolific-theme')
	));
	$wp_customize->add_setting('contact_banner_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Contact Us',
	));

	$wp_customize->add_control('contact_banner_text_setting', array(
		'type' => 'text',
		'section' => 'contact_banner_text_sec',
		'label' => __('Contact Us Banner Title'),
		'description' => __('Enter Page title '),
	));

	//second line of banner
	$wp_customize->add_setting('contact_banner_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Get in touch and let us know how we can help.',
	));

	$wp_customize->add_control('contact_banner_subtext_setting', array(
		'type' => 'text',
		'section' => 'contact_banner_text_sec',
		'label' => __('Contact Us Banner Text'),
		'description' => __('Enter text of not more than 35 Words.'),
	));



	// get in touch text setting 
	$wp_customize->add_section('getintouch_text_sec', array(
		'title'       => __('Contact Page Get in touch Setting', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'contact_us_panel',
		'description' => __('Here is get in touch section', 'prolific-theme')
	));
	// first line of text 

	$wp_customize->add_setting('getintouch_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'GET IN TOUCH',
	));
	$wp_customize->add_control('getintouch_text_setting', array(
		'type' => 'text',
		'section' => 'getintouch_text_sec',
		'label' => __('Add Heading'),
		'description' => __('Enter heading of not more than 15 Words.'),
	));

	//second line of text 
	$wp_customize->add_setting('getintouch_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Have Any Questions?',
	));

	$wp_customize->add_control('getintouch_subtext_setting', array(
		'type' => 'text',
		'section' => 'getintouch_text_sec',
		'label' => __('Third line of text'),
		'description' => __('Enter third line of text here'),
	));
	//third  line 
	$wp_customize->add_setting('getintouch_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Contact for Video Editing Testimonials in Rohini',
	));

	$wp_customize->add_control('getintouch_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'getintouch_text_sec',
		'label' => __('Add Job '),
		'description' => __('Enter job here '),
	));


	// get in touch cards setting 
	$wp_customize->add_section('cards_text_sec', array(
		'title'       => __('Contact Us First Card Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'contact_us_panel',
		'description' => __('Customize the cards of  your Contact Us page ', 'prolific-theme')
	));

	// first card 
	$wp_customize->add_setting('cards1_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'location',
	));

	$wp_customize->add_control('cards1_text_setting', array(
		'type' => 'text',
		'section' => 'cards_text_sec',
		'label' => __('Enter Card One Heading'),
		'description' => __('Enter heading of address card '),
	));

	//second line of card
	$wp_customize->add_setting('cards1_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Block C-9/15, 4th Floor, Opposite Metro Pillar No 399, Sector- 7, New Delhi - India',
	));

	$wp_customize->add_control('cards1_subtext_setting', array(
		'type' => 'text',
		'section' => 'cards_text_sec',
		'label' => __('Enter Address Here'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	//contact page cards image change
	$wp_customize->add_setting('cards1_image', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('icon/1-prf8xm6pl0z5mk8arkrb6mfrqerges7zffd0odlclc.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cards_image1_control', array(
		'label' => 'Upload Icon ',
		'priority' => 20,
		'section' => 'cards_text_sec',
		'settings' => 'cards1_image',
	)));

	// second card 

	$wp_customize->add_section('cards2_text_sec', array(
		'title'       => __('Contact Us Second Card Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'contact_us_panel',
		'description' => __('Customize the cards of  your Contact Us page ', 'prolific-theme')
	));


	$wp_customize->add_setting('cards2_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Email Us',
	));

	$wp_customize->add_control('cards2_text_setting', array(
		'type' => 'text',
		'section' => 'cards2_text_sec',
		'label' => __('Enter Card Two Heading'),
		'description' => __('Enter heading of address card '),
	));

	//second line of card
	$wp_customize->add_setting('cards2_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'info@admec.co.in',
	));

	$wp_customize->add_control('cards2_subtext_setting', array(
		'type' => 'text',
		'section' => 'cards2_text_sec',
		'label' => __('Enter Email Here'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	//contact page cards image change
	$wp_customize->add_setting('cards2_image', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('icon/3-prf95mr5v5y6mul4yjhry3ma3p951v1kv3n30bphj4.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cards_image2_control', array(
		'label' => 'Upload Icon ',
		'priority' => 20,
		'section' => 'cards2_text_sec',
		'settings' => 'cards2_image',
	)));

	// third card 
	$wp_customize->add_section('cards3_text_sec', array(
		'title'       => __('Contact Us Third Card Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'contact_us_panel',
		'description' => __('Customize the cards of  your Contact Us page ', 'prolific-theme')
	));


	$wp_customize->add_setting('cards3_text_setting', array(
		'capability' => 'edit_theme_options',
		'default' => 'Call Us	',
	));

	$wp_customize->add_control('cards3_text_setting', array(
		'type' => 'text',
		'section' => 'cards3_text_sec',
		'label' => __('Enter Card Three Heading'),
		'description' => __('Enter heading of Phone Number Card '),
	));

	//second line of card
	$wp_customize->add_setting('cards3_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '+91-9811-818-122',
	));

	$wp_customize->add_control('cards3_subtext_setting', array(
		'type' => 'text',
		'section' => 'cards3_text_sec',
		'label' => __('Enter First Mobile No Here'),
		'description' => __('Enter text of not more than 35 Words.'),
	));
	//third line of card
	$wp_customize->add_setting('cards3_second_subtext_setting', array(
		'capability' => 'edit_theme_options',
		'default' => '+91-9911-782-350',
	));

	$wp_customize->add_control('cards3_second_subtext_setting', array(
		'type' => 'text',
		'section' => 'cards3_text_sec',
		'label' => __('Enter Second Mobile No Here'),
		'description' => __('Enter text of not more than 35 Words.'),
	));

	//contact page cards image change
	$wp_customize->add_setting('cards3_image', array(
		'capability'        => 'edit_theme_options',
		'default' => get_theme_file_uri('icon/3-prf95mr5v5y6mul4yjhry3ma3p951v1kv3n30bphj4.png'),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cards_image3_control', array(
		'label' => 'Upload Icon ',
		'priority' => 20,
		'section' => 'cards3_text_sec',
		'settings' => 'cards3_image',
	)));



	// contact us 

	$wp_customize->add_section('contact_us_form', array(
		'title'       => __('Contact Us Form Settings', 'prolific-theme'),
		'priority'    => 30,
		'panel'    => 'contact_us_panel',
		'description' => __('Customize the layout of your Contact Us Form ', 'prolific-theme')
	));
	$wp_customize->add_setting('contact_us_form_title', array(
		'capability' => 'edit_theme_options',
		'default' => 'Send us a message',
	));

	$wp_customize->add_control('contact_us_form_title', array(
		'type' => 'text',
		'section' => 'contact_us_form',
		'label' => __('Contact Us Form Title'),
		'description' => __('Enter form title '),
	));

	$wp_customize->add_setting('contact_us_form_paragraph', array(
		'capability' => 'edit_theme_options',
		'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                            ullamcorper mattis, pulvinar dapibus leo.',
	));

	$wp_customize->add_control('contact_us_form_paragraph', array(
		'type' => 'text',
		'section' => 'contact_us_form',
		'label' => __('Contact Us Form Paragraph'),
		'description' => __('Enter form title '),
	));

	// Contact Form Shortcode Field
	$wp_customize->add_setting('contact_us_form_shortcode', array(
		'capability'        => 'edit_theme_options',
		'default'           => '[contact-form-7 id="28d8d8e" title="Contact Us Form"]', // Default example
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('contact_us_form_shortcode', array(
		'type'        => 'text',
		'section'     => 'contact_us_form',
		'label'       => __('Contact Form 7 Shortcode'),
		'description' => __('Paste your Contact Form 7 shortcode here (e.g., [contact-form-7 id="28d8d8e" title="Contact Us Form"])'),
	));
}
add_action('customize_register', 'contactus_panel');

// template testing
add_action('wp_footer', function () {
	if (current_user_can('administrator')) {
		echo '<p style="position: fixed; bottom: 10px; left: 10px; background: black; color: white; padding: 5px 10px; font-size: 14px; z-index: 9999;">Template: ' . basename(get_page_template()) . '</p>';
	}
});


?>