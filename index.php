<?php
/**
 * NoNa
 *
 * Theme Description: Missing the pretty pin-up girl posing in the header, this
 * grunge based theme originally known as Pinup Meets Grunge beautifully blends
 * custom background colors.
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
 * @internal    WordPress Version Required: 3.4
 * @internal    WordPress Tested Version: 3.8.1
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @version     1.8
 * @date        March 2013
 * Added code block termination comments
 * Refactored code formatting
 * Refactored no post title code
 * Refactored to be more i18n compatible
 * Remove 'searchform.php' template in favor of using WordPress core version
 *
 * @version     1.8.1
 * @date        July 2013
 *
 * @version		1.9
 * @date		December 2013
 */

get_header(); ?>

	<div id="main-blog">

		<div id="before-content"></div>

		<div id="content">

			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post(); ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

						<h2>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="post-details">

							<?php
							/**
							 * For posts without titles - create a permalink using
							 * the post date referencing the post ID
							 */
							$nona_title = get_the_title();
							$nona_post_title = empty( $nona_title )
								? sprintf( '<a href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to post ' . get_the_id() . '">' . get_the_time( get_option( 'date_format' ) ) . '</a>' )
								: get_the_time( get_option( 'date_format' ) );

							printf( __( 'Posted by %1$s on %2$s', 'nona' ),
								get_the_author_meta( 'display_name' ),
								$nona_post_title
							);

							if ( ! post_password_required() ) {
								echo ' ';
								comments_popup_link( __( 'with No Comments', 'nona' ), __( 'with 1 Comment', 'nona' ), __( 'with % Comments', 'nona' ), '', __( 'with Comments Closed', 'nona' ) );
							}
							/** End if - not post password required */

							edit_post_link( __( 'Edit', 'nona' ), __( ' | ', 'nona' ), __( '', 'nona' ) );

							printf( __( '<div class="nona-categories-list">in %1$s</div>', 'nona' ),
								get_the_category_list( ', ' )
							);
							the_tags( __( 'as ', 'nona' ), ', ', '' ); ?>

						</div>
						<!-- .post-details -->

						<?php
						nona_show_featured_image( 'full' );
						the_content( __( 'Read more... ', 'nona' ) ); ?>

						<div class="clear"></div>
						<!-- For inserted media at the end of the post -->

						<?php wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'nona' ) . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>

					</div><!-- .post #post-ID -->

				<?php } /** End while - have posts */ ?>

				<div id="nav-global" class="navigation">
					<div class="left">
						<?php next_posts_link( __( '&laquo; Previous entries ', 'nona' ) ); ?>
					</div>
					<div class="right">
						<?php previous_posts_link( __( ' Next entries &raquo;', 'nona' ) ); ?>
					</div>
				</div><!-- .navigation -->

				<div class="clear"></div>

			<?php } else { ?>

				<h2>
					<?php
					printf( __( 'Search Results for: %s', 'nona' ),
						'<span>' . esc_html( get_search_query() ) . '</span>'
					); ?>
				</h2>

				<p><?php _e( 'Sorry, but you are looking for something that is not here.', 'nona' ); ?></p>

				<?php
				get_search_form();

			} /** End if - have posts */
			?>

		</div>
		<!-- #content -->

		<div id="after-content"></div>

	</div><!-- #main-blog -->

<?php
get_sidebar();
get_footer();