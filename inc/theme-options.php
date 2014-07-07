<?php

function um_child_field_entry() {

	/* Example:

	um_add_field('text3','Text One','text','umcto_display_setting','nilai default','Sample 3 Description');
	$text4_range = array(1,2,3,4,5,6,7,8);
	um_add_field('text4','Text One','select','umcto_display_setting',5,'Ranged',$text4_range);

	*/

	um_add_field('hfont','Heading font','text','umcto_display_setting','http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700','Webfonts for entry-title');
	um_add_field('header_width','Header Image Width','number','umcto_display_setting','1440','in Pixel Preferred');
	um_add_field('header_height','Header Image Height','number','umcto_display_setting','240','in Pixel Preferred');
	
}

function get_umcto($id) { 
	$option_name = 'umcto';
	$options = get_option( $option_name );
	if (!empty($options[$id])) {
		$options[$id] = esc_attr( stripslashes( $options[$id] ) ); return $options[$id]; 
	} else { 
		return false; 
	}
}

function um_child_register_settings() {
	register_setting( 'umcto', 'umcto', 'um_child_validate_settings' );
	add_settings_section( 'um_child_section', '', 'umcto_display_section', 'umcto.php' );
	um_child_field_entry();
}

function um_add_field($id,$title,$type,$callback,$default='',$desc='',$range=array()) {
	$hint = "<br/><code>$id</code>";
	add_settings_field( 
		$id, 
		$title.$hint, 
		$callback,
		'umcto.php', 
		'um_child_section', 
		array(
			'type' => $type,
			'id' => $id,
			'name' => $id,
			'desc' => $desc,
			'default' => $default,
			'label_for' => $id.'_label',
			'class' => $id.'_class',
			'range' => $range,
		));
}

function umcto_display_section($section){ echo "<hr/>"; }

function umcto_display_setting($args) {
	extract( $args );
	$option_name = 'umcto';
	$options = get_option( $option_name ); 
	if (!empty($options[$id])) { 
		$options[$id] = esc_attr( stripslashes( $options[$id] ) ); 
	} else { 
		$options[$id] = $default; 
	}
	
	// default, cause html5 build with validations
	// http://www.the-art-of-web.com/html/html5-form-validation/	
	
	switch ( $type ) { 
 
	case 'text': 
		echo "<input class='$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' size='60'/>"; 
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 
		break;
	case 'number': 
		echo "<input class='$class' type='number' id='$id' name='" . $option_name . "[$id]' min='0' value='$options[$id]' size='4'/>"; 
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 
		break;
	case 'textarea': 
		echo ($desc != '') ? "<span class='description'>$desc</span><br />" : "";
		echo "<textarea cols='60' rows='5' class='$class full' id='$id' name='" . $option_name . "[$id]'>".$options[$id]."</textarea>"; 
		break;
	case 'select': 
		echo ($desc != '') ? "<span class='description'>$desc</span><br />" : "";
		echo "<select class='$class' id='$id' name='" . $option_name . "[$id]'>";
			 foreach ($range as $opt) {
				if ( $opt == $options[$id]) { $selected = "selected"; } else { $selected =""; }
				echo "<option value='$opt' $selected>$opt</option>";
			 }
		echo "</select>";
		break; 		 
	
	} //swicth
	
}

function um_child_validate_settings($input) {
	foreach($input as $k => $v) {
		$newinput[$k] = sanitize_text_field($v);
		//if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) { $newinput[$k] = ''; //}
	}
	return $newinput;
}

function um_themename() {
	if (strlen(get_stylesheet())>3) { 
		$nice_name = ucfirst(get_stylesheet()); 
	} else { 
		$nice_name = strtoupper(get_stylesheet()); 
	}
	return $nice_name;
}

function um_child_theme_menu() {
	add_theme_page( 'Theme Option', um_themename() .' Options', 'edit_themes', 'umcto.php', 'um_child_theme_page'); 
}

add_action('admin_menu', 'um_child_theme_menu');

function um_child_theme_page() {?>
	<div class="wrap">
	<div class="um-header">
	<h2><?php echo um_themename(); ?> - Theme Options</h2>
	</div>
	<form method="post" enctype="multipart/form-data" action="options.php" class="umplugs">
	<div><?php 
	settings_fields('umcto'); 
	do_settings_sections('umcto.php');
	?></div>
	<hr/>
	<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Updates','um') ?>" /></p> 
	</form>
	</div><?php 
}

add_action( 'admin_init', 'um_child_register_settings' );

?>