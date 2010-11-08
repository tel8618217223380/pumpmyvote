<?php get_header(); ?>
	
	<div id="container" class="searchResults">	
		<div id="content">
		
		<?php if ( have_posts() ) : ?>
			
			<h1><?php printf( __( 'Results for &ldquo;<span>%s</span>&rdquo;', 'moov' ), get_search_query() ); ?></h1>
			
			<?php $oddeven = 0; $i = 0; while ( have_posts() ) : the_post(); $i++; ?>
			<?php if ( $post->post_type == 'page' ) continue; /* only show posts */ ?>
			<?php $oddeven = 1 - $oddeven; /* for the odd/even rows */ ?>
			<?php $category = get_the_category(); ?>
			<?php $postDate = get_the_time('dM'); ?>

			<div class="otherStory row<?php echo $oddeven . ' ' . strtolower($category[0]->cat_name); ?>">
		
				<div class="inner">
		
					<div class="storyIntro">
		
						<h2><a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'moov'), get_the_title() ); ?>" rel="bookmark"><?php echo truncate_title($post->post_title); ?></a></h2>
				
						<div class="entryMeta">
						
							<span class="metaSep"><?php _e('By ', 'moov'); ?></span>
							<span class="author vcard"><a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'moov' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
							<span class="metaSep"><?php _e('on ', 'moov'); ?></span>
							<span class="entryDate"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
							
						</div>

					</div>
				
					<a class="image" href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'moov'), get_the_title() ); ?>" rel="bookmark">
						<?php if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
							echo get_the_post_thumbnail( $post->ID, 'post-thumbnail', array('alt'=>get_the_title(),'title'=>get_the_title()) );
						} else if (get_post_meta($post->ID, 'post_image_single', true)) {
							echo '<img src="'.get_post_meta($post->ID, 'post_image_single', true).'" alt="'.get_the_title().'" title="'.get_the_title().'" width="640" height="240" />';
						} else {
							echo '<img src="'.get_bloginfo("template_url").'/images/thumbnail_index.png" alt="'.get_the_title().'" title="'.get_the_title().'" width="640" height="240" />';
						} ?>
						<span></span>
						<em></em>
					</a>
				
					<?php echo "<p class=\"storyExcerpt\">" . ereg_replace( "\n", " ", get_the_excerpt() ) . "</p>"; ?>
				
					<div class="commentLink icon iconComment"><?php comments_number('0','1','%'); ?></div>
		
					<?php 
					
						if( $postDate != $previousPostDate || $i == 1 ) {
					
							$previousPostDate = $postDate;
							
							echo '<div class="postDate">' . get_the_time('d') . '<span>' . get_the_time('M') .'</span></div>';
						
						}
					
					?>
		
				</div>
		
			</div>

			<?php endwhile; ?>

			<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
				<div id="navBelow" class="navigation">
					<div class="navPrevious"><?php next_posts_link(__( '<span class="metaNav"></span> Older posts', 'moov' )) ?></div>
					<div class="navNext"><?php previous_posts_link(__( 'Newer posts <span class="metaNav"></span>', 'moov' )) ?></div>
				</div>
			<?php } ?>

		</div><!-- #content -->

		<?php else : ?>

			<div id="post-0" class="post noResults notFound">
				<h1><?php printf( __( 'No posts for &ldquo;<span>%s</span>&rdquo;', 'moov' ), get_search_query() ) ?></h1>
				<div class="entryContent">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'moov' ); ?></p>
				</div><!-- .entry-content -->
			</div>

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

		<?php endif; ?>
		
	</div><!-- #container -->
		
<?php get_footer(); ?>