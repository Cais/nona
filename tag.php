<?php get_header(); ?>
<?php /* used to create dynamic tag link */
    $curr_tag = single_tag_title( "", false );
?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <div id="tag-title">
            <?php global $paged;
            if ( $paged < 2 ) {
                printf( __( 'First page of the %1$s archive', 'nona' ), '<span id="tag-name">' . single_tag_title( '', false ) . '</span>'  );
            } else {
                printf( __( 'Page %1$s of the %2$s archive.', 'nona' ), $paged, '<span id="tag-name"><a href="' . home_url() . '"?tag="' . $curr_tag . '" title="' . $curr_tag . '">' . single_tag_title( '', false ) . '</a></span>' );
            } ?>
        </div> <!-- #tag-title -->
        <div id="tag-description"><?php echo tag_description(); ?></div> <!-- #tag-description -->

        <!-- start the Loop -->
        <?php if ( have_posts() ) : ?>
            <?php $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php $count++; ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'nona' ); the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-details">
                        <?php _e( 'Posted by ', 'nona' ); the_author(); _e( ' on ', 'nona' ); the_time( get_option( 'date_format' ) ); ?>
                        <?php comments_popup_link( __( 'with No Comments', 'nona' ), __( 'with 1 Comment', 'nona' ), __( 'with % Comments', 'nona' ), '', __( 'with Comments Closed', 'nona' ) ); ?>
                        <?php edit_post_link( __( 'Edit', 'nona' ), __( '&#124; ', 'nona' ), __( '', 'nona' ) ); ?><br />
                        <?php _e( 'in ', 'nona' ); the_category( ', ' ); ?><br />
                        <?php the_tags( __( 'as ', 'nona' ), ', ', '' ); ?><br />
                    </div> <!-- .post-details -->
                    <?php if ( ( $count <= 2 ) && ( $paged < 2 ) ) {
                        the_content();
                    } else {
                        the_excerpt();
                    } ?>
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
<?php /* Last revised October 4, 2011 v1.4 */ ?>