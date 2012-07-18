<?php
/* Template Name: Menu*/

get_header(); 
$today = date('l');

?>

		<div id="primary">
			<div id="content" role="main">

				<?php 
				$loop = new WP_Query( array( 'post_type' =>'mymenuitems','orderby' => 'menu_order', 'order' => 'ASC') ); 
				while ( $loop->have_posts() ) : $loop->the_post();
				$day_of_the_week = get_the_terms( $post->ID, 'day_of_the_week' );
				 if (!empty($day_of_the_week)) {
						  foreach ($day_of_the_week as $term) {
							if($term->name == $today) {
							echo $term->name;
							$termchildren = get_term_children( 7, 'day_of_the_week');//this line does not work
								foreach ($termchildren as $child) {
								$subcat = get_term_by ('id', $child, 'day_of_the_week');
								echo $subcat->slug;
								the_title();
								the_content();
								}
							}
						}
					}
				?>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>