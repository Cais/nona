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
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 */

/** ... with credits to the Twenty Ten theme from WordPress for inspiration and code */

/**
 * Set the content width based on the theme's design and stylesheet.
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) ) $content_width = 595;

add_action( 'after_setup_theme', 'nona_setup' );
if ( ! function_exists( 'nona_setup' ) ):
    /**
     * NoNa Setup
     *
     * Tell WordPress to run nona_setup() when the 'after_setup_theme' hook is run.
     *
     * @version 1.5
     * Addressed deprecated function call to `add_custom_background`
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
        if ( version_compare( $wp_version, "3.4-alpha", "<" ) ) {
            add_custom_background();
        } else {
            add_theme_support( 'custom-background' /*, array(
                'default-color' => '000000',
                'default-image' => get_stylesheet_directory_uri() . '/images/GrungeOverlayTileSmall.png'
            )*/ );
        }

        if ( ! function_exists( 'nona_nav_menu' ) ) {
            /** Add wp_nav_menu() custom menu support */
            function nona_nav_menu() {
                if ( function_exists( 'wp_nav_menu' ) )
                    wp_nav_menu( array(
                        'menu_class' => 'nav-menu',
                        'theme_location' => 'top-menu',
                        'fallback_cb' => 'nona_list_pages'
                    ) );
                else
                    nona_list_pages();
            }
        }

        if ( ! function_exists( 'nona_list_pages' ) ) {
            /** NoNa List Pages */
            function nona_list_pages() { ?>
                <ul class="nav-menu"><?php wp_list_pages( 'title_li=' ); ?></ul>
            <?php
            }
        }

        add_action( 'init', 'register_nona_menu' );
        if ( ! function_exists( 'register_nona_menu' ) ) {
            function register_nona_menu() {
                register_nav_menu( 'top-menu', __( 'Top Menu', 'nona' ) );
            }
        }

        /** Make theme available for translation */
        /** Translations can be filed in the /languages/ directory */
        load_theme_textdomain( 'nona', get_template_directory_uri() . '/languages' );
        $locale = get_locale();
        $locale_file = get_template_directory_uri() . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
            require_once( $locale_file );
    }
endif;

/**
 * NoNa Login
 *
 * Creates a link to the dashboard, or a login / register link.
 *
 * @package NoNa
 * @since 1.4
 *
 * @param string $args
 * @return mixed|string|void
 *
 * Last revised April 23, 2012
 * @version 1.5
 * Added $args to function - adopted from BNS-Login plugin
 */
if ( ! function_exists( 'NoNa_Login' ) ) {
    function NoNa_Login( $args = '' ) {
        $values = array( 'login' => '', 'after_login' => '', 'logout' => '', 'goto' => '', 'separator' => '' );
        $args = wp_parse_args( $args, $values );

        /** Initialize $output - start with an empty string */
        $output = '';
        /**
         * Defaults values:
         * @var $login          string - anchor text for log in link
         * @var $after_login    string - user is logged in message
         * @var $logout         string - anchor text for log out link
         * @var $goto           string - anchor text linking to "Dashboard"
         * @var $separator      string - characters used to separate link/message texts
         * @var $sep            string - $separator wrapper for styling purposes, etc. - just in case ...
         */
        $login        = empty( $args['login'] ) ? sprintf( __( 'Log in here!', 'nona-login' ) ) : $args['login'];
        $after_login  = empty( $args['after_login'] ) ? sprintf( __( 'You are logged in!', 'nona-login' ) ) : $args['after_login'];
        $logout       = empty( $args['logout'] ) ? sprintf( __( 'Logout', 'nona-login' ) ) : $args['logout'];
        $goto         = empty( $args['goto'] ) ? sprintf( __( 'Go to Dashboard', 'nona-login' ) ) : $args['goto'];
        $separator    = empty( $args['separator'] ) ? sprintf( __( ' &deg;&deg; ' ) ) : $args['separator'];
        $sep          = '<span class="nona-login-separator">' . $separator . '</span>';

        /** The real work gets done next ...  */
        $login_url = home_url( '/wp-admin/' );
        if ( is_user_logged_in() ) {
            $output .= '<div id="nona-logged-in" class="nona-login">' . $after_login . $sep;
            /** Multisite - logout returns to Multisite main domain page */
            if ( function_exists( 'get_current_site' ) ) {
                $current_site = get_current_site();
                $home_domain = 'http://' . $current_site->domain . $current_site->path;
                $logout_url = wp_logout_url( $home_domain );
            } else {
                $logout_url = wp_logout_url( home_url() );
            }
            $output .= '<a href="' . $logout_url . '" title="' . $logout . '">' . $logout . '</a>' . $sep;
            $output .= '<a href="' . $login_url . '" title="' . $goto . '">' . $goto . '</a></div>';
        } else {
            /** if user is not logged in display login; or, register if allowed */
            $output .= '<div id="nona-logged-out" class="nona-login">';
            $output .= '<a href="' . $login_url . '" title="' . $login . '">' . $login . '</a>';
            $output .= wp_register( $sep, '', false );
            $output .= '</div>';
        }
        echo apply_filters( 'NoNa_Login', $output, $args );
    }
}


