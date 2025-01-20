<?php

/*Setup Theme */
if (!function_exists('aum_theme_setup')) {

	function aum_theme_setup()
	{
		//SEO Titles
		add_theme_support('title-tag');

		//Enable featured images
		add_theme_support('post-thumbnails', array('post', 'page', 'maestros', 'tribe_events'), 11);

		//Add custom sized images
		add_image_size('square', 350, 350, true);
		add_image_size('portrait', 350, 724, true);
		add_image_size('boxes', 400, 375, true);
		add_image_size('blog', 966, 644, true);
		add_image_size('cover', 1400, 600, true);

		//Habilitar Logo Personalizado
		$defaults = array(
			'height'               => 100,
			'width'                => 400,
			'flex-height'          => true,
			'flex-width'           => true,
			'unlink-homepage-logo' => true,
		);

		add_theme_support('custom-logo', $defaults);

		//Soporte a Tipografias
		add_theme_support('appearance-tools');

		//Soporte a Tamaños de Fuente
		add_theme_support('editor-font-sizes', array(
			array(
				'name' => esc_attr__(
					'Small',
					'aum_theme'
				),
				'size' => 12,
				'slug' => 'small'
			),
			array(
				'name' => esc_attr__(
					'Regular',
					'aum_theme'
				),
				'size' => 16,
				'slug' => 'regular'
			),
			array(
				'name' => esc_attr__(
					'Medium',
					'aum_theme'
				),
				'size' => 18,
				'slug' => 'medium'
			),
			array(
				'name' => esc_attr__(
					'Large',
					'aum_theme'
				),
				'size' => 22,
				'slug' => 'large'
			),
			array(
				'name' => esc_attr__(
					'Extra Large',
					'aum_theme'
				),
				'size' => 28,
				'slug' => 'xl'
			),
			array(
				'name' => esc_attr__(
					'Huge',
					'aum_theme'
				),
				'size' => 32,
				'slug' => 'xl'
			)
		));


		// Soporte a Colores
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __(
						'Primary Color',
						'aum_theme'
					),
					'slug'  => 'primary-color',
					'color' => '#2065B2',
				),
				array(
					'name'  => __(
						'Scondary Color',
						'aum_theme'
					),
					'slug'  => 'secondary-color',
					'color' => '#2D5DFE',
				),
				array(
					'name'  => __(
						'Tertiary Color',
						'aum_theme'
					),
					'slug'  => 'tertiary-color',
					'color' => '#CBE3FF',
				),
				array(
					'name'  => __(
						'Primary Complementary Color',
						'aum_theme'
					),
					'slug'  => 'primary-complementary-color',
					'color' => '#FE9C2D',
				),
				array(
					'name'  => __(
						'Secondary Complementary Color',
						'aum_theme'
					),
					'slug'  => 'secondary-complementary-color',
					'color' => '#B26D20',
				),
				array(
					'name'  => __(
						'Text Color',
						'aum_theme '
					),
					'slug'  => 'text-color',
					'color' => '#46464F',
				),
			)
		);

		register_nav_menus(
			array(
				'main_menu' => esc_html__('Main menu', 'aum_theme'),
				'orgs_links_menu' => esc_html__('Enlace con Otras Organizaciones', 'aum_theme'),
				'footer_menu_first'  => __('Footer menu first', 'aum_theme'),
				'footer_menu_second'  => __('Footer menu second', 'aum_theme'),
			)
		);
	}
}

add_action('after_setup_theme', 'aum_theme_setup');

/**
 * Enqueue scripts and styles.
 *
 *
 * @return void
 */
