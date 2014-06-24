<?php
/* umtag: authors
 *
 */
 
defined('ABSPATH') or die('huh?');
function umtag_authors($title) {
	if (empty($title)) { $title = "Authors"; } ?>
	<aside id="authors" class="widget">
	<h1 class="widget-title"><?php echo $title ?></h1>
	<ul>
	<?php wp_list_authors('exclude_admin=0&hide_empty=0'); ?>
	</ul>
	</aside>
<?php }
