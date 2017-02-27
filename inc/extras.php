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

   return $post_excerpt . ' ...<p><a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More &rarr;',
   'littlesis' ) . '</a></p>';
 }

/**
 * Modify Markup of Thumbnail
 *
 * @since 0.1.0
 *
 * @param  string $html
 * @param  int  $post_id
 * @param  int  $post_thumbnail_id
 * @param  mixed (string || array)  $size
 * @param  array $attr
 * @return string $html
 */
function littlesis_modify_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    $id = get_post_thumbnail_id();
    $src = wp_get_attachment_image_src( $id, $size );
    $alt = get_the_title( $id );
    $class = $attr['class'];

    if( 'thumbnail' == $size || 'medium' == $size ) {
      $html = sprintf( '<figure class="featured-image">%s</figure>', $html );
    }

    return $html;
}
add_filter( 'post_thumbnail_html', 'littlesis_modify_post_thumbnail_html', 99, 5 );

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
