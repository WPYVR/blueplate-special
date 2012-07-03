<?php

// Default options values
$bp_options = array(
	'telephone' => '&copy; ' . date('Y') . ' ' . get_bloginfo('name'),
	'resto_address' => '',
	'custom_font' => 'fixed',
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function bp_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'bp_theme_options', 'bp_options', 'bp_validate_options' );
}

add_action( 'admin_init', 'bp_register_settings' );


// Store layouts views in array
$bp_layouts = array(
	'Spirax' => array(
		'value' => 'Spirax',
		'label' => 'Spirax'
	),
	'Limelight' => array(
		'value' => 'Limelight',
		'label' => 'Limelight'
	),
	'Josefin+Sans' => array(
		'value' => 'Josefin+Sans',
		'label' => 'Josefin Sans'
	),
	'Arial' => array(
		'value' => 'Arial',
		'label' => 'Arial'
	),
	'Alex+Brush' => array(
		'value' => 'Alex+Brush',
		'label' => 'Alex Brush'
	),
	'Crimson+Text' => array(
		'value' => 'Crimson+Text',
		'label' => 'Crimson Text'
	),

);

function bp_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'bp_theme_options_page' );
}

add_action( 'admin_menu', 'bp_theme_options' );

// Function to generate options page
function bp_theme_options_page() {
	global $bp_options, $bp_categories, $bp_layouts;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'bp_options', $bp_options ); ?>
	
	<?php settings_fields( 'bp_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	
	
	<tr valign="top"><th scope="row"><label for="resto_address">Address</label></th>
	<td>
	<textarea id="resto_address" name="bp_options[resto_address]" rows="5" cols="30"><?php echo stripslashes($settings['resto_address']); ?></textarea>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="telephone">Telephone</label></th>
	<td>
	<input id="telephone" name="bp_options[telephone]" type="text" value="<?php  esc_attr_e($settings['telephone']); ?>" />
	</td>
	</tr>
	
	<tr valign="top"><th scope="row">Custom Font</th>
	<td>
	<?php foreach( $bp_layouts as $layout ) : ?>
	<input type="radio" id="<?php echo $layout['value']; ?>" name="bp_options[custom_font]" value="<?php esc_attr_e( $layout['value'] ); ?>" <?php checked( $settings['custom_font'], $layout['value'] ); ?> />
	<label for="<?php echo $layout['value']; ?>"><?php echo $layout['label']; ?></label><br />
	<?php endforeach; ?>
	</td>
	</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php

}

function bp_validate_options( $input ) {
	global $bp_options, $bp_categories, $bp_layouts;

	$settings = get_option( 'bp_options', $bp_options );
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['telephone'] = wp_filter_nohtml_kses( $input['telephone'] );
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['resto_address'] = wp_filter_post_kses( $input['resto_address'] );
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['custom_font'];
	// We verify if the given value exists in the layouts array
	if ( !array_key_exists( $input['custom_font'], $bp_layouts ) )
		$input['custom_font'] = $prev;
	

	
	return $input;
}

endif;  // EndIf is_admin()