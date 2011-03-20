<?php
/*
Plugin Name: Beta Registration
Plugin URI: ae.co
Description: Beta Registration plugin
Author: Doruk Altan
Version: 0.1
Author URI: 
*/
 
function widget_betaRegistration($args) {
  extract($args);
  echo $before_widget;
  
  $user = wp_get_current_user();
  $administrator = $user->data->wp_capabilities[administrator];
  
  if(!$user->data)
  {
    echo $before_title;?>Beta Hesabı<?php echo $after_title;
    print '<a href="'. get_option('siteurl') .'/wp-content/plugins/beta-registration/wp-beta.php">Beta Hesabı isteği</a>'; 
  }
/*  else if($administrator)
  {
    print '<a href="http://beta.artilarieksileri.co/wp-admin/beta-control.php">Denetim için tıklayın'; 
  }
*/
  echo $after_widget;
}

function betaRegistration_init()
{
  register_sidebar_widget(__('Beta Registration'), 'widget_betaRegistration');
}

add_action("plugins_loaded", "betaRegistration_init");

function beta_registration_admin_menu()
{
  add_options_page('Beta Registration Moderation', 'Beta Registration', 'manage_options', 'beta-registration-unique-identifier', 'beta_registration_moderation');
}

function beta_registration_moderation()
{
  require( ABSPATH . 'wp-load.php');
  nocache_headers();  

  $user = wp_get_current_user();
  $administrator = $user->data->wp_capabilities[administrator];
  if(!$administrator)
  {
    print "You can not access to this page";
    return;
  }

  $query = "SELECT * FROM wp_beta WHERE durum = 'waiting';";
  $result = mysql_query($query);
  
  $num_rows = mysql_num_rows($result);
  if($num_rows < 1)
  {
    print 'Denetim bekleyen hiç kayıt yok.';
    return;
  }

  print '
    <form method="post" action="'. get_option('siteurl') .'/wp-content/plugins/beta-registration/beta-control-post.php">
      <table cellspacing="10">
	<tr height="10">
	  <td>Betano</td>
	  <td>Eposta</td>
	  <td>IP Adresi</td>
	  <td>Tarih</td>
	  <td>Durum</td>
	  <td>Kaydet</td>
	  <td>Sil</td>
	</tr>	
    ';

  while($row = mysql_fetch_assoc($result))
  {
    print "
	<tr>
	  <td>$row[betano]</td>	
	  <td>$row[eposta]</td>
	  <td>$row[ipadres]</td>
	  <td>$row[tarih]</td>
	  <td>$row[durum]</td>
	  <td><input type='radio' name='durum_degis_$row[betano]' value='kaydet' /></td>
	  <td><input type='radio' name='durum_degis_$row[betano]' value='sil' /></td>
	</tr>
    ";
  }

print '
	<tr>
	  <td colspan="5"></td>
	  <td colspan="1" align="right"><input type="reset" value="Temizle"></td>
	  <td colspan="1" align="right"><input type="submit" value="Uygula"></td>
	</tr>
      </table>
      <input type="hidden" name="request_url" value="' . $_SERVER[HTTP_REFERER] . '">
     </form>
';
}

add_action("admin_menu", "beta_registration_admin_menu");
?>
