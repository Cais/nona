<?php get_header(); ?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <?php if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-details">
                        <?php printf( __( 'Posted by %1$s on %2$s ', 'nona' ), get_the_author_meta( 'display_name' ), get_the_time( get_option( 'date_format' ) ) ); ?> | <a class="rss" href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php _e( 'Subscribe to my feed', 'nona' ); ?>"><?php _e( 'Subscribe', 'nona' ); ?></a>
                        <?php edit_post_link( __( 'Edit', 'nona' ), __( '&#124;', 'nona' ), __( '', 'nona' ) ); ?><br />
                        <?php _e( ' in ', 'nona' ); the_category( ', ' ); ?><br />
                        <?php the_tags( __( 'as ', 'nona' ), ', ', '' ); ?><br />
                    </div> <!-- .post-details -->
                    <?php the_content( __( 'Read more ...', 'nona' ) ); ?>
                    <div class="clear"></div> <!-- For inserted media at the end of the post -->
                    <?php wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'nona') . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>
                    <div id="author_link">
                        <?php printf( __( '... other posts by %1$s', 'nona' ), '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author_meta( 'display_name' ) . '</a>' ); ?>
                    </div>
                </div> <!-- .post #post-ID -->
                <?php comments_template(); ?>
            <?php endwhile; ?>
            <div id="nav-global" class="navigation">
                <div class="left">
                    <?php echo previous_post_link(); ?>
                </div>
                <div class="right">
                    <?php echo next_post_link(); ?>
                </div>
            </div> <!-- .navigation -->
            <div class="clear"></div>
        <?php else : ?>
            <h2><?php printf( __( 'Search Results for: %s', 'nona' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
            <p><?php _e( 'Sorry, but you are looking for something that is not here.', 'nona' ); ?></p>
            <?php get_search_form();
        endif; ?>
    </div> <!-- #content -->
    <div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
<?php /* Last revised October 17, 2011 v1.4 */ ?>