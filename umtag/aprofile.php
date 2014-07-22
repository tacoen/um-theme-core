<?php
/* umtag: aprofile
 *
 */
 
defined('ABSPATH') or die('huh?');
function umtag_aprofile($curauth) {
// Syntax:
// $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
// umtag('aprofile',$curauth);
echo "<div id='profile'>";
echo "<div class='profile_pic'><img src='". $curauth->photo_url ."' class='photo'/></div>\n";
echo "<h1>". $curauth->display_name ."</h1>\n";
echo "<p class='profile_realname'>".$curauth->first_name. " ". $curauth->last_name ."</p>";
if (!empty($curauth->user_url)) { 
	echo "<p class='profile_bio'>". $curauth->description . "</p>\n";
} else {
	echo "<p>Still remain anonymous, my friends</p>";
}
if (!empty($curauth->user_url)) { echo "<p><i class='umi-earth'></i><a href='". $curauth->user_url . "'>". $curauth->user_url ."</a></p>\n"; }
if (!empty($curauth->facebook)) { echo "<p><i class='umi-facebook'></i><a href='". $curauth->facebook . "'>". $curauth->facebook ."</a></p>\n"; }
if (!empty($curauth->twitter)) { echo "<p><i class='umi-twitter'></i><a href='". $curauth->twitter . "'>". $curauth->twitter ."</a></p>\n"; }

echo "</div><!-- eo profile -->\n";


}