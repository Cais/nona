<?php
/**
 * Functions
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
 * @version     1.7
 * @date        December 10, 2012
 * PHPDocs style documentation updates and additions
 *
 * @version     1.8
 * @date        March 15, 2013
 * Deprecated `nona-login`
 * Refactored widget area definitions into `nona_widgets` function and attached to `widgets_init` action hook
 *
 * @version     1.8.1
 * @date        July 18, 2013
 * Added constant 'NONA_HOME_URL'
 * Added function `nona_show_featured_image( $size )`
 */

/** ... with credits to the Twenty Ten theme from WordPress for inspiration and code */

define( 'NONA_HOME_URL', 'BuyNowShop.com' );

/**
 * Set the content width based on the theme's design and stylesheet.
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 595;
}
/** End if - not isset content width */

add_action( 'after_setup_theme', 'nona_setup' );
if ( ! function_exists( 'nona_setup' ) ) {
	/**
	 * NoNa Setup
	 *
	 * Tell WordPress to run nona_setup() when the 'after_setup_theme' hook is run.
	 *
	 * @version 1.6
	 * @date    July 10, 2012
	 * Removed deprecated function call to `add_custom_background`
	 */
	function nona_setup() {
		global $wp_version;
		/** This theme styles the visual editor with editor-style.css to match the theme style. */
		add_editor_style();
		/** This theme uses post thumbnails */
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
		/** Add default posts and comments RSS feed links to head */
		add_theme_support( 'automatic-feed-links' );

		/** This theme allows users to set a custom background */
		add_theme_support( 'custom-background', array(
			'default-color' => '000000',
			'default-image' => get_template_directory_uri() . '/images/GrungeOverlayTileSmall.png'
		) );


		/** wp_nav_menu support */
		if ( ! function_exists( 'nona_nav_menu' ) ) {
			/**
			 * NoNa Nav Menu
			 * Add wp_nav_menu() custom menu support
			 *
			 * @package NoNa
			 *
			 * @uses    wp_nav_menu
			 */
			function nona_nav_menu() {
				wp_nav_menu( array(
					'menu_class'     => 'nav-menu',
					'theme_location' => 'top-menu',
					'fallback_cb'    => 'nona_list_pages'
				) );
			}
			/** End function - nav menu */
		}
		/** End if - function exists */


		if ( ! function_exists( 'nona_list_pages' ) ) {
			/**
			 * NoNa List Pages
			 *
			 * @package NoNa
			 *
			 * @uses    wp_list_pages
			 */
			function nona_list_pages() {
				?>
				<ul class="nav-menu"><?php wp_list_pages( 'title_li=' ); ?></ul>
			<?php
			}
			/** End function - list pages */
		}
		/** End if - function exists */
		register_nav_menu( 'top-menu', __( 'Top Menu', 'nona' ) );
		/** End wp_nav_menu support */

		/**
		 * Make theme available for translation
		 * @internal Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( 'nona', get_template_directory_uri() . '/languages' );
		$locale      = get_locale();
		$locale_file = get_template_directory_uri() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		/** End if - is readable */

	}
	/** End function - setup */
}
/** End if - function exists */


