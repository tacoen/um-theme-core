<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package um
 */
?>
	<div id="secondary" class="widget-area site-side" role="complementary">
		<?php if(! dynamic_sidebar('sidebar-1')): ?>
			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e('Archives', 'um'); ?></h1>
				<ul>
					<?php wp_get_archives(array('type' => 'monthly')); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e('Meta', 'um'); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
