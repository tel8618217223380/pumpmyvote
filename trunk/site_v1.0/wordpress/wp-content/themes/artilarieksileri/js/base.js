var site_url;
var twitter_name;

$(function() {

	/* FORMS ---------------------------------------------------------*/

		$('textarea.hint, input.hint').hint();
	
	/* IMAGES ---------------------------------------------------------*/
	
		$('.otherStory a').mouseenter(function(){
		
			$(this).parents('.otherStory:first').addClass('hover');
			
		}).mouseleave(function(e){
		
			$(this).parents('.otherStory:first').removeClass('hover');
			
		});
	
	/* OTHER POSTS ---------------------------------------------------------*/
	
		var otherPostsPage = 1;
		var otherPostsPageCount = Math.ceil( $('.otherPosts li').length / 5 );
		var otherPostsOffset = 0;
		var otherPostsWidth = $('.otherPosts .inner').outerWidth() - 90;
	
		$('.otherPosts .morePosts').click(function(){
		
			if(otherPostsPage < otherPostsPageCount) {
		
				otherPostsPage += 1;
				otherPostsOffset -= otherPostsWidth;
			
				$('.overflow ul').animate({"marginLeft": otherPostsOffset + "px"}, "fast", "swing");

			}
		
			if(otherPostsPage >= 1) {
				$('.lessPosts').animate({"left": "0","opacity": "100"}, "fast", "swing");
			}
			if(otherPostsPage == otherPostsPageCount) {
				$('.morePosts').animate({"right": "50px","opacity": "0"}, "fast", "swing");
			}
		
			return false;
		
		});
		
		$('.otherPosts .lessPosts').click(function(){
		
			if(otherPostsPage > 1) {
			
				otherPostsPage -= 1;
				otherPostsOffset += otherPostsWidth;
			
				$('.overflow ul').animate({"marginLeft": otherPostsOffset + "px"}, "fast", "swing");
				
			}
		
			if(otherPostsPage == 1) {
				$('.lessPosts').animate({"left": "50px","opacity": "0"}, "fast", "swing");
			}
			if(otherPostsPage >= 1) {
				$('.morePosts').animate({"right": "0","opacity": "100"}, "fast", "swing");
			}
		
			return false;
		
		});

		$('.otherPosts ul').width( otherPostsWidth * otherPostsPageCount );

	/* LIGHTBOX ---------------------------------------------------------*/
		
		$('.lightbox').lightBox({
			imageLoading: site_url + 'wp-content/themes/moov/images/lightbox-ico-loading.gif',
			imageBtnClose: site_url + 'wp-content/themes/moov/images/lightbox-btn-close.gif',
			imageBtnPrev: site_url + 'wp-content/themes/moov/images/lightbox-btn-prev.png',
			imageBtnNext: site_url + 'wp-content/themes/moov/images/lightbox-btn-next.png'
		});
		
	/* TWITTER ---------------------------------------------------------*/

		if(twitter_name) {

			getTwitters('tweetContent', { 
				id: twitter_name,
				count: 1,
				enableLinks: true,
				ignoreReplies: false,
				clearContents: true,
				template: '<p>%text%</p> <p class="meta"><a href="http://twitter.com/%user_screen_name%/statuses/%id%/">%time%</a> via %source%</p>'
			});
		
		}
		
	/* HEIGHT FIXES ---------------------------------------------------------*/
		
		$('span.dropCap').css({ 'height' : $('.entryContent p:first').outerHeight() + 10 });

});

$.fn.hint = function() {
	return this.each(function(){
		var t = $(this); // get jQuery version of 'this'
		var title = t.attr('title'); // get it once since it won't change
		
		if (title) { // only apply logic if the element has the attribute
			
			// on focus, set value to blank if current value matches title attr
			t.focus(function(){
				if (t.val() == title) {
					t.val('');
					t.addClass('blur');
				}
			})

			// on blur, set value to title attr if text is blank
			t.blur(function(){
				if (t.val() == '') {
					t.val(title);
					t.removeClass('blur');
				}
			})

			// now change all inputs to title
			t.blur();
		}
	})
}