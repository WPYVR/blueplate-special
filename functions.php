<?php
/**
Blue Plate Special functions file
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'blueplate_setup' ) ):

function blueplate_setup() {
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'blueplate' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
	add_theme_support( 'post-thumbnails');
	$args = array(
	'width'         => 234,
	'height'        => 174,
	'default-image' => get_template_directory_uri() . '/images/blueplate_special_logo_01.png',
	);
	add_theme_support( 'custom-header', $args );
	
	$args = array(
	'default-color' => 'fff',
	//'default-image' => get_template_directory_uri() . '/images/background.jpg',
	);
	add_theme_support( 'custom-background', $args );
}
endif; // blueplate_setup

/**
 * Tell WordPress to run blueplate_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'blueplate_setup' );

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'eeeeee',
	'text' => '444444',
);

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function blueplate_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'blueplate_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function blueplate_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'blueplate' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar 2', 'blueplate' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'blueplate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'blueplate_widgets_init' );

if ( ! function_exists( 'blueplate_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since blueplate 1.2
 */

/**
 * MANAGE JAVASCRIPT
 */
  add_action( 'wp_print_scripts', 'my_deregister_javascript', 1);
  function my_deregister_javascript() {
    if (!is_admin()) {

      // DEREGISTER JS
      wp_deregister_script('jquery');

 
      wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js');
      wp_enqueue_script('jquery');
	  // wp_register_script('flexslider',get_bloginfo('template_url').'/js/jquery.flexslider-min.js'); 
	  // wp_enqueue_script('flexslider');  
	  wp_register_script('galleryview',get_bloginfo('template_url').'/js/galleryview/jquery.galleryview-2.1.1rp.js'); 
	  wp_enqueue_script('galleryview');  
	  wp_register_script('easing',get_bloginfo('template_url').'/js/galleryview/jquery.easing.1.3.js'); 
	  wp_enqueue_script('easing'); 
	  wp_register_script('timers',get_bloginfo('template_url').'/js/galleryview/jquery.timers-1.2.js'); 
	  wp_enqueue_script('timers'); 
      // REGISTERS JS
	  }
	}
function blueplate_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">
		<h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'blueplate' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'blueplate' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'blueplate' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'blueplate' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'blueplate' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // blueplate_content_nav

 //Custom Post Type
add_action( 'init', 'create_my_post_types' );

function create_my_post_types() {
	register_post_type( 'mymenuitems',
		array(
			'labels' => array(
				'name' => __( 'Menu Items' ),
				'singular_name' => __( 'Menu Items' ),
				'add_new' => __( 'Add Menu Items' ),
				'add_new_item' => __( 'Add Menu Items' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Menu Items' ),
				'new_item' => __( 'New Menu Items' ),
				'view' => __( 'View Menu Items' ),
				'view_item' => __( 'View Menu Items' ),
				'search_items' => __( 'Search Menu Items' ),
				'not_found' => __( 'No Menu Items found' ),
				'not_found_in_trash' => __( 'No Menu Items found in Trash' ),
				'parent' => __( 'Parent Menu Items' ),

			),
			'public' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'menu_position' => 20,
			'hierarchical' => true,
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'excerpt','thumbnail','page-attributes' ),
		)
	);
	register_post_type( 'testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonial' ),
				'add_new' => __( 'Add Testimonial' ),
				'add_new_item' => __( 'Add Testimonial' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Testimonials' ),
				'new_item' => __( 'New Testimonial' ),
				'view' => __( 'View Testimonial' ),
				'view_item' => __( 'View Testimonial' ),
				'search_items' => __( 'Search Testimonials' ),
				'not_found' => __( 'No Testimonials found' ),
				'not_found_in_trash' => __( 'No Testimonials found in Trash' ),
				'parent' => __( 'Parent Testimonials' ),

			),
			'public' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'menu_position' => 20,
			'hierarchical' => true,
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'excerpt','thumbnail','page-attributes' ),
		)
	);
	flush_rewrite_rules( false );
}

//MetaBox

$prefix = 'tw_';

$meta_boxes = array(
    array(
        'id' => 'menudetails',
        'title' => 'Menu Details',
        'pages' => array('mymenuitems'),
        'context' => 'normal',
        'priority' => 'high',
		'fields' => array(
		array(
            'name' => 'Price',
            'id' => $prefix . 'txtprice',
            'type' => 'text'
        ),
		array(
            'name' => 'Is this a special?',
            'id' => $prefix . 'checkboxspecial',
            'type' => 'checkbox',
        )
	)
    )
)	;

foreach ($meta_boxes as $meta_box) {
    $my_box = new My_meta_box($meta_box);
}
class My_meta_box {

    protected $_meta_box;

    // create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));

        add_action('save_post', array(&$this, 'save'));
    }

    /// Add meta box for multiple post types
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }

    // Callback function to show fields in meta box
    function show() {
        global $post;

        // Use nonce for verification
        echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
        echo '<table class="form-table">';

        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);
        
            echo '<tr>',
                    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                    '<td>';
            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                        '<br />', $field['desc'];
                    break;
                case 'textarea':
                    echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
                        '<br />', $field['desc'];
                    break;
                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                    echo '</select>';
                    break;
                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    break;
            }
            echo     '<td>',
                '</tr>';
        }
    
        echo '</table>';
    }

    // Save data from meta box
    function save($post_id) {
        // verify nonce
        if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }

        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        foreach ($this->_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
    
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
}

