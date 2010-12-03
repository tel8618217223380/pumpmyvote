<?php get_header(); ?>
	
		<div id="container">	
			<div id="content">
			
<?php the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div class="entryContent">
						<?php the_content(); ?>
						<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'moov' ) . '&after=</div>') ?>					
						<?php edit_post_link( __( 'Edit', 'moov' ), '<span class="edit-link">', '</span>' ) ?>
					</div><!-- .entry-content -->
				</div><!-- #post-<?php the_ID(); ?> -->			
			
<?php if ( get_post_custom_values('comments') ) comments_template() // Add a custom field with Name and Value of "comments" to enable comments on this page ?>			
			
			</div><!-- #content -->
			
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
								<a class="image" href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'moov'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
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
			
		</div><!-- #container -->
		
<?php get_footer(); ?>