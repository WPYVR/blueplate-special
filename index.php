<?php
/**
 * The main template file.
 */

get_header(); ?>

<div id="primary">
  <div id="content" role="main"><div class="front_page_container">
   <div class="picture_frame"></div> <ul id="gallery">
            <?php $loop = new WP_Query( array( 'post_type' =>
      'mymenuitems' ,'meta_key' => 'tw_checkboxspecial','orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => 7) ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post();
	//$featured = get_post_meta($post->ID, 'dbt_featcheckbox',true);
	//if ($featured == "on") :
	?>
      <li>
        
          <div class="panel-overlay">
            <h2 class="entry-title">
              <?php the_title( '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a>' ); ?>
            </h2>
            <br />
            <?php the_excerpt(); ?>
          </div>
       
              <?php 
        $day_of_the_week = get_the_terms( $post->ID, 'day_of_the_week' );
        
        if (!empty($day_of_the_week)) {
          foreach ($day_of_the_week as $term) {
            if($term->parent == 0) {
              echo '<div class = "image-and-day">';
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail();
                } else {
                  echo '<img src="'.  get_option( 'home' ) .'/images/noimage.jpg" alt=""/>';
                }
              echo '</div>';
              echo '<h3>' . $term->name . '</h3>';

            }
          }
        }
        ?>
      </li>
      <?php //endif; ?>
      <?php endwhile; ?>
    </ul></div>
  </div>
  <!-- #content --> 
</div>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
