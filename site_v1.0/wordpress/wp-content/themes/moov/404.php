<?php get_header(); ?>
	
	<div id="container">	
		<div id="content">
			
			<div id="post-0" class="post error404 not-found">
			
				<h1><?php _e( 'Page not found :(', 'moov' ); ?></h1>
				
				<p class="introText"><?php _e( 'It looks like the page you were trying to get to has disappeared and we cannot find it. Here are a couple of things that might help you get back on track.', 'moov' ); ?></p>
				
				<ul>
					<li><?php _e( '<a href="javascript:history.back()">Go back to the previous page</a>', 'moov' ); ?></li>
					<li><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php _e( 'Go to the homepage', 'moov' ); ?></a></li>
					<li><?php _e( 'Try searching for it at the bottom of the page', 'moov' ); ?></li>
				</ul>
				
			</div>

		</div>
		
		<?php if ( !get_option('moov_other_posts_slider') ) { ?>
		
		<div class="otherPosts">

			<div class="inner">

				<h2><?php _e('Recent Posts', 'moov') ?></h2>

				<a class="lessPosts" href="#"><span><?php _e('Less', 'moov') ?></span></a>

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
				
				<a class="morePosts" href="#"><span><?php _e('More', 'moov') ?></span></a>
			
			</div>

		</div>
		
		<?php } ?>
		
	</div>
		
<?php get_footer(); ?>