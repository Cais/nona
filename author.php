<?php
/**
 * Author Template
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
 * Last revised April 23, 2012
 * @version     1.5
 * Added conditional check to only display website (and email) if exists, as well as only display biography if it exists
 *
 * @version     1.8
 * @date        March 14, 2013
 * Added code block termination comments
 * Refactored code formatting
 * Refactored to be more i18n compatible
 */

get_header();

/** Set the $curauth variable */
$curauth = ( get_query_var( 'author_name ' ) )
	? get_user_by( 'id', get_query_var( 'author_name' ) )
	: get_userdata( get_query_var( 'author' ) ); ?>

	<div id="main-blog">

		<div id="before-content"></div>

		<div id="content">

			<div id="author" class="<?php if ( user_can( $curauth, 'manage_options' ) ) {
				echo 'administrator';
			} ?>">

				<h2>
					<?php printf( __( 'About %1$s', 'nona' ), $curauth->display_name ); ?>
				</h2>

				<ul>
					<?php if ( ! empty( $curauth->user_url ) ) { ?>
						<li>
							<?php
							printf( __( 'Website %1$s or %2$s', 'nona' ),
								sprintf( '<a href="%1$s">%1$s</a>', $curauth->user_url ),
								sprintf( '<a href="mailto:%1$s">email</a>', $curauth->user_email )
							); ?>
						</li>
					<?php
					}
					/** End if - not empty current author url */

					if ( ! empty( $curauth->user_description ) ) {
						?>
						<li>
							<?php printf( __( 'Biography: %1$s', 'nona' ), $curauth->user_description ); ?>
						</li>
					<?php } /** End if - not empty current author description */ ?>
				</ul>

			</div>
			<!-- #author -->

			<h2>
				<?php printf( __( 'Posts by %1$s:', 'nona' ), $curauth->display_name ); ?>
			</h2>

			<!-- start the Loop -->
			<?php
			if ( have_posts() ) {
				$count = 0;
				while ( have_posts() ) {
					the_post();
					$count ++; ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

						<h2>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'nona' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="post-details">

							<?php
							printf( __( 'on %1$s ', 'nona' ),
								get_the_time( get_option( 'date_format' ) )
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

						if ( $count == 1 ) {
							the_content( __( 'Read more... ', 'nona' ) ); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->
							<?php
							wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'nona' ) . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) );
						} else {
							the_excerpt(); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->
						<?php } /** end if - count is 1 */ ?>

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
			<!-- end the Loop -->

		</div>
		<!-- #content -->

		<div id="after-content"></div>

	</div><!-- #main-blog -->

<?php
get_sidebar();
get_footer();