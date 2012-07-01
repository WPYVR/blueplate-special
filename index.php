<?php
/**
 * The main template file.
 */

get_header(); ?>

<div id="primary">
	<div id="content" role="main">

		<ul id="gallery">

			<?php $loop = new WP_Query( array( 'post_type' =>
			'mymenuitems' ,'meta_key' => 'tw_checkboxspecial','orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => 7) ); ?>
			<?php while ( $loop->
			have_posts() ) : $loop->the_post(); ?>
			<li>
				<div class="panel-overlay">
					<div class="clickview">
						<a href="<?php the_permalink(); ?>"> 
						</a>
					</div>
					<h2 class="entry-title">
						<?php the_title( '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a>
					' ); ?>
				</h2>
				<br />
				</div>

				<?php 

				the_excerpt();
				$day_of_the_week = get_the_terms( $post->ID, 'day_of_the_week' );
				

				if (!empty($day_of_the_week)) {
					foreach ($day_of_the_week as $term) {
						if($term->parent == 0) {
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
								// echo '<h4>' . esc_html($term->name) . '</h4>';
							} else {
								echo '<img src="'.  get_bloginfo( 'template_url' ) .'/images/noimage.jpg" alt=""/>';
								echo '<h3>' . $term->name . '</h3>';
							}
						}
					}
				}
				?>

			

			</li>
		
		<?php endwhile; ?></ul>

</div>
<!-- #content -->
</div>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>