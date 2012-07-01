<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/js/galleryview/style.css" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
global $sa_options, $sa_categories, $sa_layouts;
$sa_settings = get_option( 'sa_options', $sa_options );
?>


<?php wp_head(); ?>
<script type="text/javascript" charset="utf-8">
  (function($) {

 var allPanels = $('.accordion > dd').hide();

 $('.accordion > dt > a').click(function() {
   allPanels.slideUp();
   $(this).parent().next().slideDown();
   return false;
 });

})(jQuery);
</script>
<script type="text/javascript">	
$(document).ready(function(){		
$('#gallery').galleryView({			
panel_width: 615,			
panel_height: 340,			
frame_width: 128,			
frame_height: 71,			
filmstrip_position: 'bottom'		
});	
});	</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">$(document).ready(function(){
	$("#contactForm").validate();
});</script>
<?php 
	global $sa_options;
	$sa_settings = get_option( 'sa_options', $sa_options );
?>
<?php $font_h1 = $sa_settings['layout_view'];
$font_name = str_replace("+", " ", $font_h1); ?>
<link href='http://fonts.googleapis.com/css?family=<?php echo $font_h1; ?>' rel='stylesheet' type='text/css'>
<style>
h1 { font-family: '<?php echo $font_name; ?>', Arial, serif!important;  }
</style>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<?php do_action( 'before' ); ?>
<header id="branding" role="banner">
  <hgroup> <img src="<?php header_image(); ?>" alt="" />
    <h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
      <?php bloginfo( 'name' ); ?>
      </a></h1>
    <h2 id="site-description">
      <?php bloginfo( 'description' ); ?>
    </h2>
  </hgroup>
  <nav id="access" role="navigation"><img src="<?php bloginfo('template_directory'); ?>/images/fork_top.png" />
    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    <img style="margin-top:-4px;" src="<?php bloginfo('template_directory'); ?>/images/fork_bottom.png"/></nav>
  <!-- #access --> 
</header>
<!-- #branding -->