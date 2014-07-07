<?php
/* 	umtag: breadcrumb 
 *
 */

defined('ABSPATH') or die('huh?');

function umtag_breadcrumb() { um_breadcrumb_script(); }

function um_li_catagory($num){
	$cat_string ="";
    $temp=get_the_category();
    $count=count($temp);// Getting the total number of categories the post is filed in.
    for($i=0;$i<$num&&$i<$count;$i++){
        $cat_string.='<li><a href="'.get_category_link( $temp[$i]->cat_ID  ).'">'.$temp[$i]->cat_name.'</a></li>';
        //if($i!=$num-1&&$i+1<$count)
        //$cat_string.="</li>";
    }
    echo $cat_string;
}
function um_bc_root() {
	if (is_front_page()!=is_home()) {
		echo "<li><a href='".home_url()."'>";
		echo is_front_page()? "Home" : get_bloginfo('name');
		echo is_home()? "</a></li><li><a href='".home_url()."'>blog</a></li>" : "</a></li>";
	} else {
		echo "<li><a href='".home_url()."'>Home</a></li>";
	
	}
}

function is_subpage() {
    global $post;    
    if ( is_page() && $post->post_parent ) {  
        return $post->post_parent;          
    } else {                              
        return false;                          
    }
}


function um_breadcrumb_script() {
	$n = 0; $date_format =  get_option( 'date_format' );
	global $post; 
	echo "<ul id='um-crumbs' class='small'>";

	um_bc_root();

	if (is_page() && !is_front_page() ) {
		echo is_subpage()? "<li><a href='".get_permalink($post->post_parent)."'>".get_the_title($post->post_parent)."</a></li><li>".the_title()."</li>" : "<li>".the_title()."</li>";
	} else {
	
	}

	if (is_category() || is_single()) {
		um_li_catagory(1);
						
		if (is_single()) {
			echo "</li><li>";
				the_title();
			echo '</li>';
		}
	}

	elseif (is_tag()) { echo "<li> Tag:".single_tag_title('',false)."</li>";}
	elseif (is_day()) {echo"<li>Archive for "; the_time($date_format); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}

	echo '</ul>';
}


?>