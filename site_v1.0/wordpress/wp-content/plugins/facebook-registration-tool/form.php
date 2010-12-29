<div class="wrap">
	<div id="icon-options-general" class="icon32"><br/></div>
	<h2>Facebook Registration Plugin Settings</h2>
<?php
if ( isset($_POST['fbregistration']) && $_POST['fbregistration'] == 'Y' ) {
	// form has been submitted, so update options
	update_option('facebook_registration_app_id', $_POST['app_id']);
	update_option('facebook_registration_app_secret', $_POST['app_secret']);

	echo '<div class="updated"><p><strong>Settings saved.</strong></p></div>';
}

// get current values to display in form
$app_id = get_option('facebook_registration_app_id');
$secret = get_option('facebook_registration_app_secret');

?>
	<form action="" method="post">
		<input type="hidden" name="fbregistration" value="Y" />
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="app_id">Facebook Application ID</label>
					</th>
					<td>
						<input type="text" id="app_id" name="app_id"
						  value="<?= $app_id ?>" class="regular-text" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="app_secret">Facebook Application Secret</label>
					</th>
					<td>
						<input type="text" id="app_secret" name="app_secret"
						  value="<?= $secret ?>" class="regular-text" />
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input class="button-primary" type="submit" value="Save Changes" name="Submit" />
		</p>
	</form>
