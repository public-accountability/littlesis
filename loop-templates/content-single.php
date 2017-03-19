<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php littlesis_get_the_term_list(); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<div class="post-meta">
					<?php understrap_posted_on(); ?>
			</div>

			<?php littlesis_jetpack_share(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php littlesis_the_post_thumbnail_single( $post->ID, 'full' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'littlesis' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php littlesis_series(); ?>

		<?php if( function_exists( 'littlesis_core_related_posts' ) ) : ?>
			<?php littlesis_core_related_posts(); ?>
		<?php endif; ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
