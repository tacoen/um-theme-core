<?php

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */

if ( ! function_exists( 'um_wp_title' ) ) :

function um_wp_title($title, $sep, $seplocation) {

	global $page, $paged;
	$suf_title = get_bloginfo( 'name', 'display' ) . " - ";
	$site_description = get_bloginfo( 'description', 'display' );

	if (empty($title))  { $title = $site_description; }
	
	$title = preg_replace("#\s+\W\s+$#","",$title);
	$new_title = $suf_title.$title;
	
	if ( is_feed() )    { $new_title = "$suf_title Feed"; }
	if ( is_404() )     { $new_title = "$suf_title $site_description"; }
	if ( is_archive() ) { $new_title = "$suf_title Archive > $title"; }

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$new_title = "$suf_title $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$new_title = $title . " - " . sprintf( __( 'Page %s', 'um' ), max( $paged, $page ) );
	}

	return $new_title;
}

add_filter( 'wp_title', 'um_wp_title', 10, PHP_INT_MAX-5 );

endif;

/* Fix 10px on image */

class um_fixImageMargins{

	public $xs = 0; //change this to change the amount of extra spacing
	public function __construct(){
		add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
	}
	public function fixme($x=null, $attr, $content){
		extract(shortcode_atts(array(
			'id' => '',
			'align' => 'alignnone',
			'width' => '',
			'caption' => ''
			), 
		$attr));

	if ( 1 > (int) $width || empty($caption) ) {
		return $content;
	}

	if ( $id ) $id = 'id="' . $id . '" ';

	return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'. 
	$content . '<p class="wp-caption-text">' . $caption . '</p></div>';

	}

}