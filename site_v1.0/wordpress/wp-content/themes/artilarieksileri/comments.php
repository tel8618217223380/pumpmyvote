<?php /* The Comments Template — with, er, comments! */ ?>			
			<div id="comments">
				<div class="inner">
<?php /* Run some checks for bots and password protected posts */ ?>	
<?php
	$req = get_option('require_name_email'); // Checks if fields are required.
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks!' );
	if ( ! empty($post->post_password) ) :
		if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
				<div class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'moov') ?></div>
			</div>
<?php
		return;
	endif;
endif;
?>

<?php /* See IF there are comments and do the comments stuff! */ ?>						
<?php if ( have_comments() ) : ?>

<?php /* Count the number of comments and trackbacks (or pings) */
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
	get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>

<?php /* IF there are comments, show the comments */ ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>

				<div id="commentsList" class="comments">
					<h5><?php printf($comment_count > 1 ? __('<span>%d</span> Comments', 'moov') : __('<span>One</span> Comment', 'moov'), $comment_count) ?></h5>

<?php /* If there are enough comments, build the comment navigation  */ ?>					
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
					<div id="commentsNavAbove" class="commentsNavigation">
						<div class="paginatedCommentsLinks"><?php paginate_comments_links(); ?></div>
					</div>
<?php endif; ?>					
				
<?php /* An ordered list of our custom comments callback, custom_comments(), in functions.php   */ ?>				
					<ol>
<?php wp_list_comments('type=comment&callback=custom_comments'); ?>
					</ol>

<?php /* If there are enough comments, build the comment navigation */ ?>
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>					
	  			<div id="commentsNavBelow" class="commentsNavigation">
					<div class="paginatedCommentsLinks"><?php paginate_comments_links(); ?></div>
				</div>
<?php endif; ?>					
					
				</div>

<?php endif; /* if ( $comment_count ) */ ?>

<?php /* If there are trackbacks(pings), show the trackbacks  */ ?>
<?php if ( ! empty($comments_by_type['pings']) ) : ?>

				<div id="trackbacksList" class="comments">
					<h2><?php printf($ping_count > 1 ? __('<span>%d</span> Trackbacks', 'moov') : __('<span>One</span> Trackback', 'moov'), $ping_count) ?></h2>

<?php /* An ordered list of our custom trackbacks callback, custom_pings(), in functions.php   */ ?>					
					<ol>
<?php wp_list_comments('type=pings&callback=custom_pings'); ?>

					</ol>				
					
				</div>


<?php endif /* if ( $ping_count ) */ ?>

<?php endif /* if ( $comments ) */ ?>

<?php /* If comments are open, build the respond form */ ?>
<?php if ( 'open' == $post->comment_status ) : ?>
				<div id="respond">
					<h2><?php comment_form_title( __('Post a Comment', 'moov'), __('Post a Reply to %s', 'moov') ); ?></h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
					<p id="loginReq"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'moov'),
					get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>

<?php else : ?>
					<div class="formContainer">						

						<form id="commentForm" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

<?php if ( $user_ID ) : ?>
							<p id="login"><?php printf(__('<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout"><a href="%3$s" title="Log out of this account">Log out?</a></span>', 'moov'),
								get_option('siteurl') . '/wp-admin/profile.php',
								wp_specialchars($user_identity, true),
								wp_logout_url(get_permalink()) ) ?></p>

<?php else : ?>

							<p id="commentNotes"><?php _e('Your email is <em>never</em> published nor shared.', 'moov') ?> <?php if ($req) _e('Required fields are marked <span class="required">*</span>', 'moov') ?></p>

  			<div id="formSectionAuthor" class="formSection">
				<div class="formLabel">
					<label for="author"><?php _e('Name', 'moov') ?></label> <?php if ($req) _e('<span class="required">*</span>', 'moov') ?>
				</div>
				<div class="formInput">
					<input id="author" name="author" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="20" tabindex="3" class="hint" title="<?php _e('Name', 'moov') ?>" />
				</div>
  			</div>

  			<div id="formSectionEmail" class="formSection">
				<div class="formLabel">
					<label for="email"><?php _e('Email', 'moov') ?></label> <?php if ($req) _e('<span class="required">*</span>', 'moov') ?>
				</div>
				<div class="formInput">
					<input id="email" name="email" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" class="hint" title="<?php _e('Email', 'moov') ?>" />
				</div>
  			</div>

  			<div id="formSectionUrl" class="formSection">
				<div class="formLabel">
					<label for="url"><?php _e('Website', 'moov') ?></label>
				</div>
				<div class="formInput">
					<input id="url" name="url" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" class="hint" title="<?php _e('Website', 'moov') ?>" />
				</div>
  			</div>

<?php endif /* if ( $user_ID ) */ ?>
	<select id="comment_arti_eksi" name="comment_arti_eksi" title="Meaning of comment is positive or negative?">
		<option>+</option>
		<option>-</option>
	</select>
  			<div id="formSectionComment" class="formSection">
				<div class="formLabel">
					<label for="comment"><?php _e('Comment', 'moov') ?></label>
				</div>
				<div class="formTextarea">
					<textarea id="comment" name="comment" cols="45" rows="8" tabindex="6" class="hint" title="What do you want to say?"></textarea>
				</div>
  			</div>
  			
  			<div id="formAllowedTags" class="formSection">
	  			<p><span><?php _e('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'moov') ?></span> <code><?php echo allowed_tags(); ?></code></p>
  			</div>
							
<?php do_action('comment_form', $post->ID); ?>
  				
			<div class="formSubmit">
				<button id="submit" name="submit" type="submit" tabindex="7"><em><span class="icon iconAdd"></span></em><?php _e('Post Comment', 'moov') ?></button>
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				<span class="formAlternativeOption"><?php _e('or', 'moov') ?></span>
				<?php cancel_comment_reply_link('cancel') ?>
			</div>

<?php comment_id_fields(); ?>  

<?php /* Just … end everything. We're done here. Close it up. */ ?>  

						</form>
					</div>
<?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>
				</div>
<?php endif /* if ( 'open' == $post->comment_status ) */ ?>
				</div>
			</div>
