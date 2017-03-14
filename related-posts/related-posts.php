<?php
/**
 * LittleSis Core Related Posts
 *
 * @package    LittleSis_Core
 * @subpackage LittleSis_Core\Templates
 * @since      0.1.2
 * @license    GPL-2.0+
 */
?>

<?php global $post; ?>

<div id="related-posts" class="container">

  <div class="row">

    <h3 class="related-header"><?php _e( 'Recommended', 'littlesis' ); ?></h3>

    <?php
    $related_posts = $data;

    foreach( $related_posts as $post ) :
      $post = intval( $post );
      setup_postdata( $post ); ?>

      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

          <header class="entry-header">

            <?php littlesis_core_the_post_thumbnail( get_the_ID(), 'medium' ); ?>

            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '</a></h2>' ); ?>

          </header><!-- .entry-header -->

          <div class="entry-content">

            <p><a class="read-more" href="<?php get_permalink( get_the_ID() ); ?>"><?php _e( 'Read More <span>&rarr;</span>',
            'littlesis' ); ?></a></p>

          </div><!-- .entry-content -->

          <footer class="entry-footer">

          </footer><!-- .entry-footer -->

        </article><!-- #post-## -->

    <?php endforeach; ?>
    <?php wp_reset_postdata(); ?>

  </div>

</div>
