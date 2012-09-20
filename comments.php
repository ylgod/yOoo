<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'yOoo' ); ?></p>
<?php return;endif; ?>
<?php if ( have_comments() ) : ?>
		<h3 id="comments-title"><?php _e( 'Comments:', 'yOoo' ); ?><?php comments_number('', ' 1 ', ' % ' );?></h3>
	<ol id="commentlist" class="border">
		<?php wp_list_comments( array( 'callback' => 'comment' ) );?>
			<p id="comments-nav">
				<?php paginate_comments_links('prev_text='.__('Previous', 'yOoo').'&next_text='.__('Next', 'yOoo').'');?>
			</p>
			
<?php endif; ?>

			<?php if ( $user_ID ) : ?>

				<?php echo null;?>

				<?php elseif ( '' != $comment_author ): ?>

				<p class="comment-welcomeback"><?php printf(__('Welcome <strong>%s</strong>', 'yOoo'), $comment_author); ?>
				
				<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info">
					<?php _e('(Toggle)', 'yOoo'); ?>
				</a>

				<script type="text/javascript" charset="utf-8">
					var changeMsg = "<?php echo  esc_js( __('(Toggle)', 'yOoo') ); ?>";
					var closeMsg = "<?php echo esc_js( __('(Close)', 'yOoo') ); ?>";
					
					function toggleCommentAuthorInfo() {
						jQuery('#comment-author-info').slideToggle('slow', function(){
							if ( jQuery('#comment-author-info').css('display') == 'none' ) {
								jQuery('#toggle-comment-author-info').text(changeMsg);
							} else {
								jQuery('#toggle-comment-author-info').text(closeMsg);
							}
						});
					}

					jQuery(document).ready(function(){
						jQuery('#comment-author-info').hide();
					});
				</script>
			<?php endif; ?>
<?php 
       	$fields =  array(
            'author' => '<div id="comment-author-info"><p class="comment-form-author"><input id="author" name="author" type="text" value="'.esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">(required)</span>' : '' ).'</p>',
            'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><label for="email">' . __( 'Email' ) . '</label>'. ( $req ? '<span class="required">(required)(will not be published)</span>' : '' ).'</p>',
            'url'    => '<p class="comment-form-url">'.'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />'.'<label for="url">' . __( 'Website' ) . '</label></p></div><div class="QapTcha"></div>',
	);
        $comment_form_args = array(
          	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
            'comment_field'        => '<p class="comment-form-comment"><textarea aria-required="true" rows="8" cols="70%" name="comment" id="comment" onkeydown="if(event.ctrlKey){if(event.keyCode==13){document.getElementById(\'submit\').click();return false}};"></textarea></p><p>'.$smilies.'</p>',
            'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'comment_notes_before' => null,
            'comment_notes_after'  => null,
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'title_reply'          => __( 'Leave a Reply' ),
            'title_reply_to'       => __( 'Leave a Reply to %s' ),
            'cancel_reply_link'    => __( 'Cancel reply' ),
            'label_submit'         => __( 'Post Comment' ),
    );
    comment_form($comment_form_args);
 ?>
	</ol>

<?php /*输出自定义Trackbacks和Pingbacks*/ foreach($comments as $comment){if(get_comment_type() != 'comment' && $comment->comment_approved != '0'){ $havepings = 1; break; }}if($havepings == 1) : ?>
<div id="trackbacks-pingbacks" class="border">
	<h3>Pingbacks:</h3>
		<ul id="pinglist"><?php wp_list_comments('type=pings&per_page=0&callback=custom_pings'); ?></ul>
</div>

<?php endif; ?>