<?php
/**
 * Page Template
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
 */

get_header(); ?>

	<div id="main-blog">

		<div id="before-content"></div>

		<div id="content">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post(); ?>

					<div id="page-content">

						<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

							<h1>
								<?php the_title(); ?>
							</h1>

							<div id="page-meta">
								<?php
								comments_popup_link( __( 'with No Comments', 'nona' ), __( 'with 1 Comment', 'nona' ), __( 'with % Comments', 'nona' ), '', __( '', 'nona' ) );
								edit_post_link( __( 'Edit this page', 'nona' ), __( ' | ', 'nona' ), __( '', 'nona' ) ); ?>
							</div>
							<!-- #page-meta -->

							<?php the_content( __( 'Read more ...', 'nona' ) ); ?>

							<div class="clear"></div>
							<!-- For inserted media at the end of the post -->

							<?php wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages: ', 'nona' ) . '</strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>

						</div>
						<!-- .post #post-ID -->

						<?php comments_template(); ?>

					</div><!-- #page-content -->

				<?php
				}
				/** End while - have posts */
			} else {
				?>

				<h2>
					<?php printf( __( 'Search Results for: %s', 'nona' ),
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