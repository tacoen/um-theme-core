<?php get_header(); ?>

<div id="primary" class="content-area">

<main id="main" class="site-main" role="main">
	<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	umtag('aprofile',$curauth);?>
	<div class="catalog">
		<h3>Posts by <?php echo $curauth->nickname; ?>:</h3>
		<ul><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a>
			<span class='date'><?php the_time(get_option( 'date_format' )); ?></span></li>
			<?php endwhile; else: ?>
				<li><?php _e('No posts by this author.','um'); ?></li>
			<?php endif; ?>
		</ul><!-- End Loop -->
	</div><!-- catalog-->
</main><!-- #main -->

</div><!-- #primary -->

<?php get_sidebar('author'); ?>

<?php get_footer(); ?>