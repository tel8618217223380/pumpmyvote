<?php
/*
Template Name: All Comments
*/
?>

<?php get_header(); ?>
	
	<div id="container" class="allComments">
	
		<div id="content">
		
			<h1><?php _e('Latest Comments', 'moov') ?></h1>
		
			<div id="comments">
			
				<div class="inner">

					<div id="commentsList" class="comments">
					
						<ol>

							<?php latest_comments( get_option('moov_comment_count',10) ); ?>
		
						</ol>
		
					</div>
		
				</div>
				
			</div>
		
		</div>
		
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
									echo get_the_post_thumbnail( $post->ID, 'other-post-thumbnail', array('alt'=>the_title_attribute('echo=0'),'title'=>the_title_attribute('echo=0')) );
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
		
<?php get_footer(); ?>