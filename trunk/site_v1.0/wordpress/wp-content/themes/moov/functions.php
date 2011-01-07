<?php

// setup for thumbnail posts
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails', array( 'post' ) );
	set_post_thumbnail_size( 640, 240, true );
	add_image_size( 'single-post-thumbnail', 640, 240, true );
	add_image_size( 'other-post-thumbnail', 100, 88, true );

}

// setup for admin panel
$themename = "ArtılarıEksileri";
$shortname = "ArtılarıEksileri";

// create the new options
$options = array (
 
	array(
		"name" => $themename." Options",
		"type" => "title"
	),
	array(
		"name" => "General",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Logo URL",
		"desc" => "Enter the URL to your logo",
		"id" => $shortname."_logo",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Custom Favicon",
		"desc" => "Paste the URL to a .ico image that you want to use as the image",
		"id" => $shortname."_favicon",
		"type" => "text",
		"std" => get_bloginfo('url') ."/favicon.ico"
	),
	array( "name" => "Colour Scheme",
		"desc" => "Select the colour scheme for the theme",
		"id" => $shortname."_color_scheme",
		"type" => "select",
		"options" => array("Light", "Dark", "Red", "Blue"),
		"std" => "dark"
	),
	array( "name" => "Sidebar Position",
		"desc" => "Select the position of the sidebar",
		"id" => $shortname."_sidebar_position",
		"type" => "select",
		"options" => array("Left", "Right"),
		"std" => "right"
	),
	array(
		"name" => "Custom CSS",
		"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
		"id" => $shortname."_custom_css",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Social Links",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Twitter Username",
		"desc" => "Enter your Twitter username (excluding the @ symbol)",
		"id" => $shortname."_twitter",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Facebook URL",
		"desc" => "Enter the URL of your Facebook page",
		"id" => $shortname."_facebook",
		"type" => "text",
		"std" => ""
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Other Posts Slider",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Hide this?",
		"id" => $shortname."_other_posts_slider",
		"type" => "checkbox",
		"std" => "false",
		"desc" => "Yes"
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Comments Page",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Number of comments to show",
		"desc" => "# of comments to show on " . get_bloginfo('url') . "/comments/",
		"id" => $shortname."_comment_count",
		"type" => "text",
		"std" => "10"
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Contact Form",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Email address",
		"desc" => "Where do you want emails sent to?",
		"id" => $shortname."_contact_email",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Confirmation message",
		"desc" => "Message to show once email has been sent",
		"id" => $shortname."_contact_confirmation",
		"type" => "textarea",
		"std" => "Your message us on its way to us. Thanks for taking the time to say hello."
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Adverts",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Advert 1",
		"desc" => "Maximum image width is 210px <br />Example: &lt;a href=\"#\"&gt;&lt;img src=\"http://www.iab.net/media/image/120x90.gif\" alt=\"Advert 1\" title=\"Advert 1\"  width=\"120\" height=\"90\" /&gt;&lt;/a&gt;",
		"id" => $shortname."_advert_1",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"name" => "Advert 2",
		"desc" => "Maximum image width is 210px <br />Example: &lt;a href=\"#\"&gt;&lt;img src=\"http://www.iab.net/media/image/120x90.gif\" alt=\"Advert 1\" title=\"Advert 1\"  width=\"120\" height=\"90\" /&gt;&lt;/a&gt;",
		"id" => $shortname."_advert_2",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"name" => "Advert 3",
		"desc" => "Maximum image width is 210px <br />Example: &lt;a href=\"#\"&gt;&lt;img src=\"http://www.iab.net/media/image/120x90.gif\" alt=\"Advert 1\" title=\"Advert 1\"  width=\"120\" height=\"90\" /&gt;&lt;/a&gt;",
		"id" => $shortname."_advert_3",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"name" => "Advert 4",
		"desc" => "Maximum image width is 210px <br />Example: &lt;a href=\"#\"&gt;&lt;img src=\"http://www.iab.net/media/image/120x90.gif\" alt=\"Advert 1\" title=\"Advert 1\"  width=\"120\" height=\"90\" /&gt;&lt;/a&gt;",
		"id" => $shortname."_advert_4",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Footer",
		"type" => "section"
	),
	array(
		"type" => "open"
	),	
	array(
		"name" => "Footer copyright text",
		"desc" => "Enter text used in the right side of the footer. It can be HTML",
		"id" => $shortname."_footer_text",
		"type" => "text",
		"std" => "&copy; 2010 Moov. All Rights Reserved."
	),
	array(
		"name" => "Google Analytics Code",
		"desc" => "Paste your Google Analytics or other tracking code in this box if you have one",
		"id" => $shortname."_ga_code",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"type" => "close"
	)

);

