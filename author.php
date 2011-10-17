<?php get_header(); ?>
<?php /* Set the $curauth variable */
    $curauth = ( get_query_var( 'author_name ') ) ? get_user_by( 'id', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <div id="author" class="<?php if ( user_can( $curauth, 'manage_options' ) ) echo 'administrator'; ?>">
            <h2><?php _e( 'About ', 'nona' ); ?><?php echo $curauth->display_name; ?></h2>
            <ul>
                <li><?php _e( 'Website', 'nona' ); ?>: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a> <?php _e( 'or', 'nona' ); ?> <a href="mailto:<?php echo $curauth->user_email; ?>"><?php _e( 'email', 'nona' ); ?></a></li>
                <li><?php _e( 'Biography', 'nona' ); ?>: <?php echo $curauth->user_description; ?></li>
            </ul>
        </div> <!-- #author -->
        <h2><?php _e( 'Posts by ', 'nona' ); ?><?php echo $curauth->display_name; ?>:</h2>

        <!-- start the Loop -->
        <?php if ( have_posts() ) : ?>
            <?php $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php $count++; ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-details">
                        <?php _e( ' on ', 'nona' ); the_time( get_option( 'date_format' ) );
                         comments_popup_link( __( ' with No Comments', 'nona' ), __( ' with 1 Comment', 'nona' ), __( ' with % Comments', 'nona' ), '', __( ' with Comments Closed', 'nona' ) );
                         edit_post_link( __( 'Edit', 'nona' ), __( '&#124; ', 'nona' ), __( '', 'nona' ) ); ?><br />
                        <?php _e( ' in ', 'nona' ); the_category( ', ' ); ?><br />
                        <?php the_tags( __( 'as ', 'nona' ), ', ', '' ); ?><br />
                    </div> <!-- .post-details -->
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
                    }
                    if ( $count == 1 ) :
                        the_content();
                    else :
                        the_excerpt();
                    endif; ?>
                    <div class="clear"></div> <!-- For inserted media at the end of the post -->
                </div> <!-- .post #post-ID -->
            <?php endwhile; ?>
            <div id="nav-global" class="navigation">
                <div class="left">
                    <?php next_posts_link( __( '&laquo; Previous entries ', 'nona' ) ); ?>
                </div>
                <div class="right">
                    <?php previous_posts_link( __( ' Next entries &raquo;', 'nona' ) ); ?>
                </div>
            </div> <!-- .navigation -->
            <div class="clear"></div>
        <?php else : ?>
            <h2><?php printf( __( 'Search Results for: %s', 'nona' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
            <p><?php _e( 'Sorry, but you are looking for something that is not here.', 'nona' ); ?></p>
            <?php get_search_form();
    endif; ?>
        <!-- end the Loop -->
    </div> <!-- #content -->
    <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar();
get_footer();?>
<?php /* Last revised October 16, 2011 v1.4 */ ?>