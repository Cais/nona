<?php
/* ... with credits to the WordPress 3.0 default theme Twenty Ten for inspiration and code */
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 595;

/** Tell WordPress to run nona_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'nona_setup' );

if ( ! function_exists( 'nona_setup' ) ):
function nona_setup() {
  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style(); /* see TO-DO list in readme.txt */ 
  
  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
  
  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );
  
  // This theme allows users to set a custom background
  add_custom_background();
  
  // Add wp_nav_menu() custom menu support
  function nona_nav_menu() {
    if ( function_exists( 'wp_nav_menu' ) ) 
      wp_nav_menu( array(
			 'theme_location' => 'top-menu',
			 'depth' => 1,
			 'fallback_cb' => 'nona_page_menu'
			 ) );
    else
      nona_page_menu();      
  }
    
  function nona_page_menu() {
    wp_page_menu( 'show_home=1&depth=1' );
  }
  
  add_action( 'init', 'register_nona_menu' );
  function register_nona_menu() {
    register_nav_menu( 'top-menu', __( 'Top Menu' ) );
  }
  // wp_nav_menu() end

  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'nona', TEMPLATEPATH . '/languages' );
  $locale = get_locale();
  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );
}
endif;

// Get the page number
function nona_get_page_number() {
  if ( get_query_var( 'paged' ) ) {
    print ' | ' . __( 'Page ' , 'nona' ) . get_query_var( 'paged' );
  }
}
// end get_page_number

// bns_menu
function bns_menu( $menu, $args ) {
  if ( is_home() || is_front_page() ) {
    $args['show_home'] = false;
    $args['echo'] = false;
    $args['depth'] = 1;
    remove_filter( 'wp_page_menu', 'bns_menu', 10, 2 );
    $menu = wp_page_menu( $args );
  }
  return $menu; // no need to remake the menu if nothing changed
}
add_filter( 'wp_page_menu', 'bns_menu', 10, 2 );
// End bns_menu

// nona_login
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
// End nona_login

// BNS Dynamic Copyright
function bns_dynamic_copyright() {
    /* Get all posts */
    $all_posts = get_posts( 'post_status=publish&order=ASC' );
    /* Get first post */
    $first_post = $all_posts[0];
    /* Get date of first post */
    $first_date = $first_post->post_date_gmt;
    $first_year = substr( $first_date, 0, 4 );
    if ( $first_year == '' ) {
      $first_year = date( 'Y' );
    }
    
    /* Display common footer copyright notice */
    _e( 'Copyright &copy; ' );
    /* Display first post year and current year */
    if ( $first_year == date( 'Y' ) ) {
    /* Only display current year if no posts in previous years */
    	echo date( 'Y' );
    } else {
      echo $first_year . "-" . date( 'Y' );
    }
    /* Display blog name from 'General Settings' page */
    echo '  <strong>' . get_bloginfo( 'name' ) . '</strong>  ';
    _e( 'All rights reserved.' );
}
// End BNS Dynamic Copyright

// BNS Theme Version
function bns_theme_version() {
    $theme_version = ''; /* Clear variable */
    /* Get details of the theme / child theme */
    $blog_css_url = get_stylesheet_directory() . '/style.css';
    $my_theme_data = get_theme_data( $blog_css_url );
    $parent_blog_css_url = get_template_directory() . '/style.css';
    $parent_theme_data = get_theme_data( $parent_blog_css_url );
    
    /* Create and append to string to be displayed */
    $theme_version .= $my_theme_data['Name'] . ' v' . $my_theme_data['Version'];
    if ( $blog_css_url != $parent_blog_css_url ) {
      $theme_version .= ' a child of the ' . $parent_theme_data['Name'] . ' v' . $parent_theme_data['Version'];
    }
    $theme_version .= ' theme from <a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>.';
    /* Display string */
    echo '<br />' . '<span class="version">' . $theme_version . '</span><!-- .version -->';
}
// End BNS Theme Version

// Widgetizing
if ( function_exists( 'register_sidebar' ) )
  register_sidebars( 3, array(
                              'before_widget' => '<div class="widget-top"></div><div class="widget">',
                              'after_widget' => '</div><!-- .widget--><div class="widget-bottom"></div>',
                              'before_title' => '<h2 class="widget-title">',
                              'after_title' => '</h2>',
                              )
                    );
  register_sidebar( array(
                              'name' => 'Footer Left',
                              'id' => 'footer-left',
                              'before_widget' => '<div class="widget-top"></div><div class="footer-widget">',
                              'after_widget' => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
                              'before_title' => '<h2 class="widget-title">',
                              'after_title' => '</h2>',
                          )
                   );
  register_sidebar( array(
                              'name' => 'Footer Middle',
                              'id' => 'footer-middle',
                              'before_widget' => '<div class="widget-top"></div><div class="footer-widget">',
                              'after_widget' => '</div><!-- .footer-widget--><div class="widget-bottom"></div>',
                              'before_title' => '<h2 class="widget-title">',
                              'after_title' => '</h2>',
                          )
                   );
  register_sidebar( array(
                              'name' => 'Footer Right',
                              'id' => 'footer-right',
                              'before_widget' => '<div class="widget-top"></div><div class="footer-widget">',
                              'after_widget' => '</div><!--.footer-widget--><div class="widget-bottom"></div>',
                              'before_title' => '<h2 class="widget-title">',
                              'after_title' => '</h2>',
                          )
                   );
// End Widgetizing

// Gravatar
function show_avatar( $comment, $size ) {
  $email = strtolower( trim( $comment->comment_author_email ) );
  $rating = "G"; // [G | PG | R | X]
  if ( function_exists( 'get_avatar' ) ) {
    echo get_avatar( $email, $size );
  } else {
    $grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($emaill) . "&size=" . $size . "&rating=" . $rating;
    echo "<img src='$grav_url'/>";
  }
}
// End Gravatar
?>
<?php /* Last Revision: January 12, 2011 v1.3 */ ?>