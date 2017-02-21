<?php
/**
 * LittleSis Template Tags
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.0
 */
 function understrap_posted_on() {
 	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
 	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
 		$time_string = '<time class="updated" datetime="%1$s">%2$s</time>';
 	}
 	$time_string = sprintf( $time_string,
 		esc_attr( get_the_modified_date( 'c' ) ),
 		esc_html( get_the_modified_date() )
 	);
 	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

  if ( function_exists( 'coauthors_posts_links' ) ) {
    $byline = coauthors_posts_links( null, null, __( 'By ', 'littlesis' ), null, false );
  } else {
    $byline = sprintf(
  		esc_html_x( 'by %s', 'post author', 'understrap' ),
  		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
  	);
  }

 	echo '<div class="byline"> ' . $byline . '</div> <div class="posted-on">' . $posted_on . '</div>'; // WPCS: XSS OK.
 }

/**
 * Override Parent Footer
 *
 * @since 0.1.0
 *
 * @return void
 */
 function understrap_entry_footer() {
 	// Hide category and tag text for pages.
 	if ( 'post' === get_post_type() ) {
 		/* translators: used between list items, there is a space after the comma */
 		$categories_list = get_the_category_list( esc_html__( ', ', 'littlesis' ) );
 		if ( $categories_list && understrap_categorized_blog() ) {
 			printf( '<div class="cat-links">' . esc_html__( '%1$s', 'littlesis' ) . '</div>', $categories_list ); // WPCS: XSS OK.
 		}
 		/* translators: used between list items, there is a space after the comma */
 		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'littlesis' ) );
 		if ( $tags_list ) {
 			printf( '<div class="tags-links">' . esc_html__( 'Tagged %1$s', 'littlesis' ) . '</div>', $tags_list ); // WPCS: XSS OK.
 		}

    $series_list = get_the_term_list( get_the_ID(), 'series', '', esc_html__( ', ', 'littlesis' ), '' );
 		if ( $series_list ) {
 			printf( '<div class="series-links">' . esc_html__( 'In Series: %1$s', 'littlesis' ) . '</div>', $series_list ); // WPCS: XSS OK.
 		}
 	}
 	edit_post_link(
 		sprintf(
 			/* translators: %s: Name of current post */
 			esc_html__( 'Edit %s', 'littlesis' ),
 			the_title( '<span class="screen-reader-text">"', '"</span>', false )
 		),
 		'<span class="edit-link">',
 		'</span>'
 	);
 }

/**
 * Display Category
 *
 * @since 0.1.0
 *
 * @param  string  $taxonomy
 * @return void
 */
 function littlesis_get_the_term_list( $taxonomy = 'category' ) {
   $term_list = get_the_term_list( get_the_ID(), $taxonomy, '', esc_html__( ', ', 'littlesis' ), '' );
    if ( $term_list ) {
      echo '<div class="' . esc_html( $taxonomy, 'littlesis' ) . '-links">';
      printf( '<span class="%1$s-link">%2$s</span>',
        $taxonomy,
        $term_list
      ); // WPCS: XSS OK.
      echo '</div>';
    }
 }

/**
 * Display Series Information
 *
 * @since 0.1.0
 *
 * @param  int $post_id
 * @return void
 */
 function littlesis_series( $post_id = null ) {
   $post_id = ( $post_id ) ? (int) $post_id : get_the_ID();
   $series = get_the_terms( $post_id, 'series' );

   if( $series ) {
     $series = $series[0];
   }

 }

/**
 * Display Image with Markup
 *
 * @since 0.1.0
 * @param  int $post_id
 * @param  string  $size
 * @return void
 */
 function littlesis_the_post_thumbnail( $post_id = null, $size = 'thumbnail' ) {
   $post_id = ( $post_id ) ? (int) $post_id : get_the_ID();
   if( has_post_thumbnail( $post_id ) ) {
     $image_id = get_post_thumbnail_id( $post_id );
     $caption = get_post_field( 'post_excerpt', $image_id );
     $image = sprintf(' <figure class="post-image size-%s"><a href="%s" rel="bookmark">%s</a><figcaption>%s</figcaption></figure>',
       $size,
       get_permalink(  $post_id ),
       get_the_post_thumbnail( $post_id, $size ),
       $caption
     );
     echo $image;
   }
 }

 /**
  * Display Image with Markup for Single Posts
  *
  * @since 0.1.0
  * @param  int $post_id
  * @param  string  $size
  * @return void
  */
  function littlesis_the_post_thumbnail_single( $post_id = null, $size = 'full' ) {
    $post_id = ( $post_id ) ? (int) $post_id : get_the_ID();
    if( has_post_thumbnail( $post_id ) ) {
      $image_id = get_post_thumbnail_id( $post_id );
      $caption = get_post_field( 'post_excerpt', $image_id );
      $image = sprintf(' <figure class="single-post-image size-%s">%s<figcaption>%s</figcaption></figure>',
        $size,
        get_the_post_thumbnail( $post_id, $size ),
        $caption
      );
      echo $image;
    }
  }

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
      'tax'      => 'category',
      'terms'    => false,
      'active'   => false,
      'per_page' => 12
    );

   /**
    * Parse incoming $args into an array and merge it with $defaults
    */
    $args = wp_parse_args( $args, $defaults );

    $taxonomy = $args['tax'];
    ?>

    <div id="taxonomy-filter-container" data-paged="<?php echo $args['per_page']; ?>" class="taxonomy-filters">

    <?php
    $terms = get_terms( $taxonomy );

    if( !empty( $terms ) ) : ?>

      <ul class="filter-nav">
        <li class="active">
          <a href="#" data-filter="<?php echo $taxonomy; ?>" data-term="all-terms" data-page="1"><?php _e( 'All', 'littlesis' ) ?></a>
        </li>

        <?php foreach( $terms as $term ) : ?>

          <li>
            <a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-filter="<?php echo $term->taxonomy ?>" data-term="<?php echo $term->slug; ?>" data-page="1"><?php echo $term->name; ?></a>
          </li>

        <?php endforeach; ?>
      </ul>

  <?php endif; ?>

  </div>
<?php
}