if ( ! function_exists( 'nona_dynamic_copyright' ) ) {
	/**
	 * NoNa Dynamic Copyright
	 *
	 * @package NoNa
	 * @since   1.4
	 *
	 * @param   string $args
	 *
	 * @uses    apply_filters
	 * @uses    get_bloginfo
	 * @uses    get_posts
	 * @uses    home_url
	 * @uses    post_date_gmt
	 * @uses    wp_parse_args
	 */
	function nona_dynamic_copyright( $args = '' ) {
		$initialize_values = array( 'start' => '', 'copy_years' => '', 'url' => '', 'end' => '' );
		$args              = wp_parse_args( $args, $initialize_values );

		/** Initialize the output variable to empty */
		$output = '';

		/** Start common copyright notice */
		empty( $args['start'] ) ? $output .= sprintf( __( 'Copyright', 'nona' ) ) : $output .= $args['start'];

		/** Calculate Copyright Years; and, prefix with Copyright Symbol */
		if ( empty( $args['copy_years'] ) ) {
			/** Get all posts */
			$all_posts = get_posts( 'post_status=publish&order=ASC' );
			/** Get first post */
			$first_post = $all_posts[0];
			/** Get date of first post */
			$first_date = $first_post->post_date_gmt;

			/** First post year versus current year */
			$first_year = substr( $first_date, 0, 4 );
			if ( $first_year == '' ) {
				$first_year = date( 'Y' );
			}
			/** End if - first year */

			/** Add to output string */
			if ( $first_year == date( 'Y' ) ) {
				/** Only use current year if no posts in previous years */
				$output .= ' &copy; ' . date( 'Y' );
			} else {
				$output .= ' &copy; ' . $first_year . "-" . date( 'Y' );
			}
			/** End if - first year */

		} else {

			$output .= ' &copy; ' . $args['copy_years'];

		}
		/** End if - empty - copy years */

		/** Create URL to link back to home of website */
		empty( $args['url'] )
			? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a>  '
			: $output .= ' ' . $args['url'];

		/** End common copyright notice */
		empty( $args['end'] )
			? $output .= ' ' . sprintf( __( 'All rights reserved.', 'nona' ) )
			: $output .= ' ' . $args['end'];

		/** Construct and sprintf the copyright notice */
		$output = sprintf( __( '<span id="nona-dynamic-copyright"> %1$s </span><!-- #nona-dynamic-copyright -->', 'nona' ), $output );
		echo apply_filters( 'nona_dynamic_copyright', $output, $args );

	}
	/** End function - dynamic copyright */
}
/** End if - function exists */


if ( ! function_exists( 'nona_theme_version' ) ) {
	/**
	 * NoNa Theme Version
	 *
	 * @package NoNa
	 * @since   1.4
	 *
	 * @uses    is_child_theme
	 * @uses    wp_get_theme
	 * @uses    WP_Theme::parent
	 *
	 * @version 1.6
	 * @date    July 10, 2012
	 * Removed deprecated function call to `get_theme_data`
	 *
	 * @version 1.7
	 * @date    December 10, 2012
	 * Minor change to output text
	 *
	 * @version 1.8.1
	 * @date    April 23, 2013
	 * Used 'NONA_HOME_URL' where appropriate
	 */
	function nona_theme_version() {
		/** @var $active_theme_data - array object containing the current theme's data */
		$active_theme_data = wp_get_theme();
		if ( is_child_theme() ) {
			/** @var $parent_theme_data - array object containing the Parent Theme's data */
			$parent_theme_data = $active_theme_data->parent();
			printf( __( '<br /><span id="nona-theme-version">%1$s (v%2$s) accessorizes the %3$s theme (v%4$s) created by %5$s.</span>', 'nona' ),
				$active_theme_data['Name'],
				$active_theme_data['Version'],
				$parent_theme_data['Name'],
				$parent_theme_data['Version'],
				'<a href="http://' . NONA_HOME_URL . '" title="' . NONA_HOME_URL . '">' . NONA_HOME_URL . '</a>' );
		} else {
			printf( __( '<br /><span id="nona-theme-version">This site is dressed in the %1$s theme (v%2$s) from %3$s.</span>', 'nona' ),
				$active_theme_data['Name'],
				$active_theme_data['Version'],
				'<a href="http://' . NONA_HOME_URL . '" title="' . NONA_HOME_URL . '">' . NONA_HOME_URL . '</a>' );
		}
		/** End if - is child theme */

	}
	/** End function - theme version */
}
/** End if - function exists */


/**
 * Widgets Areas
 *
 * @uses    register_sidebar
 */
