<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package blueplate
 * @since blueplate 0.1
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
		<div id="site-generator">
			<?php do_action( 'blueplate_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'blueplate' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'blueplate' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'blueplate' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'blueplate' ), 'blueplate', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->



</body>
</html>