if ( ! function_exists( 'nona_dynamic_copyright' ) ) {
    /**
     * NoNa Dynamic Copyright
     *
     * @since   1.4
     *
     * @param   string $args
     */
    function nona_dynamic_copyright( $args = '' ) {
        $initialize_values = array( 'start' => '', 'copy_years' => '', 'url' => '', 'end' => '' );
        $args = wp_parse_args( $args, $initialize_values );

        /** Initialize the output variable to empty */
        $output = '';

        /** Start common copyright notice */
        empty( $args['start'] ) ? $output .= sprintf( __('Copyright', 'nona') ) : $output .= $args['start'];

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
            if ( $first_year == '' )
                $first_year = date( 'Y' );

            /** Add to output string */
            if ( $first_year == date( 'Y' ) ) {
                /** Only use current year if no posts in previous years */
                $output .= ' &copy; ' . date( 'Y' );
            } else {
                $output .= ' &copy; ' . $first_year . "-" . date( 'Y' );
            }
        } else {
            $output .= ' &copy; ' . $args['copy_years'];
        }

        /** Create URL to link back to home of website */
        empty( $args['url'] )
                ? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) .'</a>  '
                : $output .= ' ' . $args['url'];

        /** End common copyright notice */
        empty( $args['end'] )
                ? $output .= ' ' . sprintf( __( 'All rights reserved.', 'nona' ) )
                : $output .= ' ' . $args['end'];

        /** Construct and sprintf the copyright notice */
        $output = sprintf( __( '<span id="nona-dynamic-copyright"> %1$s </span><!-- #nona-dynamic-copyright -->', 'nona' ), $output );
        echo apply_filters( 'nona_dynamic_copyright', $output, $args );
    }
}

if ( ! function_exists( 'nona_theme_version' ) ) {
    /**
     * NoNa Theme Version
     *
     * @since   1.4
     *
     * Last revised April 23, 2012
     * @version 1.5
     * Addressed deprecated function call to `get_theme_data`
     */
    function nona_theme_version () {
        global $wp_version;
        if ( version_compare( $wp_version, "3.4-alpha", "<" ) ) {
            $blog_css_url = get_stylesheet_directory() . '/style.css';
            $my_theme_data = get_theme_data( $blog_css_url );
            $parent_blog_css_url = get_template_directory() . '/style.css';
            $parent_theme_data = get_theme_data( $parent_blog_css_url );

            if ( is_child_theme() ) {
                printf( __( '<br /><span id="nona-theme-version">%1$s, v%2$s, accessorizes the %3$s theme, v%4$s, created by <a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>.</span>', 'nona' ), $my_theme_data['Name'], $my_theme_data['Version'], $parent_theme_data['Name'], $parent_theme_data['Version'] );
            } else {
                printf( __( '<br /><span id="nona-theme-version">This site is dressed in the %1$s theme, version %2$s, from %3$s.</span>', 'nona' ), $my_theme_data['Name'], $my_theme_data['Version'], '<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>' );
            }
        } else {
            /** @var $active_theme_data - array object containing the current theme's data */
            $active_theme_data = wp_get_theme();
            if ( is_child_theme() ) {
                /** @var $parent_theme_data - array object containing the Parent Theme's data */
                $parent_theme_data = $active_theme_data->parent();
                printf( __( '<br /><span id="nona-theme-version">%1$s, v%2$s, accessorizes the %3$s theme, v%4$s, created by %5$s.</span>', 'nona' ),
                    $active_theme_data['Name'],
                    $active_theme_data['Version'],
                    $parent_theme_data['Name'],
                    $parent_theme_data['Version'],
                    '<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>');
            } else {
                printf( __( '<br /><span id="nona-theme-version">This site is dressed in the %1$s theme, version %2$s, from %3$s.</span>', 'nona' ),
                    $active_theme_data['Name'],
                    $active_theme_data['Version'],
                    '<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>' );
            }
        }
    }
}

/** Widgets */
register_sidebars( 3, array(
    'description'    => __( 'Sidebar located on the right side of the layout', 'nona' ),
    'before_widget'  => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
    'after_widget'   =>'</div><!-- .widget--><div class="widget-bottom"></div>',
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => '</h2>',
) );
register_sidebar( array(
    'name'           => __( 'Footer Left', 'nona' ),
    'id'             => 'footer-left',
    'description'    => __( 'Located at the bottom of the theme to the left side of the layout.', 'nona' ),
    'before_widget'  => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
    'after_widget'   => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => '</h2>',
) );
register_sidebar( array(
    'name'           => __( 'Footer Middle', 'nona' ),
    'id'             => 'footer-middle',
    'description'    => __( 'Located at the bottom of the theme in the middle of the layout.', 'nona' ),
    'before_widget'  => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
    'after_widget'   => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => '</h2>',
) );
register_sidebar( array(
    'name'           => __( 'Footer Right', 'nona' ),
    'id'             => 'footer-right',
    'description'    => __( 'Located at the bottom of the theme to the right side of the layout.', 'nona' ),
    'before_widget'  => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
    'after_widget'   => '</div><!--.footer-widget--><div class="widget-bottom"></div>',
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => '</h2>',
) ); ?>