<?php
/**
 * LittleSis Custom Functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.0
 */


/**
 * Override Parent Post Excerpt
 *
 * @since 0.1.0
 *
 * @param  string $post_excerpt
 * @return string $post_excerpt
 */
 function all_excerpts_get_more_link( $post_excerpt ) {

   if( has_excerpt( get_the_id() ) ) {
     return $post_excerpt . '<p><a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More <span>&rarr;</span>',
     'littlesis' ) . '</a></p>';
   } else {
     return $post_excerpt . ' ...<p><a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More <span>&rarr;</span>',
     'littlesis' ) . '</a></p>';
   }

 }

/**
 * Default Open Graph Image
 * Replaces JetPack's default image with a custom image
 *
 * @return string $image[0] || url
 */
function littlesis_default_jetpack_open_graph_image() {

  $default_src = get_stylesheet_directory_uri() . '/images/thumbnail-default.svg';

  // If the default image exists, use it
  if( file_exists( $default_src ) ) {

    return esc_url( $default_src );

  }
  // If there is a custom logo, use it
  elseif( function_exists( 'the_custom_logo' ) ) {

    $custom_logo_id = get_theme_mod( 'custom_logo' );

    if( !empty( $custom_logo_id ) ) {
      $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

      return esc_url( $image[0] );
    }

  }

  // Otherwise, return the default JetPack image
  return esc_url( 'https://s0.wp.com/i/blank.jpg' );

}
add_filter( 'jetpack_open_graph_image_default', 'littlesis_default_jetpack_open_graph_image' );

/**
 * Remove JetPack Share Links from Content and Excerpt
 *
 * @since 0.0.9
 *
 * @link https://jetpack.com/2013/06/10/moving-sharing-icons/
 *
 * @return void
 */
function littlesis_jetpack_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );

    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'littlesis_jetpack_remove_share' );

/**
 * Modify Default Archive title
 *
 * @since 0.0.6
 *
 * @uses get_the_archive_title filter hook
 * @link https://developer.wordpress.org/reference/hooks/get_the_archive_title/
 *
 * @param  string $title
 * @return string $title
 */
function littlesis_get_the_archive_title( $title ) {
  if( is_category() ) {
    $title = single_cat_title( '', false );
  }
  return $title;
}
add_filter( 'get_the_archive_title', 'littlesis_get_the_archive_title' );
