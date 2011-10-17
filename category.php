<?php get_header(); ?>
<?php /* used to create dynamic category link */
    $curr_cat = single_cat_title( '', false );
    $cat_id = get_cat_ID( $curr_cat );
    $category_link = get_category_link ( $cat_id );
?>
<div id="main-blog">
    <div id="before-content"></div>
    <div id="content">
        <div id="category-title">
            <?php global $paged;
            if ( $paged < 2 ) {
                printf( __( 'First page of the %1$s archive', 'nona' ), '<span id="category-name">' . single_cat_title() . '</span>'  );
                /*_e( 'First page of the ', 'nona' ); ?><span id="category-name"><?php single_cat_title(); ?></span><?php _e( ' archive.', 'nona' ); */
            } else {
                _e( 'Page ', 'nona' );?><?php _e( $paged, 'nona' ); ?><?php _e( ' of the ', 'nona' ); ?><span id="category-name"><a href="<?php echo $category_link; ?>" title="<?php echo $curr_cat; ?>"><?php single_cat_title(); ?></a></span> <?php _e( 'archive.', 'nona' ); ?>
            <?php } ?>
        </div> <!-- #category-title -->
        <div id="category-description">
            <?php echo category_description(); ?>
        </div> <!-- #category-description -->

        <!-- start the Loop -->
        <?php if ( have_posts() ) : ?>
            <?php $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php $count++; ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'nona' ); ?><?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-details">
                        <?php _e( 'Posted by ', 'nona' ); the_author(); _e( ' on ', 'nona' ); the_time( get_option( 'date_format' ) ); ?>
                        <?php comments_popup_link( __( 'with No Comments', 'nona' ), __( 'with 1 Comment', 'nona' ), __( 'with % Comments', 'nona' ), '', __( 'with Comments Closed', 'nona' ) ); ?>
                        <?php edit_post_link( __( 'Edit', 'nona' ), __( '&#124; ', 'nona' ), __( '', 'nona' ) ); ?><br />
                        <?php _e( ' in ', 'nona' ); the_category( ', ' ); ?><br />
                        <?php the_tags( __( 'as ', 'nona' ), ', ', '' ); ?><br />
                    </div> <!-- .post-details -->
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
                    } ?>
                    <?php if ( ( $count <= 2 ) && ( $paged < 2 ) ) : ?>
                        <?php the_content(); ?>
                    <?php else : ?>
                        <?php the_excerpt(); ?>
                    <?php endif; ?>
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
            </div> <!-- ,navigation -->
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