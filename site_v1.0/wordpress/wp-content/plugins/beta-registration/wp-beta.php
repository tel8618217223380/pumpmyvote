<?php
if(!isset($_GET[ABSPATH]))
{
	print 'eksik parametre';
	return;
}
print '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<form method="post" action="wp-beta-post.php">
	<label for="email">E-Posta:</label><input type="text" id="email" name="email"><br>
	<input type="submit" value="başvur"><br>
	<input type="hidden" name="ABSPATH" value="'. $_GET[ABSPATH] .'">
	</form>
	';
?>
