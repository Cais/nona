<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 *
 * @version     1.6
 * @date        July 10, 2012
 * Updated `wp_title` usage
 */ ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
    if ( is_singular() )
        wp_enqueue_script( 'comment-reply' );
    wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="outside">
    <div id="header">
        <div id="header-top">
            <div id="header-title">
                <div id="blog-title"><span><a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></div>
                <div id="blog-description">
                    <?php bloginfo( 'description' ); ?>
                </div><!-- .blog-description -->
            </div><!-- #header-title -->
        </div><!-- #header-top -->
        <div id="header-middle">
            <div id="top-navigation-menu">
                <?php nona_nav_menu(); ?>
            </div>
            <div class="clear"></div>
        </div><!-- #header-middle -->
        <div id="header-bottom"></div>
    </div><!-- #header -->