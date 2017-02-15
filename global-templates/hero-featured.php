<?php
/**
 * Hero setup.
 *
 * @package understrap
 * @subpackage littlesis
 */
?>

<div class="wrapper featured-content" id="wrapper-hero">

	<div class="wrapper" id="wrapper-static-hero">

		<div class="container" id="wrapper-static-content" tabindex="-1">

			<div class="row">

				<article <?php post_class( 'featured-article' ); ?> id="post-<?php the_ID(); ?>">

					<?php littlesis_the_post_thumbnail( $post->ID, 'full' ); ?>

					<div class="entry-body">

						<header class="entry-header">

							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
							'</a></h2>' ); ?>

							<?php if ( 'post' == get_post_type() ) : ?>

								<div class="entry-meta">
									<?php understrap_posted_on(); ?>
								</div><!-- .entry-meta -->

							<?php endif; ?>

						</header><!-- .entry-header -->

						<div class="entry-content">

							<?php
							the_excerpt();
							?>

							<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
								'after'  => '</div>',
								) );
								?>

							</div><!-- .entry-content -->

							<footer class="entry-footer">

								<?php// understrap_entry_footer(); ?>

							</footer><!-- .entry-footer -->

					</div>

					</article><!-- #post-## -->

				</div>

			</div>

		</div>

	</div>
