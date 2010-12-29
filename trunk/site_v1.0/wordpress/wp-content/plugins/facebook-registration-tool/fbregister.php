<?php
/*
Plugin Name:	Facebook Registration Tool 
Version:	0.1
Author:		iEntry, Inc.
Author URI:	http://www.beyondwp.com
License: 	GPLv2
*/

/* Copyright 2010  iEntry, Inc.  (email : mmarr@ientry.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if (!class_exists('fbregister')) {
	class fbregister {
		function add_settings_page() {
			add_options_page('Facebook Registration', 'Facebook Registration', 'manage_options', 'fbregister', array(&$this, 'settings_form'));
		}

		function settings_form() {
			include_once('form.php');
		}

		function init() {
			wp_enqueue_script('fbreg', plugins_url('js/fbreg.js', __FILE__), array('jquery'));
		}

		function register_form() { ?>
			<style type="text/css">
				div#login { width: 570px; }
			</style>
			<div id="fb-root"></div>
			<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js#appId=<?php echo get_option('facebook_registration_app_id'); ?>&xfbml=1"></script>
			<fb:registration
			  fields="[{'name':'name'},{'name':'username','description':'Username','type':'text'},{'name':'email'}]"
			  redirect_uri="<?php echo plugins_url('register.php', __FILE__); ?>"
			  width="530"
			  height="270">
			</fb:registration>
	<?php	}

		function login_head() {
			global $wp_scripts;
			$wp_scripts->print_scripts();
		}
	}
}

if (class_exists('fbregister')) {
	$fbregister = new fbregister();
}

if (isset($fbregister)) {
	add_action('admin_menu', array(&$fbregister, 'add_settings_page'));
	add_action('init', array(&$fbregister, 'init'));
	add_action('register_form', array(&$fbregister, 'register_form'));
	add_action('login_head', array(&$fbregister, 'login_head'));
}



?>
