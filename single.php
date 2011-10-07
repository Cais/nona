<?php get_header(); ?>
<div id="main-blog">
	<div id="before-content"></div>
	<div id="content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<div class="post-details">
						<?php _e( 'Posted by ', 'nona' ); the_author(); _e( ' on ', 'nona' ); the_time( get_option( 'date_format' ) ); ?> | <a class="rss" href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php _e( 'Subscribe to my feed', 'nona' ); ?>"><?php _e( 'Subscribe', 'nona' ); ?></a> <?php edit_post_link( __( 'Edit', 'nona' ), __( '&#124; ', 'nona' ), __( '', 'nona' ) ); ?><br />
						<?php _e( ' in ', 'nona' ); the_category( ', ' ); ?><br />
						<?php the_tags( __( 'as ', 'nona' ), ', ', '' ); ?><br />
					</div> <!-- .post-details -->
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
                    } ?>
					<?php the_content( __( 'Read more ...', 'nona' ) ); ?>
					<div class="clear"></div> <!-- For inserted media at the end of the post -->
					<?php wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>
					<div id="author_link"><?php _e( '... other posts by ', 'nona' ); the_author_posts_link(); ?></div>
				</div> <!-- .post #post-ID -->
				<?php comments_template(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<h2><?php printf( __( 'Search Results for: %s', 'nona' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
			<p><?php _e( 'Sorry, but you are looking for something that is not here.', 'nona' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div> <!-- #content -->
	<div id="after-content"></div>
</div> <!-- #main-blog -->
<?php get_sidebar(); ?>
<?php get_footer();?>
<?php /* Last revised October 4, 2011 v1.4 */ ?>