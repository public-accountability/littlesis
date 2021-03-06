<?php
/**
 * LittleSis Enqueue Functions
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 *
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.0
 */

/**
 * Remove Parent Styles and Scripts
 *
 * @since 0.1.0
 *
 * @return void
 */
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

/**
 * Enqueue Styles
 *
 * @since 0.1.0
 *
 * @uses wp_get_theme
 *
 * @return void
 */
function theme_enqueue_styles() {

  wp_deregister_style( 'the-neverending-homepage' );
  wp_deregister_style( 'sharedaddy' );
  wp_deregister_style( 'sharing' );
  wp_deregister_style( 'social-logos' );

	// Get the theme data
  $the_theme = wp_get_theme();

  wp_enqueue_style( 'littlesis-styles', get_stylesheet_directory_uri() . '/css/style.min.css', array(), $the_theme->get( 'Version' ) );
  wp_enqueue_script( 'littlesis-scripts', get_stylesheet_directory_uri() . '/js/app.js', array(), $the_theme->get( 'Version' ), true );
  wp_enqueue_script( 'littlesis-search', get_stylesheet_directory_uri() . '/js/search.js', array(), $the_theme->get( 'Version' ), true );
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,700|Source+Sans+Pro:400,600,700', array(), null );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
