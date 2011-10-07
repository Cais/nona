<?php // Do not delete these lines
if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
    die ( __( 'Please do not load this page directly. Thanks!', 'nona' ) );
if ( post_password_required() ) { ?>
    <p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'nona' ); ?></p>
<?php
return;
}
// add a microid to all the comments
function comment_add_microid( $classes ) {
        $c_email = get_comment_author_email();
        $c_url = get_comment_author_url();
        if ( !empty ( $c_email ) && !empty( $c_url ) ) {
            $microid = 'microid-mailto+http:sha1:' . sha1( sha1( 'mailto:' . $c_email ) . sha1( $c_url ) );
            $classes[] = $microid;
        }
        return $classes;
}
add_filter( 'comment_class', 'comment_add_microid' );

/* add a userid (if exists) to all the comments */
function comment_add_userid( $classes ) {
        global $comment;
        if ( $comment->user_id == 1 ) { /* Administrator */
            $userid = "administrator user-id-1";
        } else { /* All other users - NB: user-id-0 -> non-registered user */
            $userid = "user-id-" . ( $comment->user_id );
        }
        $classes[] = $userid;
        return $classes;
}
add_filter( 'comment_class', 'comment_add_userid' );
?>
<div id="comments-main">
    <?php // show the comments
    if ( have_comments() ) : ?>
        <h4 id="comments"><?php comments_number( __( 'No Comments', 'nona' ), __( 'One Comment', 'nona' ), __( '% Comments', 'nona' ) );?></h4>
        <ul class="commentlist" id="singlecomments">
            <?php wp_list_comments( array( 'avatar_size'=>60, 'reply_text'=>__( '&raquo; Reply to this Comment &laquo;', 'nona' ) ) ); ?>
        </ul>
        <div class="navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div> <!-- .navigation -->
    <?php else : // this is displayed if there are no comments so far ?>
        <?php global $post;
        if ( 'open' == $post->comment_status ) :
            // If comments are open, but there are no comments.
        else :
            // comments are closed
        endif;
    endif;
    comment_form(); /* WordPress 3.0+ required. */
    ?>
</div> <!-- #comments-main -->
<?php /* Last revised October 7, 2010 v1.4 */ ?>