function nona_widgets() {
	register_sidebar( array(
		'name'          => __( 'Sidebar 1', 'nona' ),
		'description'   => __( 'First sidebar area located on the right side of the layout. This contains the default theme sidebar widgets. Drag and drop a widget into this to clear *ALL* of the default widgets of the theme.', 'nona' ),
		'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div><!-- .widget--><div class="widget-bottom"></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar 2', 'nona' ),
		'description'   => __( 'Second sidebar area located on the right side of the layout', 'nona' ),
		'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div><!-- .widget--><div class="widget-bottom"></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'nona' ),
		'description'   => __( 'Third sidebar area located on the right side of the layout', 'nona' ),
		'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div><!-- .widget--><div class="widget-bottom"></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'nona' ),
		'id'            => 'footer-left',
		'description'   => __( 'Sidebar area located at the bottom of the theme to the left side of the layout.', 'nona' ),
		'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Middle', 'nona' ),
		'id'            => 'footer-middle',
		'description'   => __( 'Sidebar area located at the bottom of the theme in the middle of the layout.', 'nona' ),
		'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'nona' ),
		'id'            => 'footer-right',
		'description'   => __( 'Sidebar area located at the bottom of the theme to the right side of the layout.', 'nona' ),
		'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div><!--.footer-widget--><div class="widget-bottom"></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

/** End function - widgets */
add_action( 'widgets_init', 'nona_widgets' );


if ( ! function_exists( 'nona_wp_title' ) ) {
	/**
	 * NoNa WP Title
	 * Utilizes the `wp_title` filter to add text to the default output
	 *
	 * @package          NoNa
	 * @since            1.6
	 *
	 * @link             http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
	 * @link             https://gist.github.com/1410493
	 *
	 * @param   string $old_title - default title text
	 * @param   string $sep       - separator character
	 *
	 * @uses    (global) var $page
	 * @uses    (global) var $paged
	 * @uses             get_bloginfo
	 * @uses             is_front_page
	 * @uses             is_home
	 *
	 * @return  string - new title text
	 *
	 * @version			1.9
	 * @date			December 28, 2013
	 * Removed the unused variable `$sep_location`
	 */
	function nona_wp_title( $old_title, $sep ) {
		global $page, $paged;
		/** Set initial title text */
		$nona_title_text = $old_title . get_bloginfo( 'name' );
		/** Add wrapping spaces to separator character */
		$sep = ' ' . $sep . ' ';

		/** Add the blog description (tagline) for the home/front page */
		$site_tagline = get_bloginfo( 'description', 'display' );
		if ( $site_tagline && ( is_home() || is_front_page() ) ) {
			$nona_title_text .= "$sep$site_tagline";
		}
		/** End if - site tagline */

		/** Add a page number if necessary */
		if ( $paged >= 2 || $page >= 2 ) {
			$nona_title_text .= $sep . sprintf( __( 'Page %s', 'nona' ), max( $paged, $page ) );
		}

		/** End if - paged */

		return $nona_title_text;
	}
	/** End function - title */
}
/** End if - function exists */
add_filter( 'wp_title', 'nona_wp_title', 10, 2 );


/**
 * Enqueue Comment Reply Script
 * If the page being viewed is a single post/page; and, comments are open; and,
 * threaded comments are turned on then enqueue the built-in comment-reply
 * script.
 *
 * @package NoNa
 * @since   1.8
 *
 * @uses    comments_open
 * @uses    get_option
 * @uses    is_singular
 * @uses    wp_enqueue_script
 */
if ( ! function_exists( 'nona_enqueue_comment_reply' ) ) {
	function nona_enqueue_comment_reply() {
		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		/** End if - is singular */
	}
	/** End function - enqueue comment reply */
}
/** End if - function exists */
add_action( 'comment_form_before', 'nona_enqueue_comment_reply' );


/**
 * NoNa Login
 * Creates a link to the dashboard, or a login / register link.
 *
 * @package    NoNa
 * @since      1.4
 *
 * @param   string $args
 *
 * @uses       apply_filters
 * @uses       get_current_site
 * @uses       home_url
 * @uses       is_multisite
 * @uses       is_user_logged_in
 * @uses       wp_logout_url
 * @uses       wp_parse_args
 * @uses       wp_register
 *
 * @return  mixed|string|void
 *
 * @version    1.9
 * @date       December 28, 2013
 * Removed: see BNS Login http://wordpress.org/extend/plugins/bns-login
 */


/**
 * Show Featured Image
 * Displays the Featured Image allowing the size to be set
 *
 * @package NoNa
 * @since   1.8.1
 *
 * @param   $size
 *
 * @uses    has_post_thumbnail
 * @uses    the_post_thumbnail
 */
function nona_show_featured_image( $size ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size, array( 'class' => 'aligncenter' ) );
	}
	/** End if - has post thumbnail */
} /** End function - show featured image */