<?php

function um_child_field_entry() {
/* 
	syntax format:

	um_add_field(
		array(
			id => 'id',
			label => 'label',
			desc =>	'Descriptions',
			type => '[check|text|number|select|textarea]',
			default => '',
			select_range = > array(1,2,3,4,5,6,7,8);
			rule => ''
		)
	);
	
	For html5 validation rule see:
	http://www.the-art-of-web.com/html/html5-form-validation/	

*/
	um_add_field(
		array(
			'id' => "fiximgpad",
			'label' => "No img padding",
			'type' => "check",
			'default' => "1",
			'desc' =>	"Do not add extra 10px on every images",
		)
	);

	um_add_field(
		array(
			'id' => "header_width",
			'label' => "Header Image Width",
			'type' => "number",
			'default' => "1440",
			'desc' => "Pixel",
			'rule' => 'min="800" max="2048"'
		)
	);

	um_add_field(
		array(
			'id' => "header_height",
			'label' => "Header Image Height",
			'type' => "number",
			'default' => "240",
			'desc' => "Pixel",
			'rule' => 'min="300" max="128"'
		)
	);	
	
	um_add_field(
		array(
			'id' => "hfont",
			'label' => "Font for Heading",
			'type' => "text",
			'default' => 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700',
			'desc' => "Webfonts for entry-title",
			'rule' => 'pattern="https?://.+"'
		)
	);
	
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

function um_add_field($af) {
	$hint = "<br/><code>".$af['id']."</code>";
	if (!isset($af['select_range'])) { $af['select_range'] =''; } 
	if (!isset($af['rule'])) { $af['rule'] =''; }
	if (!isset($af['desc'])) { $af['desc'] =''; }
	if (!isset($af['default'])) { $af['default'] =''; }
	
	add_settings_field( 
		$af['id'], 
		$af['label'].$hint, 
		'umcto_display_setting',
		'umcto.php', 
		'um_child_section', 
		array(
			'type' => $af['type'],
			'id' => $af['id'],
			'name' => $af['id'],
			'desc' => $af['desc'],
			'default' => $af['default'],
			'label_for' => $af['id'].'_label',
			'class' => $af['id'].'_class',
			'range' => $af['select_range'],
			'rule' => $af['rule']
		));
}

function umcto_display_section($section){ echo "<hr/>"; }

function umcto_display_setting($args) {
	extract( $args );
	$option_name = 'umcto';
	$options = get_option( $option_name ); 
	if (!isset($options[$id])) { 
		if (!empty($options[$id])) {
			$options[$id] = esc_attr( stripslashes( $options[$id] ) ); 
		} else {
			$options[$id] = 0;
		}
	} else { 
		$options[$id] = $default; 
	}
	
	switch ( $type ) { 

	case 'check': 
		echo "<input class='$class' type='checkbox' id='$id' name='" . $option_name . "[$id]' value='1'";
		echo ($options[$id] == 1) ? " checked " : ""; 
		echo "/>"; 
		echo ($desc != '') ? "<span class='description'>$desc</span>" : ""; 
		break;
	case 'text': 
		echo "<input class='$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' size='60' $rule />"; 
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 
		break;
	case 'number': 
		echo "<input class='$class' type='number' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' size='4' $rule />"; 
		echo ($desc != '') ? "<span class='description'> $desc</span>" : ""; 
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