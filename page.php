<?php get_header(); ?>
<div id="main-blog">
	<div id="before-content"></div>
	<div id="content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div id="page-content">
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1><?php the_title(); ?></h1>
						<div id="page-meta">
							<?php comments_popup_link( __( 'with No Comments', 'nona' ), __( 'with 1 Comment', 'nona' ), __( 'with % Comments', 'nona' ), '', __( '', 'nona' ) ); ?>
							<?php edit_post_link( __( 'Edit this page', 'nona' ), __( '&gt ', 'nona' ), __( '', 'nona' ) ); ?>
						</div> <!-- #page-meta -->
						<?php the_content( __( 'Read more ...', 'nona' ) ); ?>
						<div class="clear"></div> <!-- For inserted media at the end of the post -->
						<?php wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>
					</div> <!-- .post #post-ID -->
					<?php comments_template(); ?>
				</div> <!-- #page-content -->
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