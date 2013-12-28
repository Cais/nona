<?php
/**
 * Category Template
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
 * @version     1.8
 * @date        March 14, 2013
 * Added code block termination comments
 * Refactored code formatting
 * Refactored to be more i18n compatible
 */

get_header();

/** used to create dynamic category link */
$curr_cat = single_cat_title( '', false );
$cat_id = get_cat_ID( $curr_cat );
$category_link = get_category_link( $cat_id ); ?>

	<div id="main-blog">

		<div id="before-content"></div>

		<div id="content">

			<div id="category-title">
				<?php
				global $paged;
				if ( $paged < 2 ) {
					printf( __( 'First page of the %1$s archive', 'nona' ),
						'<span id="category-name">' . single_cat_title( '', false ) . '</span>'
					);
				} else {
					printf( __( 'Page %1$s of the %2$s archive.', 'nona' ),
						$paged,
						'<a href=' . $category_link . ' title="' . $curr_cat . '"><span id="category-name">' . single_cat_title( '', false ) . '</span></a>'
					);
				} /** End if - paged less than 2 */
				?>
			</div>
			<!-- #category-title -->

			<div id="category-description">
				<?php echo category_description(); ?>
			</div>
			<!-- #category-description -->

			<!-- start the Loop -->
			<?php
			if ( have_posts() ) {
				$count = 0;
				while ( have_posts() ) {
					the_post();
					$count ++; ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

						<h2>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'nona' ); ?><?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="post-details">
							<?php
							printf( __( 'Posted by %1$s on %2$s ', 'nona' ),
								get_the_author_meta( 'display_name' ),
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

						if ( ( $count <= 2 ) && ( $paged < 2 ) ) {

							the_content( __( 'Read more... ', 'nona' ) ); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->
							<?php
							wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'nona' ) . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) );

						} else {

							the_excerpt(); ?>
							<div class="clear"></div><!-- For inserted media at the end of the post -->

						<?php } /** End if - count */ ?>

					</div><!-- .post #post-ID -->

				<?php } /** End while - have posts */ ?>

				<div id="nav-global" class="navigation">
					<div class="left">
						<?php next_posts_link( __( '&laquo; Previous entries ', 'nona' ) ); ?>
					</div>
					<div class="right">
						<?php previous_posts_link( __( ' Next entries &raquo;', 'nona' ) ); ?>
					</div>
				</div><!-- ,navigation -->

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