<?php
/**
 * The main template file.
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

	<ul id="gallery">
	
	<?php $loop = new WP_Query( array( 'post_type' => 'mymenuitems', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => 7) ); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post();
	//$featured = get_post_meta($post->ID, 'dbt_featcheckbox',true);
	//if ($featured == "on") :
	?>
		<li>
			<div class="panel-overlay">
				<div class="clickview"><a href="<?php the_permalink(); ?>"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</a></div>
				<h2 class="entry-title"><?php the_title( '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a>' ); ?></h2>
				<br />
				<?php the_excerpt(); ?>
				
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?><!-- /image for gallery-->	
			<?php else:?>
			<img src="<?php echo get_bloginfo( 'template_url' ); ?>/images/noimage.jpg" alt=""/>
			<?php endif; ?>
		</li>
	<?php //endif; ?>
	<?php endwhile; ?>	
	</ul>


			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>