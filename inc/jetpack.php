<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.me/
 *
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.0
 */

/**
 * Don't concatenate JetPack styles
 *
 * @since 0.1.1
 */
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

/**
 * Jetpack setup function.
 *
 * @since 0.1.0
 *
 * @see https://jetpack.me/support/infinite-scroll/
 * @see https://jetpack.me/support/responsive-videos/
 */
function littlesis_jetpack_setup() {

	remove_theme_support( 'infinite-scroll' );

	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'			=> 'click',
		'container' => 'main',
		'render'    => 'littlesis_infinite_scroll_render',
		'footer'    => 'wrapper-footer-full',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus
	add_theme_support( 'jetpack-social-menu' );

}
add_action( 'after_setup_theme', 'littlesis_jetpack_setup', 20 );

/**
 * Modify JetPack Infinite Scroll Settings
 *
 * @since 0.1.0
 *
 * @param  array  $settings
 * @return array $settings
 */
function littlesis_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More', 'littlesis' );

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'littlesis_jetpack_infinite_scroll_js_settings' );

/**
 * Custom render function for Infinite Scroll.
 *
 * @since 0.1.0
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

/**
 * Disable Infinite Scroll on home
 *
 * @since 0.1.0
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
