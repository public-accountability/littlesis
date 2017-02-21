<?php
/**
* LittleSis Category Filters
*
* @package understrap
* @subpackage littlesis
* @since 0.1.0
*/

/**
* Get Posts
* Get $_POST values and return content
*
* @since 0.1.0
*
* @uses WP_Query()
* @uses wp_ajax_ action hook
* @uses ob_start()
*
* @link https://codex.wordpress.org/Class_Reference/WP_Query
*
* @return void
*/
function littlesis_filter_posts() {

  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'littlesis_taxonomy_filters' ) ) {
    die( 'Permission denied' );
  }

  $tax  = sanitize_text_field( $_POST['params']['tax'] );
  $term = sanitize_text_field( $_POST['params']['term'] );
  $page = intval( $_POST['params']['page'] );
  $quantity  = intval( $_POST['params']['quantity'] );
  $args = isset( $_POST['query'] ) ? array_map( 'esc_attr', $_POST['query'] ) : array();

  $tax_query[] = array(
    'taxonomy' => $tax,
    'field'    => 'slug',
    'terms'    => $term,
  );

  if ( $term == 'all-terms' ) {
    $tax_query[0]['operator'] = 'NOT IN';
  }

 /**
  * Setup query
  */
  $args = array(
    'paged'          => $page,
    'post_type'      => 'post',
    'posts_per_page' => $quantity,
    'tax_query'      => $tax_query
  );

  ob_start();

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) { ?>

    <?php
    while ( $query->have_posts() ) : $query->the_post();

    get_template_part( 'loop-templates/content', 'grid' );

    endwhile;
    wp_reset_postdata(); ?>

  <?php
  }

  //littlesis_ajax_pager( $query, $page );

  $data = ob_get_clean();

	wp_send_json_success( $data );

	wp_die();

}
add_action( 'wp_ajax_do_taxonomy_filters', 'littlesis_filter_posts' );
add_action( 'wp_ajax_nopriv_do_taxonomy_filters', 'littlesis_filter_posts' );

/**
 * Filter Shortcode
 *
 * @since 0.1.0
 *
 * @uses littlesis_taxonomy_filters()
 *
 * @param  array  $atts
 * @return string $result
 */
function littlesis_filter_posts_sc( $atts ) {

  $args = shortcode_atts( array(
    'tax'      => 'category',
    'terms'    => false,
    'active'   => false,
  ), $atts );

  $result = NULL;

  ob_start(); ?>

  <?php littlesis_taxonomy_filters( $args ); ?>

  <?php $result = ob_get_clean();

  return $result;
}
add_shortcode( 'ajax_filter_posts', 'littlesis_filter_posts_sc' );

/**
 * Pager
 *
 * @since 0.1.0
 *
 * @param  obj  $query
 * @param  integer $paged
 * @return void
 */
function littlesis_ajax_pager( $query = null, $page = 1 ) {

  if ( !$query ) {
    return;
  }

  $paginate = paginate_links([
    'base'      => '%_%',
    'type'      => 'array',
    'total'     => $query->max_num_pages,
    'format'    => '#page=%#%',
    'current'   => max( 1, $page ),
    'prev_text' => 'Prev',
    'next_text' => 'Next'
  ]);

  ?>

  <nav class="pagination infinite-scroll" data-max-pages="<?php echo $query->max_num_pages; ?>">
    <button type="button" name="button"  data-max-pages="<?php echo $query->max_num_pages; ?>" class="btn btn-primary load-more" data-page="<?php echo $page; ?>" <?php echo ( $page >= $query->max_num_pages ) ? disabled : ''; ?>><?php _e( 'Load More' ); ?></button>
  </nav>

<?php
}
