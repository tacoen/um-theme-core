<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package um

 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' );?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title(':', true, 'left'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<header id="masthead" class="site-header um-headimg" role="banner">
<div class="site-branding">
	<div class="inside">
		<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
		<h2 class="site-description"><?php bloginfo('description'); ?></h2>
	</div>
</div><!-- site-branding -->
<div id="um-top">
	<?php umtag('breadcrumb');?>
</div>
</header><!-- #masthead -->


<div id="content" class="site-content">