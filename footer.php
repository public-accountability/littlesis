<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<?php if ( is_active_sidebar( 'footer-info' ) ) : ?>

	<div class="wrapper" id="wrapper-footer">

		<div class="<?php echo esc_html( $container ); ?>">

			<div class="row">

				<div class="col-md-12">

					<footer class="site-footer" id="colophon">

						<?php dynamic_sidebar( 'footer-info' ); ?>

					</footer><!-- #colophon -->

				</div><!--col end -->

			</div><!-- row end -->

		</div><!-- container end -->

	</div><!-- wrapper end -->

<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
