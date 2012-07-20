<?php
/* Template Name: Menu*/

get_header(); 
//$today = date('l');
$today = "Monday";
$parent = get_term_by('name', $today, 'day_of_the_week');
if (!$parent) {
$parent_id = 0;
} else {
$parent_id = $parent->term_id;
}
?>

		<div id="primary">
			<div id="content" role="main">
			<h2> <?php if ($today) { echo $today; } ?> </h2>
			<?php 
				$subcatsql = "SELECT DISTINCT description, slug FROM $wpdb->term_taxonomy, $wpdb->terms WHERE $wpdb->term_taxonomy.parent = '$parent_id' and $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id";
				$subcatquery = $wpdb->get_results($subcatsql);
				foreach ($subcatquery as $child) {
				$loop = new WP_Query(array( 'day_of_the_week' => $child->slug, 'orderby' => 'menu_order', 'order' => 'ASC','hide_empty'=>1)); 
				while ( $loop->have_posts() ) : $loop->the_post();
				if ($count < 1) {
					echo '<h3>'.$child->description.'</h3>';
					echo '<br />';
				}
				$count = 1;
					$price = get_post_meta($post->ID, 'tw_txtprice',true);
					echo get_the_title();
					if ($price):
					echo '-'.$price;
					endif;
					the_content();
				endwhile;
				$count = 0;
				} 
				?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>