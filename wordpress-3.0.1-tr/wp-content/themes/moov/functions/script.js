jQuery(function() {

	var colour_block = jQuery('.colour_block');

	jQuery('#moov_secondary_color').keyup(function() {
	
		var t = jQuery(this);
	
		setTimeout(function(){
		
			colour_block.css({'background':t.val()});
		
		}), 1000;
	
	});

});