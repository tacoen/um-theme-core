<?php

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */

if ( ! function_exists( 'um_wp_title' ) ) :

function um_wp_title( $title, $sep=":" ) {

	$suf_title = get_bloginfo( 'name', 'display' );

	if ( is_feed() ) { return $suf_title.$title; }
	if ( is_404() )  { return $suf_title.$title; }
	if ( is_archive() ) { return $suf_title." $sep Archive".$title; }

	global $page, $paged;
	
	$title = $suf_title.$title;
	
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'um' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'um_wp_title', 10, 2 );

endif;
