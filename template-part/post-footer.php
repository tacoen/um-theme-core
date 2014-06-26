<?php
/**
 * @package um
 */
?>

<footer class="entry-meta">
		<?php if('post' == get_post_type()): // Hide category and tag text for pages on Search ?>
		
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(__(', ', 'um'));
				if($categories_list && um_categorized_blog()):?>
					<div class="cat-links"><i class="umi-folder"></i>
					<?php printf(__('<span class="text">Posted in</span> %1$s', 'um'), $categories_list); ?>
					</div>
				<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list('', __(', ', 'um'));
				if($tags_list):?>
					<div class="tags-links"><i class="umi-tag"></i>
					<?php printf(__('<span class="text">Tagged</span> %1$s', 'um'), $tags_list); ?>
					</div>
				<?php endif; // End if $tags_list ?>
		
		<?php endif; // End if 'post' == get_post_type()?>

		<?php if(! post_password_required()&&(comments_open()|| '0' != get_comments_number())): ?>
			<div class="comments-link"><i class="umi-comment"></i>
			<?php comments_popup_link(__('Leave a comment', 'um'), __('1 Comment', 'um'), __('% Comments', 'um')); ?>
			</div>
		<?php endif; ?>

		<?php edit_post_link(__('Edit', 'um'), '<div class="edit-link"><i class="umi-edit"></i>', '</div>'); ?>

</footer><!-- .entry-meta -->

