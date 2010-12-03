<div id="searchForm">
	<form action="<?php bloginfo('url'); ?>" method="get" accept-charset="utf-8">
		<fieldset>
			<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" class="hint" title="Search..." />
			<button type="submit" name="submitButton" id="submitButton" title="Search"><span><em>Search</em></span></button>
		</fieldset>
	</form>
</div>