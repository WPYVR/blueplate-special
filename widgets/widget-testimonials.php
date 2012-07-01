<?php
/**
 * Plugin Name: Testimonials
 * Description: Widget to display testimonials for the Blue Plate Special Theme
 * Version: 0.1
 * Author: Theme Weekend Team 2
 */

add_action( 'widgets_init', 'testimonials_load_widgets' );

function testimonials_load_widgets() {
	register_widget( 'testimonials_Widget' );
}

class testimonials_Widget extends WP_Widget {

	function testimonials_Widget() {
		$widget_ops = array( 'classname' => 'testimonials', 'description' => __('Displays testimonials', 'testimonials') );

		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'testimonials-widget' );

		$this->WP_Widget( 'testimonials-widget', __('Testimonials', 'testimonials'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$featured = $instance['featured'];
		$numposts = $instance['numposts'];
		$multipages= explode(',',$featured);
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
		if (!($featured)) {
			$loop = new WP_Query( array( 'post_type' => 'testimonials', 'posts_per_page' => 1) ); 
			while ( $loop->have_posts()) {
			$loop->the_post(); 
						$cont = get_the_content();
						$cont = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $cont, ENT_QUOTES, get_option('blog_charset') ) ) ) );
						//$cont = word_trimmer ($cont, '15', false);
						$cont = esc_html($cont);
					echo "<div class='titleleft'>";
					echo the_title();
					echo "</div><div class='titleright'>";
					the_time('d.m.Y');
					echo "</div>";
					echo "<div class='clear'></div>";
					//echo $cont."...<br />";
					//echo "<a href='".get_permalink()."'><img src='"._get_img()."/readmore.png' border=0></a><br /><br />";
			} 
		} else {
		foreach($multipages as $key => $value){
							$mypost = get_post($value);
							$cont = $mypost->post_content;
							$cont = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $cont, ENT_QUOTES, get_option('blog_charset') ) ) ) );
							//$cont = word_trimmer ($cont, '15', false);
							$cont = esc_html($cont);
					echo "<div class='titleleft'>";
					echo get_the_title($value);
					echo "</div><div class='titleright'>";
					echo get_the_time('d.m.Y', $value);
					echo "</div>";
					echo "<div class='clear'></div>";
					//echo $cont."...<br />";
					//echo "<a href='".get_permalink($value)."'><img src='"._get_img()."/readmore.png' border=0></a><br /><br />";
			}
		}
	
	echo $after_widget;
	}
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['featured'] = strip_tags( $new_instance['featured'] );

		/* No need to strip tags for sex and show_sex. */
		$instance['numposts'] = $new_instance['numposts'];

		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => __('Testimonials', 'testimonials'), 'featured' => __('', 'testimonials'), 'numposts' => '1', 'show_recent' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'featured' ); ?>"><?php _e('Enter post IDs (separated by a comma):', 'testimonials'); ?></label>
			<input id="<?php echo $this->get_field_id( 'feaured' ); ?>" name="<?php echo $this->get_field_name( 'featured' ); ?>" value="<?php echo $instance['featured']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

?>