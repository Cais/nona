<?php
/**
 * Comments Template
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

/** Do not delete these lines */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( __( 'Please do not load this page directly. Thanks!', 'nona' ) );
}
/** End if - not empty */
if ( post_password_required() ) {
	?>
	<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'nona' ); ?></p>
	<?php
	return;
}
/** End if - post password required */


/**
 * Comment Add MicroID
 * Add a microid to all the comments
 *
 * @param $classes
 *
 * @return array
 */
function comment_add_microid( $classes ) {
	$c_email = get_comment_author_email();
	$c_url   = get_comment_author_url();
	if ( ! empty ( $c_email ) && ! empty( $c_url ) ) {
		$microid   = 'microid-mailto+http:sha1:' . sha1( sha1( 'mailto:' . $c_email ) . sha1( $c_url ) );
		$classes[] = $microid;
	}

	/** End if - not empty */

	return $classes;

}

/** End function - add micro ID */
add_filter( 'comment_class', 'comment_add_microid' );


/**
 * Comment Add User ID
 * Add a userid to all the comments; if user exists add their ID, otherwsie add user-id-0 for "guests"
 *
 * @param $classes
 *
 * @return array
 */
function comment_add_userid( $classes ) {
	global $comment;
	if ( $comment->user_id == 1 ) {
		/** Super Administrator */
		$userid = "administrator administrator-prime user-id-1";
	} else {
		/** All other users - NB: user-id-0 -> non-registered user */
		$userid = "user-id-" . ( $comment->user_id );
	}
	/** End if - comment user ID is 1 */

	$classes[] = $userid;

	return $classes;

}

/** End if - comment user ID is 1 */
add_filter( 'comment_class', 'comment_add_userid' ); ?>


<div id="comments-main">

	<?php
	/** Show the comments */
	if ( have_comments() ) {
		?>

		<h4 id="comments">
			<?php comments_number( __( 'No Comments', 'nona' ), __( 'One Comment', 'nona' ), __( '% Comments', 'nona' ) ); ?>
		</h4>

		<ul class="commentlist" id="singlecomments">
			<?php wp_list_comments( array( 'avatar_size' => 60, 'reply_text' => __( '&raquo; Reply to this Comment &laquo;', 'nona' ) ) ); ?>
		</ul>

		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div><!-- .navigation -->

	<?php
	} else {

		/** This is displayed if there are no comments so far */
		global $post;
		if ( 'open' == $post->comment_status ) {
			/** If comments are open, but there are no comments. */
		} else {
			/** Comments are closed */
		}
		/** End if - comment are open */

	}
	/** End if - have comments */

	comment_form(); ?>

</div><!-- #comments-main -->