// admin setup
function moov_add_admin() {
 
	global $themename, $shortname, $options;
	 
	if ( $_GET['page'] == basename(__FILE__) ) {
	 
		if ( 'save' == $_REQUEST['action'] ) {
	 
			foreach ($options as $value) {
			
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
				
			}
	 
			foreach ($options as $value) {
		
				if( isset( $_REQUEST[ $value['id'] ] ) ) {
					
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
				
				} else {
				
					delete_option( $value['id'] );
				}
			
			}
	 
			header("Location: admin.php?page=functions.php&saved=true");
			die;
		 
		} 
		
		else if( 'reset' == $_REQUEST['action'] ) {
		 
			foreach ($options as $value) {
				delete_option( $value['id'] );
			}
		 
			header("Location: admin.php?page=functions.php&reset=true");
			die;
		 
		}
		
	}
 
	add_options_page($themename, $themename, 'administrator', basename(__FILE__), 'moov_admin');
	
}

// gives us custom CSS for admin
function moov_add_init() {

	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
	wp_enqueue_script("script", $file_dir."/functions/script.js", false, "1.0");

}

// HTML for admin
function moov_admin() {
 
	global $themename, $shortname, $options;
	$i=0;
	 
	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>

<div class="wrap rm_wrap">

	<h2><?php echo $themename; ?> Settings</h2>

	<div class="rm_opts">

		<form method="post" action="<?php $_SERVER["REQUEST_URI"]; ?>">

<?php

	foreach ($options as $value) {
	
		switch ( $value['type'] ) {
 
			case "open":
			break;
			
			case "close":
				$i++;
?>
			 
				</div>
				
			</div>
 
<?php
			break;
			
			case 'text':

?>

			<div class="rm_input rm_text">
			
				<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
				
				<div class="rm_option_block">
				
					<?php if( $value['id'] == 'moov_secondary_color' ){ ?>
					
						<span class="colour_block" style="background:<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>;"></span>
					
					<?php } ?>
				
				 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
			 	
					<span class="description"><?php echo $value['desc']; ?></span>
					
				</div>
			 
			</div>

<?php
			break;
			
			case 'textarea':

?>

			<div class="rm_input rm_textarea">
			
				<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
				
				<div class="rm_option_block">
				
				 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
			 	
					<span class="description"><?php echo $value['desc']; ?></span>
			 
			 	</div>
			 
			</div>
  
<?php
			break;
			
			case 'select':
?>

			<div class="rm_input rm_select">
			
				<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
				
				<div class="rm_option_block">
				
					<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $option) { ?>
						<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
					</select>
			
					<span class="description"><?php echo $value['desc']; ?></span>
			
				</div>
			
			</div>

<?php
			break;
			
			case "checkbox":
?>

			<div class="rm_input rm_checkbox">
			
				<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
				
				<div class="rm_option_block">
				
					<?php if( get_option($value['id']) ) {
					
						$checked = "checked=\"checked\"";
						
					} else {
					
						$checked = "";
						
					} ?>
					
					<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
			
					<span class="description"><?php echo $value['desc']; ?></span>
				
				</div>
				
			</div>

<?php
			break;
			
			case "section":
?>

			<div class="rm_section">

				<div class="rm_title">
					<h3><?php echo $value['name']; ?></h3>
				</div>
	
				<div class="rm_options">

<?php
			break;
			
		} /* end switch*/
		
	} /* end foreach */
	
?>

		<span class="submit">
			<input name="save" class="button-primary" type="submit" value="Save changes" />
		</span>

		<input type="hidden" name="action" value="save" />

	</form>

	<form class="reset" method="post">

		<p class="submit">

			<input name="reset" type="submit" value="Reset to initial settings" />
			<input type="hidden" name="action" value="reset" />
	
		</p>

	</form>
</div>
<?php } /* end moov_admin function */ ?>
<?php
add_action('admin_init', 'moov_add_init');
add_action('admin_menu', 'moov_add_admin');
?>
<?php

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'moov', TEMPLATEPATH . '/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";

if ( is_readable($locale_file) ) { require_once($locale_file); }

// Get the page number
function get_page_number() {
	if (get_query_var('paged')) {
		print ' &middot; ' . __( 'Page ' , 'moov') . get_query_var('paged');
	}
}

// Custom length for excerpts
function truncate_title($title) {
	$max_length = 36;
	$suffix = '...';

	if(strlen($title) > $max_length){
		$parts = explode(' ', $title);
		$title = "";
		$i = 0;

		while(strlen($title) < $max_length && $i < count($parts)){
			if(strlen($parts[$i]) + strlen($title) > $max_length){
				return $title . $suffix;
			} else {
				$title .= ' ' . $parts[$i];
				$i++;
			}
		}

		return $title . $suffix;
	} else{
		return $title;
	}
}


