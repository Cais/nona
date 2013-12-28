<?php
/**
 * Single Template
 *
 * @package     NoNa
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/nona/
 * @link        https://github.com/Cais/nona/
 * @link        http://wordpress.org/extend/themes/nona
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 *
 * @version     1.6
 * @date        July 10, 2012
 * Updated post to post navigation
 *
 * @version     1.8
 * @date        March 14, 2013
 * Added code block termination comments
 * Refactored code formatting
 * Refactored to be more i18n compatible
 */

get_header(); ?>

	<div id="main-blog">

		<div id="before-content"></div>

		<div id="content">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post(); ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

						<h2>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="post-details">
							<?php
							printf( __( 'Posted by %1$s on %2$s', 'nona' ),
								get_the_author_meta( 'display_name' ),
								get_the_time( get_option( 'date_format' ) )
							);

							edit_post_link( __( 'Edit', 'nona' ), __( ' | ', 'nona' ), __( '', 'nona' ) );

							printf( __( '<div class="nona-categories-list">in %1$s</div>', 'nona' ),
								get_the_category_list( ', ' )
							);
							the_tags( __( 'as ', 'nona' ), ', ', '' ); ?>

						</div>
						<!-- .post-details -->

						<?php the_content( __( 'Read more ...', 'nona' ) ); ?>

						<div class="clear"></div>
						<!-- For inserted media at the end of the post -->

						<?php wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'nona' ) . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>

						<div id="author-link">
							<?php
							printf( __( '... other posts by %1$s', 'nona' ),
								'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author_meta( 'display_name' ) . '</a>'
							); ?>
						</div>
						<!-- #author-link -->

					</div><!-- .post #post-ID -->

					<?php
					comments_template();
				endwhile; ?>

				<div id="nav-global" class="navigation">
					<div class="left">
						<?php next_posts_link( __( '&laquo; Older posts', 'nona' ) ); ?>
					</div>
					<div class="right">
						<?php previous_posts_link( __( 'Newer posts &raquo;', 'nona' ) ); ?>
					</div>
				</div><!-- navigation -->

				<div class="clear"></div>

			<?php else : ?>

				<h2>
					<?php
					printf( __( 'Search Results for: %s', 'nona' ),
						'<span>' . esc_html( get_search_query() ) . '</span>'
					); ?>
				</h2>
				<p><?php _e( 'Sorry, but you are looking for something that is not here.', 'nona' ); ?></p>

				<?php
				get_search_form();

			endif; ?>

		</div>
		<!-- #content -->

		<div id="after-content"></div>

	</div><!-- #main-blog -->

<?php
get_sidebar();
get_footer();