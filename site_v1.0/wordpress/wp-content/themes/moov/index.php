<?php get_header(); ?>
	
	<div id="container">	
		<div id="content">

			<?php $oddeven = 0; $i = 0; while ( have_posts() ) : the_post(); $i++; ?>
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
	</div><!-- #container -->
		
<?php get_footer(); ?>