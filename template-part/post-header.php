<?php
/**
 * @package um
 */
 
 //make different munculan
?>
<header class="entry-header">
	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" class="hot" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php if('post' == get_post_type()) {
	if (!is_sticky()) {?>
	<div class="entry-meta">
	<?php um_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php }
	} else { ?>
	<div class="entry-meta">
	<?php echo get_post_type() ?>
	<?php um_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php } ?>

</header><!-- .entry-header -->
