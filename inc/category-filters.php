<?php
/**
* LittleSis Category Filters
*
* @package understrap
* @subpackage littlesis
* @since 0.0.3
*/

/**
* Get Posts
* Get $_POST values and return content
*
* @since 0.0.3
*
* @uses do_taxonomy_filters action
* @uses wp_ajax_ action hook
* @uses WP_Query()
* @uses wp_verify_nonce()
*
* @link https://codex.wordpress.org/Class_Reference/WP_Query
* @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_(action)
*
* @return void
*/
function littlesis_filter_posts() {

  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'littlesis_taxonomy_filters' ) ) {
    die( 'Permission denied' );
  }

  $tax_query[] = array(
    'taxonomy'  => sanitize_text_field( $_POST['args']['taxonomy'] ),
    'field'     => 'slug',
    'terms'     => sanitize_text_field( $_POST['args']['term'] )
  );

  $args = array(
    'posts_per_page'  => intval( $_POST['args']['posts_per_page'] ),
    'post_type'       => 'post'
  );

  $sticky = get_option( 'sticky_posts' );
  if( $sticky ) {
    $sticky = intval( $sticky[0] );
    $args['post__not_in'] = array( $sticky );
  }

  if( $_POST['args']['term'] ) {
    $args['tax_query'] = $tax_query;
  }

  $posts_query = new WP_Query( $args );

  ob_start();

  if( $posts_query->have_posts() ) {

    while( $posts_query->have_posts() ) :
      $posts_query->the_post();

      get_template_part( 'loop-templates/content', 'grid' );

    endwhile;

  } else {

    get_template_part( 'loop-templates/content', 'none' );

  }

  $response = array(
    'content'         => ob_get_clean(),
    'posts_found'     => intval( $posts_query->found_posts ),
    'paged'           => $posts_query->query_vars['paged'],
    'posts_per_page'  => intval( $posts_query->query_vars['posts_per_page'] ),
    'query_vars'      => $posts_query->query_vars
  );

  wp_send_json( $response );

  // die( json_encode( $response ) );

}
add_action( 'wp_ajax_do_taxonomy_filters', 'littlesis_filter_posts' );
add_action( 'wp_ajax_nopriv_do_taxonomy_filters', 'littlesis_filter_posts' );

/**
 * Display Taxonomy Filters
 * Output on screen markup for taxonomy filterss
 *
 * @param array $args
 * @return void
 */
function littlesis_taxonomy_filters( $args = array() ) {

 /**
  * Define the array of defaults
  */
  $defaults = array(
    'taxonomy'        => 'category',
    'terms'           => false,
    'active'          => false,
    'posts_per_page'  => 12
  );

 /**
  * Parse incoming $args into an array and merge it with $defaults
  */
  $args = wp_parse_args( $args, $defaults );

  $terms_option = get_option( 'options_littlesis_category_terms' );

  if( $terms_option ) {

    $term_args = array(
      'taxonomy' => $args['taxonomy'],
      'include'  => $terms_option
    );

  } else {

    $term_args = array(
      'taxonomy' => $args['taxonomy'],
    );

    $uncategorized = get_terms( array( 'slug' => 'uncategorized' ) );
    $uncategorized_id = ( !empty( $uncategorized ) ) ? $uncategorized[0]->term_id : null;

    if( $uncategorized_id  ) {
      $term_args['exclude'] = (int) $uncategorized_id;
    }

  }

  ?>

  <div id="taxonomy-filters" data-taxonomy="<?php echo $args['taxonomy']; ?>" data-paged="<?php echo $args['posts_per_page']; ?>" class="taxonomy-filters">

    <?php
    $terms = get_terms( $term_args );

    if( !empty( $terms ) ) : ?>

    <ul class="filter-nav">
      <li class="active">
        <a href="#" data-taxonomy="<?php echo $args['taxonomy']; ?>" data-term="" data-page="1"><?php _e( 'All', 'littlesis' ) ?></a>
      </li>

      <?php foreach( $terms as $term ) : ?>

        <li>
          <a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-taxonomy="<?php echo $term->taxonomy ?>" data-term="<?php echo $term->slug; ?>" data-page="1"><?php echo $term->name; ?></a>
        </li>

      <?php endforeach; ?>
    </ul>

  <?php endif; ?>

</div>
<?php
}
