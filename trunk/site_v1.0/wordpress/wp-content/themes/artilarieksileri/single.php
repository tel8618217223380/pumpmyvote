<?php get_header(); ?>
	
		<div id="container">
		
			<div id="content">
			
				<?php the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<?php/*
					<div class="entryMeta">
						<span class="metaSep"><?php _e('By ', 'moov'); ?></span>
						<span class="author vcard"><a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'moov' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
						<span class="metaSep"><?php _e('on ', 'moov'); ?></span>
						<span class="entryDate"><abbr class="published" title="<?php the_time() ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
					</div>
					*/?>
					<div class="image">
						<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
							echo get_the_post_thumbnail( $post->ID, 'single-post-thumbnail', array('alt'=>the_title_attribute('echo=0'),'title'=>the_title_attribute('echo=0')) );
						} else if (get_post_meta($post->ID, 'post_image_single', true)) {
							echo '<img src="'.get_post_meta($post->ID, 'post_image_single', true).'" alt="'.get_the_title().'" title="'.get_the_title().'" width="640" height="240" />';
						} else {
							echo '<img src="'.get_bloginfo("template_url").'/images/thumbnail_index.png" alt="'.get_the_title().'" title="'.get_the_title().'" width="640" height="240" />';
						} ?>
						<span></span>
					</div>
					<?php /*
					<div class="entryContent">
					
					<?php 
					
						$content = get_the_content();
						
						$first_letter = substr(trim($content),0,1);
						$story = substr(trim($content),1);
						$story = "<span class=\"dropCap\">" . $first_letter . "</span>" . $story;
						
						$story = apply_filters('the_content', $story);
						$story = str_replace(']]>', ']]&gt;', $story);
						
						echo $story;
					
					?>

					<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'moov' ) . '&after=</div>') ?>
					
					</div>
					<?php /*
					<div class="authorBlock">
					
						<?php echo get_avatar(get_the_author_meta('user_email',$post->post_author), 60 ); ?>
						
						<p><?php _e('Posted by ', 'moov') ?> <a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'moov' ), $authordata->display_name ); ?>"><?php the_author(); ?></a> &ndash; <?php echo get_the_author_meta('user_description',$post->post_author); ?></p>
					
					</div>
					
					<div class="entryUtility">
					
						<?php printf( __( '%1$s', 'moov' ), get_the_tag_list( __( '<div class="entryTags"><span class="icon iconTag"></span>Tagged as ', 'moov' ), ', ', '</div>' ) ) ?>
						
						<div class="entryCategories">
						
							<span class="icon iconCategory"></span>
						
							<?php printf( __( 'Categorised under %1$s', 'moov' ), get_the_category_list(', ') ) ?>
						
						</div>
						
						<div class="entryBookmark">
						
							<span class="icon iconBookmark"></span>
						
							<?php printf( __( 'Bookmark the <a href="%1$s" title="%2$s" rel="bookmark">permalink</a>', 'moov' ), get_permalink(), the_title_attribute('echo=0') ) ?>
						
							<?php if ( ('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Comments and trackbacks open ?>
								<?php printf( __( ' or leave a <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">trackback</a>.', 'moov' ), get_trackback_url() ) ?>
							<?php elseif ( !('open' == $post->ping_status) ) : // trackbacks closed ?>
								<?php _e( ', unfortunately trackbacks are closed.', 'moov' ) ?>
							<?php endif; ?>
						
						</div>

					</div>
					*/?>
				</div>
				
				<?php edit_post_link( __( 'Edit', 'moov' ), "<p>", "</p>" ) ?>
			
			</div>
			<?php /*
			<?php if ( !get_option('moov_other_posts_slider') ) { ?>
			
			<div class="otherPosts">

				<div class="inner">

					<h2><?php _e('Other Posts', 'moov') ?></h2>
	
					<a class="lessPosts" href="#" title="Previous Posts"><span><?php _e('Less', 'moov') ?></span></a>

					<div class="overflow">
	
						<ul>
						<?php
							$args=array( 'posts_per_page'=>50, 'post__not_in' => array($post->ID) );
							$my_query = new WP_Query($args);
							while ($my_query->have_posts()) : $my_query->the_post();
						?>
							<li>
								<a class="image" href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'moov'), get_the_title() ); ?>" rel="bookmark">
									<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
										echo get_the_post_thumbnail( $post->ID, 'other-post-thumbnail', array('alt'=>get_the_title(),'title'=>get_the_title()) );
									} else if (get_post_meta($post->ID, 'post_image_thumbnail', true)) {
										echo '<img src="'.get_post_meta($post->ID, 'post_image_thumbnail', true).'" alt="'.get_the_title().'" title="'.get_the_title().'" width="100" height="88" />';
									} else {
										echo '<img src="'.get_bloginfo("template_url").'/images/thumbnail_other.png" alt="'.get_the_title().'" title="'.get_the_title().'" width="100" height="88" />';
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
			*/?>
			<?php wp_reset_query(); ?>

			<?php comments_template('', true); ?>
			
		</div>
		
<?php get_footer(); ?>