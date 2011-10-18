<?php
$display_date = '';
global $m;
if ( $m <> "" ) { /* works for default permalinks only */
    if ( strlen( $m ) == 8 ) {
        $display_date = strftime( "%d %B %Y", strtotime( $m ) );
    } elseif ( strlen( $m ) == 6 ) {
        $m .= "01"; /* Hack - function requires Year, Month, Day(?), at 6 characters only Year and Month are given */
        $display_date = strftime( "%B %Y", strtotime( $m ) );
    } else { /* Year only - no manipulation required */
        $display_date = $m;
    }
}
?>
<?php get_header(); ?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <div id="date-title">
            <?php global $paged;
            if ( $paged < 2 ) {
                printf( __( 'Posts by date %1$s: ', 'nona' ), $display_date );
            } else {
                printf( __( 'Page %1$s of posts by date %2$s: ', 'nona' ), $paged, $display_date );
            } ?>
        </div> <!-- #date-title -->

        <!-- start the Loop -->
        <?php if ( have_posts() ) :
            $count = 0;
            while ( have_posts() ) : the_post();
                $count++; ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-details">
                        <?php printf( __( 'Posted by %1$s on %2$s ', 'nona' ), get_the_author_meta( 'display_name' ), get_the_time( get_option( 'date_format' ) ) );
                        comments_popup_link( __( 'with No Comments', 'nona' ), __( 'with 1 Comment', 'nona' ), __( 'with % Comments', 'nona' ), '', __( 'with Comments Closed', 'nona' ) );
                        edit_post_link( __( 'Edit', 'nona' ), __( '&#124;', 'nona' ), __( '', 'nona' ) ); ?><br />
                        <?php _e( ' in ', 'nona' ); the_category( ', ' ); ?><br />
                        <?php the_tags( __( 'as ', 'nona' ), ', ', '' ); ?><br />
                    </div> <!-- .post-details -->
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
                    }
                    if ( ($count <= 3 ) && ( $paged < 2 ) ) :
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
            <?php get_search_form(); ?>
        <?php endif; ?>
        <!-- end the Loop -->
    </div> <!-- #content -->
    <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
<?php /* Last revised October 17, 2011 v1.4 */ ?>