// Custom length for excerpts
function new_excerpt_length($length) {
	return 45;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Custom more text at the end of the excerpt
function new_excerpt_more($more) {
	return '... <span><a href="' . get_permalink() .'" title="' . get_the_title() .'" rel="bookmark">[+]</a></span>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 20 ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link

// Get all the most recent comments
function latest_comments($count=10) {

	global $wpdb;
	
	$sql = "SELECT DISTINCT ID, post_name, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_author_url, comment_date_gmt, comment_approved, comment_type, comment_content AS com_excerpt 
		FROM $wpdb->comments 
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) 
		WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' 
		ORDER BY comment_date_gmt DESC 
		LIMIT $count";
	
	$comments = $wpdb->get_results($sql);
	
	foreach ($comments as $comment) {
	
		$post['url'] = $comment->post_name;
		$post['title'] = $comment->post_title;
	
		custom_comments( get_comment( $comment->comment_ID ), false, false, $post );
	}
	
}

// Custom callback to list comments in the your-theme style
function custom_comments($comment=false, $args=false, $depth=false, $post=false) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	
?>
	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
		
		<div class="commentHolder">

			<div class="commentAuthor vcard">
				<div align="left">
					<?php
					/*
						$query = "SELECT comment_arti_eksi FROM  $wpdb->comment_arti_eksi WHERE comment_ID=" . get_comment_ID() . ";";
						$user_count = $wpdb->get_var($wpdb->prepare($query));
						echo '<p>User count is ' . $user_count . '</p>';
					*/	
						$query = "SELECT comment_arti_eksi FROM wp_comment_arti_eksi WHERE comment_ID = " . get_comment_ID() . ";";
						$result = mysql_query($query);
						$row = mysql_fetch_assoc($result);
						print "<font style=\"font-size:20px\">$row[comment_arti_eksi]</font>";
						//$allmiles=$wpdb->get
						//echo '<p>Total miles is '.$allmiles . '</p>';


					?>
				</div>
				<div align="right">
					<?php commenter_link() ?>
				</div>
			</div>
							
				<div class="commentContent">
					<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0') _e("<p class='unapproved'>Your comment is awaiting moderation.</p>\n", 'moov') ?>
				</div>
				
				<div class="commentMeta">
				
				<div class="commentOptions">
				
					<?php
							if ($post) {
							
								_e('RE: <a href="'.$post['url'].'"><em>'.$post['title'].'</em></a>', 'moov');
								
							 } else {
							 
							if($args) {
								if($args['type'] == 'all' || get_comment_type() == 'comment') :
									comment_reply_link(array_merge($args, array(
										'reply_text' => __('<span class="icon iconReply"></span><em>Reply</em>','moov'), 
										'login_text' => __('<span class="icon iconReply"></span><em>Log in to reply</em>','moov'),
										'depth' => $depth
									)));
								endif;
							}
							 
							 	printf(__('<a href="%1$s" title="Permalink to this comment" class="comment-permalink"><span class="icon iconPermalink"></span><em>Permalink</em></a>', 'moov'),
						$post['url'] . '#comment-' . get_comment_ID() );
							 
							 }
						?>
				
				</div>
				
				<div class="commentTime"><?php printf(__('%1$s <span class="metaSep">@</span> %2$s', 'moov'), get_comment_date(), get_comment_time() ); ?></div>
			
			</div>
			
		</div>

<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;

?>
		<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
			<div class="commentAuthor"><?php printf(__('By %1$s on %2$s at %3$s', 'moov'),
				get_comment_author_link(),
				get_comment_date(),
				get_comment_time() );
				edit_comment_link(__('Edit', 'moov'), ' <span class="metaSep">&middot;</span> <span class="editLink">', '</span>'); ?>
			</div>
	
	<?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'moov') ?>
	
		<div class="commentContent">
			
			<?php
			/*
			 *Wrote for pumpmyvote. 
			 * */
			
			?>
			<?php comment_text() ?>
		</div>

<?php } // end custom_pings

// Register widgetized areas
function theme_widgets_init() {

	// Area 1
	register_sidebar( array (
		'name' => 'Primary Widget Area',
		'id' => 'primary_widget_area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2
	register_sidebar( array (
		'name' => 'Secondary Widget Area',
		'id' => 'secondary_widget_area', 
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}

add_action( 'init', 'theme_widgets_init' );

// Check for static widgets in widget-ready areas
function is_sidebar_active( $index ){
	global $wp_registered_sidebars;

	$widgetcolums = wp_get_sidebars_widgets();
		 
	if ($widgetcolums[$index]) return true;
	
	return false;
}

?>
