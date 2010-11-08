</div>

	<div id="footer">
	
		<div class="bubbleBottom"></div>
	
		<p class="copyright"><?php echo get_option('moov_footer_text','© 2010. All Rights Reserved.'); ?></p>
	
		<p class="badge">Powered by <a href="http://wordpress.org/" title="<?php _e( 'WordPress', 'moov' ) ?>" rel="generator"><?php _e( 'WordPress', 'moov' ) ?></a>. THEMEFOREST <a href="http://www.themeforest.net">MOOV THEME</a> | Designed By: <a href="http://chrismahon.com/">Chris Mahon</a>.</p>
		
	</div>
	
</div>

<script type="text/javascript"> Cufon.now(); </script>

<script type="text/javascript">
site_url = '<?php bloginfo('url'); ?>/';
twitter_name = '<?php echo get_option('moov_twitter'); ?>';
</script>

<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/jquery.lightbox-0.5.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/base.js"></script>
<script type="text/javascript" src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js"></script>

<?php echo stripslashes(get_option('moov_ga_code')); ?>

</body>
</html>