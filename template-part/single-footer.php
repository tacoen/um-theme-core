<?php
/**
 * @package um
 */
?>

<footer class="entry-meta"><?php
	/* translators: used between list items, there is a space after the comma */
	$category_list = get_the_category_list(__(', ', 'um'));

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list('', __(', ', 'um'));

	if(! um_categorized_blog()){
	// This blog only has 1 category so we just need to worry about tags in the meta text
	if('' != $tag_list){
		$meta_text = __('<div><i class="umi-tag"></i><span class="text"> This entry was tagged</span> %2$s</div>'.
						'<div><i class="umi-bookmark"></i><span class="text"> Bookmark the</span> <a href="%3$s" rel="bookmark">permalink</a></div>',
						'um');
	} else {
		$meta_text = __('<div><i class="umi-bookmark"></i><span class="text"> Bookmark the</span> <a href="%3$s" rel="bookmark">permalink</a></div>', 
						'um');
	}

	} else {
	// But this blog has loads of categories so we should probably display them here
	if('' != $tag_list){
		$meta_text = __('<div><i class="umi-folder"></i><span class="text"> This entry was posted in</span> %1$s</div>'.
						'<div><i class="umi-tag"></i><span class="text"> This entry was tagged</span> %2$s</div>'.
						'<div><i class="umi-bookmark"></i><span class="text"> Bookmark the</span> <a href="%3$s" rel="bookmark">permalink</a></div>',
						'um');
	} else {
		$meta_text = __('<div><i class="umi-folder"></i><span class="text"> This entry was posted in</span> %1$s</div>'.
						'<div><i class="umi-bookmark"></i><span class="text"> Bookmark the</span> <a href="%3$s" rel="bookmark">permalink</a></div>', 
						'um');
	}

	} // end check for categories on this blog

	printf(
	$meta_text,
	$category_list,
	$tag_list,
	get_permalink()
	);

	edit_post_link(__('Edit', 'um'), '<div class="edit-link"><i class="umi-edit"></i>', '</div>'); 
?></footer><!-- .entry-meta -->
