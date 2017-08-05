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
$featured = littlesis_get_featured_post();

if( !empty( $featured ) ) : ?>

	<?php $featured_post = get_posts( array( 'include' => $featured ) ); ?>

	<?php foreach ( $featured_post as $post ) : setup_postdata( $post ); ?>

		<?php get_template_part( 'global-templates/hero', 'featured' ); ?>

	<?php endforeach; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>

<div class="wrapper" id="wrapper-index">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div id="taxonomy-filter-container" class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<?php littlesis_taxonomy_filters(); ?>

			<!-- If there is a featured post, exclude in results -->

			<main class="site-main grid" id="main">

				<div class="row results">

					<?php $posts_per_page = get_option( 'posts_per_page' ); ?>
					<?php $args = array(
						'posts_per_page' 				 => $posts_per_page,
						'ignore_sticky_posts'		=> true
					); ?>
					<?php if( $featured ) : ?>
						<?php $args['post__not_in'] = $featured; ?>
					<?php endif; ?>

					<?php $query = new WP_Query( $args ); ?>

						<?php /* Start the Loop */ ?>

						<?php if( $query->have_posts() ) :  ?>

							<?php while( $query->have_posts() ) : $query->the_post(); ?>

							<?php
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'loop-templates/content', 'grid' );
							?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

				</div>

			</main><!-- #main -->

			<div id="infinite-scroll"></div>

			<!-- The pagination component -->
			<?php// understrap_pagination(); ?>


		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
