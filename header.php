<?php
/**
 * Header Template
 *
 * @package     NoNa
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/nona/
 * @link        https://github.com/Cais/nona/
 * @link        http://wordpress.org/extend/themes/nona
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 *
 * @version     1.6
 * @date        July 10, 2012
 * Updated `wp_title` usage
 *
 * @version     1.8
 * @date        March 14, 2013
 * Updated DOCTYPE and other related header elements
 * Code formatting to be more easily read
 * Move Comment Reply script enqueue to 'functions.php'
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="outside"><!-- closes in 'footer.php' -->

	<div id="header">

		<div id="header-top">

			<div id="header-title">

				<div id="blog-title">
					<a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</div>
				<!-- #blog-title -->

				<div id="blog-description">
					<?php bloginfo( 'description' ); ?>
				</div>
				<!-- .blog-description -->

			</div>
			<!-- #header-title -->

		</div>
		<!-- #header-top -->

		<div id="header-middle">

			<div id="top-navigation-menu">
				<?php nona_nav_menu(); ?>
			</div>
			<!-- #top-navigation -->

			<div class="clear"></div>

		</div>
		<!-- #header-middle -->

		<div id="header-bottom"></div>

	</div>
	<!-- #header -->