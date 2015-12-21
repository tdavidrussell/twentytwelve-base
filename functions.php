<?php

/**
 * Child Theme Functions
 *
 * Functions or examples that may be used in a child them. Don't for get to edit them, to get them working.
 *
 * @link https://make.wordpress.org/core/handbook/inline-documentation-standards/php-documentation-standards/#6-file-headers
 * @since 20150711.1
 *
 * @category            WordPress_Theme
 * @package             Twenty_Twelve_Development
 * @subpackage          theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ROTW12_VERSION', '20150831.1' );
define( 'ROTW12_CDIR', get_stylesheet_directory() ); // if child, will be the file path, with out backslash
define( 'ROTW12_CURI', get_stylesheet_uri() ); // URL, if child, will be the url to the theme directory, no back slash

remove_action( 'wp_head', 'wp_generator' );

// Clean up the <head>
function rotw12_removeHeadLinks() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
}

add_action( 'init', 'rotw12_removeHeadLinks' );

/**
 * Load the Parent and Child  Theme CSS.
 * This faster than a css @import
 */
function rotw12_theme_enqueue_styles() {
	wp_enqueue_style( 'rotw12-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'rotw12-child-style', get_stylesheet_uri(), array( 'parent-style' ) );
}

add_action( 'wp_enqueue_scripts', 'rotw12_theme_enqueue_styles' );

/**
 * Load a custom.css style sheet, if it exists in a child theme.
 *
 * @return void
 */
function rotw12_enqueue_custom_stylesheets() {
	if ( ! is_admin() ) {
		if ( is_child_theme() ) {
			if ( file_exists( get_stylesheet_directory() . "/custom.css" ) ) {
				wp_enqueue_style( 'nnc-tw12-theme-custom-css', get_template_directory_uri() . '/custom.css' );
			}
		}
	}
}

//add_action( 'wp_enqueue_scripts', 'rotw12_enqueue_custom_stylesheets', 11 );

/**
 * EXAMPLE:
 * Add google fonts, don't forget to add the to the style.css or custom.css file.
 */
function rotw12_add_google_fonts() {
	wp_register_style( 'rotw12-googleFonts', 'http://fonts.googleapis.com/css?family=Lato' );
	//wp_register_style('rotw12-googleFonts', 'http://fonts.googleapis.com/css?family=Montserrat');
	wp_enqueue_style( 'rotw12-googleFonts' );
}

add_action( 'wp_print_styles', 'rotw12_add_google_fonts' );


/**
 * Setup Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
/*
function rotw12_theme_setup() {
	load_child_theme_textdomain( 'rotw12-child-theme', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'rotw12_theme_setup' );
*/


/**
 * Register and load font awesome CSS files using a CDN.
 *
 * @link   http://www.bootstrapcdn.com/#fontawesome
 * @author FAT Media
 */
function rotw12_enqueue_awesome() {
	wp_enqueue_style( 'rotw12-font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
}

add_action( 'wp_enqueue_scripts', 'rotw12_enqueue_awesome' );

?>