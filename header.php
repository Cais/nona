<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <title><?php /* ... as influenced by Twenty Ten and Twenty Eleven */
        global $page, $paged;
        wp_title( '|', true, 'right' ); bloginfo( 'name' );

        // Add the blog description (tagline) for the home/front page.
        $site_tagline = get_bloginfo( 'description', 'display' );
        if ( $site_tagline && ( is_home() || is_front_page() ) )
          echo " | $site_tagline";

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
          echo ' | ' . sprintf( __( 'Page %s', 'nona' ), max( $paged, $page ) ); ?>
    </title>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
    <!--[if lte IE 7]>
        <link rel="stylesheet" href="<?php get_template_directory_uri(); ?>/ie.css" type="text/css" media="screen" />
    <![endif]-->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php if ( is_singular() )
        wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="full-screen">
        <div id="outside">
            <div id="header">
                <div id="header-top">
                    <div id="header-title">
                        <div id="blog-title"><span><a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></div>
                        <div id="blog-description">
                            <?php bloginfo( 'description' ) ?>
                            <!--[if lte IE 7]>
                                <p>This theme looks much better on a current browser, perhaps you should come to terms with the advancements of today's technology.</p>
                            <![endif]-->
                        </div> <!-- .blog-description -->
                    </div> <!-- #header-title -->
                </div> <!-- #header-top -->
                <div id="header-middle">
		        	<div id="top-navigation-menu">
				        <?php nona_nav_menu(); ?>
			        </div>
                    <div class="clear"></div>
                </div> <!-- #header-middle -->
                <div id="header-bottom"></div>
            </div> <!-- #header -->
            <div id="head2toe">
<?php /* Last revised October 9, 2011 v1.4 */ ?>