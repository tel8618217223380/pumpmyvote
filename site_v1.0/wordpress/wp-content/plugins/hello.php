<?php
/**
 * @package Hello_Dolly
 * @version 1.5.1
 */
/*
Plugin Name: Hello Dolly
Plugin URI: http://wordpress.org/#
Description: Bu sadece bir eklenti değildir, Louis Armstrong tarafından söylenen iki kelimeyi sembolize eder: Hello, Dolly. Bu eklenti etkinleştirildiğinde yönetim panelinin sağ üst köşesinde her sayfada rasgele sözler göreceksiniz. Not: Sözler İngilizcedir.
Author: Matt Mullenweg
Version: 1.5.1
Author URI: http://ma.tt/
*/

function hello_dolly_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "Hello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
We feel the room swayin'
While the band's playin'
One of your old favourite songs from way back when
So, take her wrap, fellas
Find her an empty lap, fellas
Dolly'll never go away again
Hello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
We feel the room swayin'
While the band's playin'
One of your old favourite songs from way back when
Golly, gee, fellas
Find her a vacant knee, fellas
Dolly'll never go away
Dolly'll never go away
Dolly'll never go away again";

	// Here we split it into lines
	$lyrics = explode("\n", $lyrics);

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand(0, count($lyrics) - 1) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_dolly() {
	$chosen = hello_dolly_get_lyric();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_footer action is called
add_action('admin_footer', 'hello_dolly');

// We need some CSS to position the paragraph
function dolly_css() {
	// This makes sure that the posinioning is also good for right-to-left languages
	$x = ( is_rtl() ) ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		position: absolute;
		top: 4.5em;
		margin: 0;
		padding: 0;
		$x: 215px;
		font-size: 11px;
	}
	</style>
	";
}

add_action('admin_head', 'dolly_css');

?>
