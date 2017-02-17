<?php
/**
 * The homepage template file.
 *
 * @package understrap
 * @subpackage littlesis
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

global $post;
?>

<!-- Display 1 Featured Posts -->
<?php
$sticky = get_option( 'sticky_posts' );

if( !empty( $sticky ) ) : ?>

	<?php $sticky = $sticky[0]; ?>

	<?php $featured_post = get_posts( array( 'include' => $sticky ) ); ?>

	<?php foreach ( $featured_post as $post ) : setup_postdata( $post ); ?>

		<?php get_template_part( 'global-templates/hero', 'featured' ); ?>

	<?php endforeach; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>

<div class="wrapper" id="wrapper-index">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<div id="category-filter-container" data-paged="12" class="category-filters">

				<?php $terms = get_terms( 'category' ); ?>

				<?php if( !empty( $terms ) ) : ?>

				<ul class="filter-nav">
						<li>
							<a href="#" data-filter="<?php echo $terms[0]->taxonomy; ?>" data-term="all-terms" data-page="1"><?php _e( 'All', 'littlesis' ) ?></a>
						</li>

						<?php foreach( $terms as $term ) : ?>

							<li>
								<a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-filter="<?php echo $term->taxonomy ?>" data-term="<?php echo $term->slug; ?>" data-page="1"><?php echo $term->name; ?></a>
							</li>

						<?php endforeach; ?>
					</ul>

				<?php endif; ?>

			</div>

			<!-- If there is a featured post, exclude in results -->

			<main class="site-main grid" id="main">

				<div class="status"></div>

				<div class="row results">

					<?php $posts = ( $sticky ) ? get_posts( array( 'exclude' => $sticky ) ) : get_posts() ; ?>

						<?php /* Start the Loop */ ?>

						<?php if( $posts ) :  ?>

							<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'loop-templates/content', 'grid' );
							?>

						<?php endforeach; ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

				</div>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php// understrap_pagination(); ?>

			<nav class="pagination infscr-pager">
				<a href="#page-2" class="btn btn-primary"><?php _e( 'Load More', 'littlesis' ); ?></a>
			</nav>

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