//Taxonomies
add_action( 'init', 'build_taxonomies', 0);

function build_taxonomies() {
	register_taxonomy( 'day_of_the_week', 'mymenuitems', array( 'hierarchical' => true, 'label' => 'Day of the Week', 'query_var' => true, 'rewrite' => true ) );
	// register_taxonomy( 'meal_of_the_day', 'mymenuitems', array( 'hierarchical' => true, 'label' => 'Meal of the Day', 'query_var' => true, 'rewrite' => true ) );
}

//Auto Populate Pages

function populate_pages() {
// Create About Us page
$pagename = 'About Us';
$my_post = array(
     'post_title' => $pagename,
     'post_content' => 'Here is information about our restaurant.',
     'post_status' => 'publish',
     'post_author' => 1,
     'post_type' => 'page',
	 'post_name' => 'about_us'
  );
  $page_exists = get_page_by_title( $pagename );
	if($page_exists) {       //do nothing
	  } else {
		$insert = wp_insert_post( $my_post );
	}
	
// Create Menu Page
$pagename = 'Menu';
$my_post = array(
     'post_title' => $pagename,
     'post_content' => 'Here is your Menu page.',
     'post_status' => 'publish',
     'post_author' => 1,
     'post_type' => 'page',
	 'post_name' => 'our_menu'
  );
  $page_exists = get_page_by_title( $pagename );
	if($page_exists) {       //do nothing
	  } else {
		$insert = wp_insert_post( $my_post );
	}

// Create Reservations Page
$pagename = 'Reservations';
$my_post = array(
     'post_title' => $pagename,
     'post_content' => 'Here is your Reservations page.',
     'post_status' => 'publish',
     'post_author' => 1,
     'post_type' => 'page',
	 'post_name' => 'make_reservations'
  );
  $page_exists = get_page_by_title( $pagename );
	if($page_exists) {       //do nothing
	  } else {
		$insert = wp_insert_post( $my_post );
	}
}

add_action ('init', 'populate_pages', 0);

if ( ! function_exists( 'blueplate_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own blueplate_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since blueplate 0.4
 */
function blueplate_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'blueplate' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'blueplate' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'blueplate' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'blueplate' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'blueplate' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'blueplate' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for blueplate_comment()

if ( ! function_exists( 'blueplate_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own blueplate_posted_on to override in a child theme
 *
 * @since blueplate 1.2
 */
function blueplate_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'blueplate' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'blueplate' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since blueplate 1.2
 */
function blueplate_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'blueplate_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since blueplate 1.2
 */
function blueplate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so blueplate_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so blueplate_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in blueplate_categorized_blog
 *
 * @since blueplate 1.2
 */
function blueplate_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'blueplate_category_transient_flusher' );
add_action( 'save_post', 'blueplate_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function blueplate_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'blueplate_enhanced_image_navigation' );



// autopopulate days to day_of_the_week_taxonomy
function populate_day_of_the_week() {

	if (!get_option('days_of_the_week')) {
		
		$days_of_the_week = array(  'Monday',
							    	'Tuesday',
							    	'Wednesday',
							   	 	'Thursday',
							    	'Friday',
							    	'Saturday',
							    	'Sunday'
								);

		
			
			if(taxonomy_exists(day_of_the_week)) {
				foreach($days_of_the_week as $day) {
				if( !term_exists($day, 'day_of_the_week') )	 {
					$day_results = wp_insert_term($day, 'day_of_the_week', array('description'=> $day, 
	        												 					   'slug' => $day	
	        																));

						if (!is_wp_error($day_results)) {
							$parent_term_id = $day_results['term_id'];
							populate_meals_of_the_day($parent_term_id, $day);
						} else {
							echo 'wp error';
							print_r($errors);
							// die();
						}
					}
				}
			}

			else {
				echo "doesn't exist";
			}

				


			 // print_r($day_results);
			// die('day of the week');
			
			// if(empty($day_results)) {
			// 	echo " empty day results";
			// 	die('empty day results');
			// }


	
	    add_option('days_of_the_week', true);
	    // die('day of the week');
	}
 } 

 add_action('admin_init', 'populate_day_of_the_week');


function populate_meals_of_the_day($parent_term_id, $day) {

	$meals_of_the_day = array(
		'Breakfast',
		'Lunch',
		'Dinner'
	);

	// Add meals of the days for each day
	foreach($meals_of_the_day as $meal_of_the_day) {
		$slug = $meal_of_the_day . '-' . $day;
		wp_insert_term($meal_of_the_day, 'day_of_the_week', array('description' => $meal_of_the_day,
																		 'slug' => $slug,
																	   'parent' => $parent_term_id
																	));
	}
}

require_once ( get_stylesheet_directory() . '/theme-options.php' );
require_once ( get_stylesheet_directory() . '/widgets/widget-testimonials.php' );

 
