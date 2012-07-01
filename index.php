<?php
/**
 * The main template file.
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

	<ul id="gallery">
	
		<li>
			<div class="panel-overlay">
				<div class="clickview"><a href="<?php the_permalink(); ?>"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</a></div>
				<h2 class="entry-title"><?php the_title( '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a>' ); ?></h2>
				<br />
				<?php the_excerpt(); ?>
				
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a><!-- /image for gallery-->	
			<?php else:?>
			<a href="sample.htm"><img src="http://www.crispuno.ca/wp-content/uploads/2012/01/lulukfp-330x255.jpg" alt=""/></a>
			<?php endif; ?>
		</li>	
	</ul>


			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>