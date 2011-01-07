<?php
/*
Template Name: Contact Form
*/
?>

<?php 

//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the captcha field was filled in
	if(trim($_POST['checking']) !== '') {
	
		$captchaError = true;
		
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = get_option('moov_contact_email', get_bloginfo('admin_email'));
			$subject = 'Email from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\n$comments";
			$headers = 'From: ' . get_bloginfo('name') . ' Contact Form <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
			
				$subject = 'You emailed ' . get_bloginfo('name');
				$headers = 'From: ' . get_bloginfo('name') . ' <' . get_option('moov_contact_email') . '>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
		
	}
} ?>

<?php get_header(); ?>

	<div id="container" class="contactForm">

		<div id="content">

<?php if(isset($emailSent) && $emailSent == true) { ?>
				
			<h1 class="confirmation">Thanks, <?=$name;?></h1>
		
			<p><?php echo stripslashes(get_option('moov_contact_confirmation','Your message us on its way to us. Thanks for taking the time to say hello.')); ?></p>

<?php } else { ?>
		
			<?php if(isset($hasError) || isset($captchaError)) { ?>
			<h1><span>Please try again</span></h1>
			<p class="introText">There were some problems, please fill out the form again.</p>
			<?php } else { ?>
			<h1>Contact Us</h1>
			<p class="introText">Fill out the form below to send us a message.</p>
			<?php } ?>

			<form method="post" action="">
				<fieldset>
					<ul>
						<li>
							<label for="contactName">Name</label>
							<input name="contactName" id="contactName" type="text" title="What's your name?" class="hint" value="<?php if(isset($_POST['contactName'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['contactName']); } else { echo $_POST['contactName']; } } ?>" />
						</li>
						<li>
							<label for="email">Email</label>
							<input id="email" name="email" type="text" title="What's your email address?" class="hint" value="<?php if(isset($_POST['email'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['email']); } else { echo $_POST['email']; } } ?>" />
						</li>
						<li>
							<label for="commentsText">Comments</label>
							<textarea name="comments" id="commentsText" title="What did you want to say or ask?" class="hint"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
						</li>
						<li class="formSubmit">
							<button class="button" type="submit" id="submit"><em></em>Send your message</button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
						</li>
						<li id="copyMeIn">
							<input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> />
							<label for="sendCopy">Send a copy of this to yourself</label>
							<input type="text" name="checking" id="checking" />
						</li>
					</ul>
				</fieldset>
			</form>
	
<?php } ?>

			<?php if ( !get_option('moov_other_posts_slider') ) { ?>

			<div class="otherPosts">

				<div class="inner">
	
					<h2><?php _e('Recent Posts', 'moov') ?></h2>
	
					<a class="lessPosts" href="#" title="Previous Posts"><span><?php _e('Less', 'moov') ?></span></a>
	
					<div class="overflow">
	
						<ul>
						<?php
							$my_query = new WP_Query('posts_per_page=50');
							while ($my_query->have_posts()) : $my_query->the_post();
						?>
							<li>
								<a class="image" href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'moov'), get_the_title() ); ?>" rel="bookmark">
									<?php if(has_post_thumbnail()) {
										echo get_the_post_thumbnail( $post->ID, 'other-post-thumbnail', array('alt'=>get_the_title(),'title'=>get_the_title()) );
									} else {
										echo '<img src="'.get_bloginfo("template_url").'/images/thumbnail_other.png" />';
									} ?>
									<span></span>
								</a>
							</li>
						<?php endwhile; ?>
						</ul>
	
					</div>
					
					<a class="morePosts" href="#" title="More Posts"><span><?php _e('More', 'moov') ?></span></a>
				
				</div>
	
			</div>
			
			<?php } ?>

		</div>

	</div>

<?php get_footer(); ?>