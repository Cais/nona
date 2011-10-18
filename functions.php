<?php
/* ... with credits to the Twenty Ten theme from WordPress for inspiration and code */

/*
 * Set the content width based on the theme's design and stylesheet.
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 **/

if ( ! isset( $content_width ) )
    $content_width = 595;

/** Tell WordPress to run nona_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'nona_setup' );

if ( ! function_exists( 'nona_setup' ) ):
    function nona_setup() {
            // This theme styles the visual editor with editor-style.css to match the theme style.
            add_editor_style();

            // This theme uses post thumbnails
            add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

            // Add default posts and comments RSS feed links to head
            add_theme_support( 'automatic-feed-links' );

            // This theme allows users to set a custom background
            add_custom_background();

            // Add wp_nav_menu() custom menu support
            if ( ! function_exists( 'nona_nav_menu' ) ) {
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
                function nona_list_pages() {
                        if ( is_home() || is_front_page() ) { ?>
                            <ul class="nav-menu"><?php wp_list_pages( 'title_li=' ); ?></ul>
                        <?php } else { ?>
                            <ul class="nav-menu">
                                <li><a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'nona' ); ?></a></li>
                                <?php wp_list_pages( 'title_li=' ); ?>
                            </ul>
                        <?php }
                }
            }

            add_action( 'init', 'register_nona_menu' );
            if (! function_exists( 'register_nona_menu' ) ) {
                function register_nona_menu() {
                        register_nav_menu( 'top-menu', __( 'Top Menu', 'nona' ) );
                }
            }
            // wp_nav_menu() end

            // Make theme available for translation
            // Translations can be filed in the /languages/ directory
            load_theme_textdomain( 'nona', get_template_directory_uri() . '/languages' );
            $locale = get_locale();
            $locale_file = get_template_directory_uri() . "/languages/$locale.php";
            if ( is_readable( $locale_file ) )
                require_once( $locale_file );
    }
endif;

// nona_login
if ( ! function_exists( 'nona_login' ) ) {
    function nona_login() {
            $login_url = home_url() . '/wp-admin/';
            if ( is_user_logged_in() ) {
                echo '<div id="nona-logged-in" class="nona-login">' . __( 'You are logged in! ' );
                if ( function_exists( 'get_current_site' ) ) { // WPMU, Multisite - logout returns to WPMU, or Multisite, main domain page
                    $current_site = get_current_site();
                    $home_domain = 'http://' . $current_site->domain . $current_site->path;
                    echo '<a href="' . wp_logout_url( $home_domain ) . '" title="' . __( 'Logout', 'nona' ) . '">' . __( 'Logout', 'nona' ) . '</a>';
                } else {
                    echo '<a href="' . wp_logout_url( home_url() ) . '" title="' . __( 'Logout', 'nona' ) . '">' . __( 'Logout', 'nona' ) . '</a>';
                }
                echo __( ' or go to the ', 'nona' ) . '<a href="' . $login_url . '" title="' . __( 'dashboard', 'nona' ) . '">' . __( 'dashboard', 'nona' ) . '</a>.</div>';
            } else { // Return to blog home page
                echo '<div id="nona-logged-out" class="nona-login"><a href="' . $login_url . '" title="' . __( 'Log in here', 'nona' ) . '">' . __( 'Log in here!', 'nona' ) . '</a></div>';
            }
    }
}
// End nona_login

/* NoNa Dynamic Copyright
 * Derived from the original BNS Dynamic Copyright
 *
 * @version: 1.4
 * @since: October 12, 2011
 *
 */
