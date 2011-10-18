<?php get_header(); ?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <?php if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-details">
                        <?php printf( __('Posted by %1$s on ', 'nona'), get_the_author_meta( 'display_name' ) );
                        if ( get_the_title() == "" ) { /* for posts without titles - creates a permalink using the post date referencing the post ID */ ?>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to post ', 'nona' ); the_id(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
                        <?php } else {
                            the_time( get_option( 'date_format' ) );
                        }
                        comments_popup_link( __( ' with No Comments', 'nona' ), __( ' with 1 Comment', 'nona' ), __( ' with % Comments', 'nona' ), '', __( ' with Comments Closed', 'nona' ) );
                        edit_post_link( __( 'Edit', 'nona' ), __( '&#124;', 'nona' ), __( '', 'nona' ) ); ?><br />
                        <?php _e( 'in ', 'nona' ); the_category( ', ' ); ?><br />
                        <?php the_tags( __( 'as ', 'nona' ), ', ', '' ); ?><br />
                    </div> <!-- .post-details -->
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
                    }
                    the_content( __( 'Read more... ', 'nona' ) ); ?>
                    <div class="clear"></div> <!-- For inserted media at the end of the post -->
                    <?php wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'nona') . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>
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
    </div> <!-- #content -->
    <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php /* Last revised October 17, 2011 v1.4 */ ?>