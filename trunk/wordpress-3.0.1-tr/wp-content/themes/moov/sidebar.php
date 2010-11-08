<div id="sidebar">

	<ul id="navigation">
		<li<?php if ( is_front_page() || is_single() ) { echo " class=\"current_page_item\""; } ?>><a href="<?php bloginfo( 'url' ) ?>/">Home</a></li>
		<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
	</ul>

<?php if ( is_sidebar_active('primary_widget_area') ) : ?>
	<div id="primary" class="widgetArea">
		<ul>
			<?php dynamic_sidebar('primary_widget_area'); ?>
		</ul>
	</div><!-- #primary .widgetArea -->
<?php endif; ?>		
		
<?php if ( is_sidebar_active('secondary_widget_area') ) : ?>
	<div id="secondary" class="widgetArea">
		<ul>
			<?php dynamic_sidebar('secondary_widget_area'); ?>
		</ul>
	</div><!-- #secondary .widgetArea -->
<?php endif; ?>		

	<?php $twitter = get_option('moov_twitter'); if ( $twitter ) : ?>

	<div id="latestTweet" class="column">

		<h3>Latest Tweet</h3>

		<div id="tweetContent">
		
			<p>Please wait while my tweets load from Twitter. If you can't wait or nothing appears, check me out on <a href="http://twitter.com/<?php echo $twitter; ?>">Twitter</a></p>
		
		</div>

	</div>
	
	<?php endif; ?>
	
	<?php
	
		$advert_1 = get_option('moov_advert_1');
		$advert_2 = get_option('moov_advert_2');
		$advert_3 = get_option('moov_advert_3');
		$advert_4 = get_option('moov_advert_4');
	
	?>
	
	<?php if( $advert_1 || $advert_2 || $advert_3 || $advert_4 ) { ?>
	<div id="advertSlot">
	
		<h3>Advertisements</h3>
	
		<ul>
			<?php if( $advert_1 ) { ?><li><?php echo stripslashes($advert_1); ?></li><?php } ?>
			<?php if( $advert_2 ) { ?><li><?php echo stripslashes($advert_2); ?></li><?php } ?>
			<?php if( $advert_3 ) { ?><li><?php echo stripslashes($advert_3); ?></li><?php } ?>
			<?php if( $advert_4 ) { ?><li><?php echo stripslashes($advert_4); ?></li><?php } ?>
		</ul>
	
	</div>
	<?php } ?>

</div>