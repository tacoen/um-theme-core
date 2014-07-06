<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package um
 */

add_action('custom_header_options', 'um_custom_image_options');
add_action('admin_head', 'save_um_custom_options');
 
/* Adds new fields to the Custom Header options screen */

function um_custom_image_options() {

	$overlay = esc_attr( get_theme_mod( 'header_overlay','none') );
	?><p><strong>Note:</strong> Header Image will affect for the element with class "um-headimg"</p>
	<h3>Header image Options</h3>
	<table class="form-table">
	<tbody>
	<tr valign="top" class="hide-if-no-js">
		<th scope="row"><?php _e( 'Overlay:','um' ); ?></th>
		<td><p><select name="header_overlay" id="header_overlay">
			<option value="none" <?php if ($overlay=="none") { echo "selected"; } ?>>none</option>
			<option value="dark" <?php if ($overlay=="dark") { echo "selected"; } ?> >dark</option>
			<option value="light" <?php if ($overlay=="light") { echo "selected"; } ?>>light</option>
		</select></p></td>
	</tr>
	</tbody>
	</table>
<?php
} // end um_custom_image_options

function save_um_custom_options() {

	if ( ( isset( $_POST['header_overlay'] ) ) && ( current_user_can('manage_options') ) ) {
		check_admin_referer( 'custom-header-options', '_wpnonce-custom-header-options' );
		set_theme_mod( 'header_overlay', $_POST['header_overlay'] ); 
	}

	return;
} 

function um_custom_header_setup() {

	if ( get_umcto('header_width')!=false ) { $umchiW = get_umcto('header_width'); } else { $umchiW = "1000"; }
	if ( get_umcto('header_height')!=false ) { $umchiH = get_umcto('header_height'); } else { $umchiH = "250"; }
	
	add_theme_support( 'custom-header', apply_filters( 'um_custom_header_args', array(
		'default-image' => '',
		'header-text' => false,
		'default-text-color' => '000000',
		'width' => $umchiW,
		'height' => $umchiH,
		'flex-height' => false,
		'flex-width' => true,		
		'wp-head-callback' => 'um_header_style',
		'admin-head-callback' => 'um_admin_header_style',
		'admin-preview-callback' => 'um_admin_header_image',
	) ) );
}

add_action( 'after_setup_theme', 'um_custom_header_setup' );

if ( ! function_exists( 'um_header_css' ) ) :

	function um_header_css() {

	if ( get_header_image() ) {

		if ( get_umcto('header_width')!=false ) { $umchiW = get_umcto('header_width'); } else { $umchiW = "1000"; }
		if ( get_umcto('header_height')!=false ) { $umchiH = get_umcto('header_height'); } else { $umchiH = "250"; }
	
		$overlay = esc_attr( get_theme_mod( 'header_overlay', 'dark' ) );

		if ($overlay=="light") {
			$overlay_css = "background: url('". get_stylesheet_directory_uri()."/css/img/white.png" . "') 0 0 repeat,"; 
		} else if ($overlay=="dark") {
			$overlay_css = "background: url('". get_stylesheet_directory_uri()."/css/img/darke.png" . "') 0 0 repeat,"; 
		} else {
			$overlay_css = "background:";
		}
		
			
		$style = '<style type="text/css">';
		$style .= ".um-headimg { background-size: 100%; min-height: ".$umchiH."px; ".$overlay_css."url('".get_header_image()."') top right no-repeat; }";
		$style .= '</style>';

	} else {
			$style ="";
	}
	
	return $style;
	
	}

endif;
	
if ( ! function_exists( 'um_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see um_custom_header_setup().
 */

	function um_header_style() {
		echo um_header_css();
	}

endif;

if ( ! function_exists( 'um_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see um_custom_header_setup().
 */
	function um_admin_header_style() {
		echo um_header_css();
	}
	
endif; // um_admin_header_style

if ( ! function_exists( 'um_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see um_custom_header_setup().
 */

 function um_admin_header_image() {}

endif; // um_admin_header_image

add_action('wp_head','um_header_style');
