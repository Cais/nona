<?php
/**
 * Header Template
 *
 * @package     NoNa
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/nona/
 * @link        https://github.com/Cais/nona/
 * @link        https://wordpress.org/themes/nona
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2016, Edward Caissie
 *
 * @version     1.8
 * @date        March 14, 2013
 * Updated DOCTYPE and other related header elements
 * Code formatting to be more easily read
 * Move Comment Reply script enqueue to 'functions.php'
 *
 * @version     1.9.2
 * @date        December 27, 2014
 * Added check for WordPress 4.1 `add_theme_support( 'title-tag' )` functionality
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<?php /** Check for WordPress 4.1 compatibility */
		if ( ! function_exists( '_wp_render_title_tag' ) ) { ?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php } ?>

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