function aum_theme_scripts()
{
	// Load jQuery on the footer to eliminate render-blocking resources.
	wp_scripts()->add_data('jquery', 'group', 1);
	wp_scripts()->add_data('jquery-core', 'group', 1);
	wp_scripts()->add_data('jquery-migrate', 'group', 1);

	// Global stylesheet.
	wp_enqueue_style('swipercss', get_template_directory_uri() . "/build/css/imports/swiper.css", array(), '10.2.0');
	wp_enqueue_style('aum-theme-fonts', get_template_directory_uri() . "/assets/fonts/fonts.css", array(), '1.0');
	wp_enqueue_style('aum-theme-main-stylesheet', get_template_directory_uri() . "/build/css/main-style.css", array('aum-theme-fonts', 'swipercss'), '1.0', 'all');

	// Main JS scripts.
	wp_enqueue_script('swiperjs', get_template_directory_uri() . '/build/js/imports/swiper.js', array(), '10.2.0', true);
	wp_enqueue_script('aum-theme-main-scripts', get_template_directory_uri() . '/build/js/scripts.js', array('swiperjs'), '1.0', true);

	// Load specific template stylesheet
	if (is_front_page()) {
		wp_enqueue_style('aum-theme-front-page', get_template_directory_uri() . "/build/css/templates/frontpage.css", array(), '1.0');
	}

	if (is_page()) {
		if (!is_front_page()) wp_enqueue_style('aum-theme-template-default', get_template_directory_uri() . '/build/css/templates/template-default.css', array(), '1.0');

		switch (get_page_template_slug()) {
			case 'page-templates/template-about.php':
				wp_enqueue_style('aum-theme-template-about', get_template_directory_uri() . '/build/css/templates/template-about.css', array(), '1.0', 'all');
				break;
			case 'page-templates/template-locations.php':
				wp_enqueue_style('aum-theme-template-locations', get_template_directory_uri() . '/build/css/templates/template-locations.css', array(), '1.0', 'all');
				break;
			case 'page-templates/template-links.php':
				wp_enqueue_style('aum-theme-template-links', get_template_directory_uri() . '/build/css/templates/template-links.css', array(), '1.0', 'all');
				break;
		}
	}

	if (is_home() || is_archive() || is_single()) {
		wp_enqueue_style('aum-theme-home', get_template_directory_uri() . "/build/css/templates/home.css", array(), '1.0');
		wp_enqueue_style('aum-theme-template-default', get_template_directory_uri() . '/build/css/templates/template-default.css', array(), '1.0');
	}

	if (is_singular('maestros')) {
		wp_enqueue_style('aum-theme-template-maestro', get_template_directory_uri() . '/build/css/templates/template-maestro.css', array(), '1.0', 'all');
	}

	if (is_post_type_archive('tribe_events')) {
		wp_enqueue_style('aum-theme-archive-events', get_template_directory_uri() . '/build/css/templates/archive-events.css', array(), '1.0', 'all');
	}
}
add_action('wp_enqueue_scripts', 'aum_theme_scripts');

/*Tamaño de excerpt modificado*/
function aum_theme_custom_excerpt_length($length)
{
	return 25;
}
add_filter('excerpt_length', 'aum_theme_custom_excerpt_length', 999);


/* Widget Area */
function aum_theme_widget_zones()
{

	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="text-center widget__title h3">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'default_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="text-center widget__title h3">',
		'after_title' => '</h3>'
	));
}

add_action('widgets_init', 'aum_theme_widget_zones');

//Check if sidebar is active
/* function is_sidebar_active($index)
{
	global $wp_registered_sidebars;
	$widgetcolums = wp_get_sidebars_widgets();
	if ($widgetcolums[$index]) return true;
	return false;
} */

//Enable SVG uploads
function add_file_types_to_uploads($file_types)
{
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

function wp_check_svg($file)
{
	$filetype = wp_check_filetype($file['name']);

	$ext = $filetype['ext'];
	$type = $filetype['type'];

	// Check if uploaded file is a SVG
	if ($type !== 'image/svg+xml' || $ext !== 'svg') {
		return $file;
	}

	// Make sure that the file is being uploaded by a trusted user
	if (!current_user_can('upload_files')) {
		return $file;
	}

	// Use WP_Filesystem to read the contents of the file
	global $wp_filesystem;
	if (empty($wp_filesystem)) {
		require_once(ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
	}

	$content = $wp_filesystem->get_contents($file['tmp_name']);

	// Use DOMDocument to parse the SVG file
	$doc = new DOMDocument();
	$doc->loadXML($content);

	// Check if the file contains any <script> tags
	$scripts = $doc->getElementsByTagName('script');

	if ($scripts->length > 0) {
		// The file contains <script> tags, which is not allowed
		return $file;
	}

	// The SVG file is safe, so return the original data
	return $file;
}
add_filter('wp_handle_upload_prefilter', 'wp_check_svg');

//Theme Options
require_once get_template_directory() . '/theme-functions/admin-menu.php';

//ACF JSON
function acf_theme_files($path)
{
	return get_stylesheet_directory() . '/acf-json-files';
}
add_filter('acf/settings/save_json', 'acf_theme_files');
