<?php
/* umtag: wpmetas
 *
 */
 
defined('ABSPATH') or die('huh?');
function umtag_wpmetas() { ?>
<aside id="meta" class="widget">
<h1 class="widget-title"><?php _e('Meta', 'um'); ?></h1>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<?php wp_meta(); ?>
</ul>
</aside><?php }
