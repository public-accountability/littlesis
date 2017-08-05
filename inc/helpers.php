<?php
/**
 * Littlesis helper functions
 *
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.12
 */

/**
 * Get Latest Sticky Post
 * Get the most recent sticky post ID in an array
 *
 * @since 0.1.12
 *
 * @return array | null
 */
function littlesis_get_latest_sticky_post() {
  $sticky = get_option( 'sticky_posts' );

  $posts = get_posts( array(
    'include'         => $sticky,
    'posts_per_page'  => count( $sticky ),
    'fields'          => 'ids'
  ) );

  if( !empty( $posts ) && !is_wp_error( $posts ) ) {
    return array_slice( $posts, 0, 1 );
  }

  return null;
}

/**
 * Get Featured Post
 * If there are sticky posts, the featured post is the latest post; otherwise, it's the latest post
 *
 * @since 0.1.12
 *
 * @uses littlesis_get_latest_sticky_post()
 *
 * @return array | null
 */
function littlesis_get_featured_post() {
  $sticky = littlesis_get_latest_sticky_post();
  if( $sticky ) {
    return $sticky;
  } else {
    $args = array(
      'posts_per_page'      => 1,
      'ignore_sticky_post'  => true,
      'fields'              => 'ids'
    );
    return get_posts( $args );
  }
}
