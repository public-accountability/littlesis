<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.me/
 *
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.1
 */

/**
 * Override parent theme jetpack settings
 */
remove_action( 'after_setup_theme', 'components_jetpack_setup', 15 );

/**
 * Jetpack setup function.
 *
 * @see https://jetpack.me/support/infinite-scroll/
 * @see https://jetpack.me/support/responsive-videos/
 */
function littlesis_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'			=> 'click',
		'container' => 'main',
		'render'    => 'littlesis_infinite_scroll_render',
		// 'footer'    => 'wrapper-footer-full',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus
	add_theme_support( 'jetpack-social-menu' );

}
add_action( 'after_setup_theme', 'littlesis_jetpack_setup' );

/**
 * Disable Infinite Scroll on home
 *
 * @since 0.1.1
 *
 * @param  bool $supported
 * @return boolean
 */
function littlesis_jetpack_disable( $supported ) {
	if( is_home() ) {
		return false;
	}
	return $supported;
}
add_filter( 'infinite_scroll_archive_supported', 'littlesis_jetpack_disable' );

/**
 * Custom render function for Infinite Scroll.
 */
function littlesis_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'loop-templates/content', 'search' );
		else :
			get_template_part( 'loop-templates/content' );
		endif;
	}
}

function littlesis_social_menu() {
	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	} else {
		jetpack_social_menu();
	}
}