if ( ! function_exists( 'nona_dynamic_copyright' ) ) {
    function nona_dynamic_copyright( $args = '' ) {
            $initialize_values = array( 'start' => '', 'copy_years' => '', 'url' => '', 'end' => '' );
            $args = wp_parse_args( $args, $initialize_values );

            /* Initialize the output variable to empty */
            $output = '';

            /* Start common copyright notice */
            empty( $args['start'] ) ? $output .= sprintf( __('Copyright', 'nona') ) : $output .= $args['start'];

            /* Calculate Copyright Years; and, prefix with Copyright Symbol */
            if ( empty( $args['copy_years'] ) ) {
                /* Get all posts */
                $all_posts = get_posts( 'post_status=publish&order=ASC' );
                /* Get first post */
                $first_post = $all_posts[0];
                /* Get date of first post */
                $first_date = $first_post->post_date_gmt;

                /* First post year versus current year */
                $first_year = substr( $first_date, 0, 4 );
                if ( $first_year == '' ) {
                    $first_year = date( 'Y' );
                }

                /* Add to output string */
                if ( $first_year == date( 'Y' ) ) {
                    /* Only use current year if no posts in previous years */
                    $output .= ' &copy; ' . date( 'Y' );
                } else {
                    $output .= ' &copy; ' . $first_year . "-" . date( 'Y' );
                }
            } else {
                $output .= ' &copy; ' . $args['copy_years'];
            }

            /* Create URL to link back to home of website */
            empty( $args['url'] ) ? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) .'</a>  ' : $output .= ' ' . $args['url'];

            /* End common copyright notice */
            empty( $args['end'] ) ? $output .= ' ' . sprintf( __( 'All rights reserved.', 'nona' ) ) : $output .= ' ' . $args['end'];

            /* Construct and sprintf the copyright notice */
            $output = sprintf( __( '<span id="bns-dynamic-copyright"> %1$s </span><!-- #bns-dynamic-copyright -->', 'nona' ), $output );
            $output = apply_filters( 'nona_dynamic_copyright', $output, $args );

            echo $output;
    }
}
// End BNS Dynamic Copyright

/* NoNa Theme Version
 * Derived from the original BNS Theme Version
 *
 * @version: 1.4
 * @since: October 12, 2011
 *
 **/
if ( ! function_exists( 'nona_theme_version' ) ) {
    function nona_theme_version () {
            $blog_css_url = get_stylesheet_directory() . '/style.css';
            $my_theme_data = get_theme_data( $blog_css_url );
            $parent_blog_css_url = get_template_directory() . '/style.css';
            $parent_theme_data = get_theme_data( $parent_blog_css_url );

            if ( is_child_theme() ) {
                printf( __( '<br /><span id="bns-theme-version">%1$s, v%2$s, accessorizes the %3$s theme, v%4$s, created by <a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>.</span>', 'nona' ), $my_theme_data['Name'], $my_theme_data['Version'], $parent_theme_data['Name'], $parent_theme_data['Version'] );
            } else {
                printf( __( '<br /><span id="bns-theme-version">Dressed in the %1$s theme, version %2$s, from %3$s.</span>', 'nona' ), $my_theme_data['Name'], $my_theme_data['Version'], '<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>' );
            }
    }
}
// End: NoNa Theme Version

// Widgets
register_sidebars( 3, array(
                           'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="widget %2$s">',
                           'after_widget' => '</div><!-- .widget--><div class="widget-bottom"></div>',
                           'before_title' => '<h2 class="widget-title">',
                           'after_title' => '</h2>',
                            ) );
register_sidebar( array(
                       'name' => 'Footer Left',
                       'id' => 'footer-left',
                       'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
                       'after_widget' => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
                       'before_title' => '<h2 class="widget-title">',
                       'after_title' => '</h2>',
                        ) );
register_sidebar( array(
                       'name' => 'Footer Middle',
                       'id' => 'footer-middle',
                       'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
                       'after_widget' => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
                       'before_title' => '<h2 class="widget-title">',
                       'after_title' => '</h2>',
                        ) );
register_sidebar( array(
                       'name' => 'Footer Right',
                       'id' => 'footer-right',
                       'before_widget' => '<div class="widget-top"></div><div id="%1$s" class="footer-widget %2$s">',
                       'after_widget' => '</div><!--.footer-widget--><div class="widget-bottom"></div>',
                       'before_title' => '<h2 class="widget-title">',
                       'after_title' => '</h2>',
                        ) );
// End Widgets
?>
<?php /* Last revised October 17, 2011 v1.4 */ ?>