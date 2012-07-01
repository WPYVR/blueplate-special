<?php
/* Template Name: About Us*/

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<h2><?php the_title(); ?></h2>
				<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail(); ?><!-- /featured image-->	
				<?php else:?>
				<img src="<?php echo get_bloginfo('template_url')?>/images/blue_plate.jpg"><!-- /placeholder image-->
				<?php endif; ?>
				<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>