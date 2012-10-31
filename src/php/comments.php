<?php
/**
* The template for displaying Comments.
*
* The area of the page that contains both current comments
* and the comment form. The actual display of comments is
* handled by a callback to sgb_comment() which is
* located in the functions.php file.
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>

<hr class="divider" />
<h2><i class="icon-comment"></i> Kommentare</h2>
<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( _n( 'Ein Kommentar für &ldquo;%2$s&rdquo;', '%1$s Kommentare für &ldquo;%2$s&rdquo;', get_comments_number(), 'sgb' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h4>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'sgb_comment', 'style' => 'ul' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Navigation', 'sgb' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; &Auml;ltere Kommentare', 'sgb' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Neuere Kommentare &rarr;', 'sgb' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php // If comments are closed and there are comments, let's leave a little note.
		elseif ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Kommentare sind auf dieser Seite nicht gestattet.', 'sgb' ); ?></p>
	<?php endif; ?>
</div><!-- #comments .comments-area -->
<?php
	$fields = array(
		'author' => '<div class="comment-form-author"><label for="author">Name</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" aria-required="true" /></div>',
		'email'  => '<div class="comment-form-email"><label for="email">E-Mail</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'"  aria-required="true" /></div>',
		'url'    => ''
	);
	$args = array(
		'fields'=> $fields,
		'title_reply'=>'<h3><i class="icon-comment-alt"></i> Kommentar abgeben</h3>',
		'title_reply_to'=>'Antworten',
		'cancel_reply_link'=>'',
		'label_submit'=>'Kommentar abgeben',
		'comment_notes_after'=>'Alle Felder werden benötigt.',
		'comment_notes_before'=>'',
		'comment_field'=>'<p class="comment-form-comment"><label for="email">Kommentar</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'=>'<p class="must-log-in">' .  sprintf( __( 'Sie müssen <a href="%s">eingeloggt</a> sein um Kommentare abgeben zu können.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as'=>'<p class="logged-in-as">' . sprintf( __( 'Eingeloggt als %1$s</a>.' ), $user_identity ) . '</p>',
		'id_submit'=>'submitComment'
	);
	comment_form($args,$fields); 
?>