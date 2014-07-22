<?php
/**
 * um functions and definitions
 *
 * @package um
 */

require get_template_directory() . '/inc/umplug-setup.php';
 
if ( ! function_exists( 'um_setup' ) ) :

	function um_setup() {

	/*
	 * Set the content width based on the theme's design and stylesheet.
	 */

	global $content_width;

	if ( ! isset( $content_width ) ) { 
		$content_width = 800; // pixels
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on um, use a find and replace
	 * to change 'um' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'um', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'um' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	/*
	add_theme_support( 'custom-background', apply_filters( 'um_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	*/
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
	
	add_action( 'widgets_init', 'um_widgets_init' );
	add_action( 'init', 'um_add_editor_styles' );

	if (get_umcto('fiximgpad')) { $um_fixImageMargins = new um_fixImageMargins(); }

	}

endif; // um_setup

add_action( 'after_setup_theme', 'um_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */

function um_widgets_init() {
	register_sidebar( array(
		'name'		 => __( 'Sidebar', 'um' ),
		'id'			=> 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}

function um_add_editor_styles() {
	add_editor_style( 'css/editor-style.css' );
}


/**
 * Enqueue scripts and styles -- UM ways.
 */

require get_template_directory() . '/inc/umplug-template.php'; // Only at parent
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load it from child if any
 */

um_which_php('/inc/theme-options.php');
um_which_php('/inc/customizer.php');
um_which_php('/inc/template-tags.php');
um_which_php('/inc/commenting.php');
um_which_php('/inc/extras.php');
um_which_php('/inc/custom-header.php');
