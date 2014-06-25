/* 

	UM-GUI-JS 
	---------
	
	https://github.com/tacoen/um-plug/wiki/UM-GUI-JS 

	um_onscroll_fixed($('.single-post .entry-header'),$('.main-navigation'),0,200);
	um_onscroll_fixed($('aside#meta'),$('#um-top'),48,$('.site-side').outerHeight());
	um_tab($('div.maketab'));
	um_toc($('div.maketoc'),'h4',"Table of Contents")

*/
var umvp_small = 540;
var umvp_medium = 800;
var window_height = jQuery(window).innerHeight();

(function($) {

$(document).ready(function(){

	um_fx_init();
	um_onscroll_fixed($('#um-top'),$('#site-navigation'),0);

});

jQuery(window).on('resize', function(){
	um_content_height( jQuery('#content') , window_height );
	um_vpToBody();
});

})( jQuery );