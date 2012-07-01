<?php

// Default options values
$sa_options = array(
	'font_h1' => '',
	'font_h2' => '',
	'font_h3' => ''
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'sa_theme_options', 'sa_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );

function sa_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'sa_theme_options_page' );
}

add_action( 'admin_menu', 'sa_theme_options' );

// Store categories in array
$google_fonts[0] = array(
	'value' => 'Alex+Brush',
	'label' => 'Alex Brush'
);

$google_fonts[1] = array(
	'value' => 'Crimson+Text',
	'label' => 'Crimson Text'
);

$google_fonts[2] = array(
	'value' => 'Josefin+Sans',
	'label' => 'Josefin Sans'
);
$google_fonts[3] = array(
	'value' => 'Limelight',
	'label' => 'Limelight'
);
$google_fonts[4] = array(
	'value' => 'Spirax',
	'label' => 'Spirax'
);

// Function to generate options page
function sa_theme_options_page() {
	global $sa_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'sa_options', $sa_options ); ?>
	
	<?php settings_fields( 'sa_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->


	<tr valign="top"><th scope="row"><label for="google_font">Custom Font</label></th>
	<td>
	<input id="google_font" name="sa_options[google_font]" type="text" value="<?php  esc_attr_e($settings['google_font']); ?>" />
	</td>
	</tr>

	<tr valign="top"><th scope="row"><label for="font_h1">Font for H1</label></th>
	<td>
	<select id="font_h1" name="font_h1">
	<?php
	foreach ( $google_fonts as $font ) :
		$label = $font['label'];
		$selected = '';
		if ( $fonnt['value'] == $settings['font_h1'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $font['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	
	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function sa_validate_options( $input ) {
	global $sa_options, $sa_categories, $sa_layouts;

	$settings = get_option( 'sa_options', $sa_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['google_font'] = wp_filter_post_kses( $input['google_font'] );
	
	return $input;
}

endif;  // EndIf is_admin()