<?php
/** Sets up the WordPress Environment. */
require( dirname(__FILE__) . '/wp-load.php' );
nocache_headers();

$eposta = is_email(isset($_POST['email']) ? $_POST['email'] : "");
if (!$eposta)
{
  print "eposta geçersiz";
  return;
}
$ipadres = $_SERVER['REMOTE_ADDR'];
$tarih = date("Y-n-j");

$data = compact('eposta', 'ipadres', 'tarih');

if ($wpdb->insert($wpdb->beta, $data) == 1)
  print "Beta kaydınız tamamlanmıştır. Bizden haber bekleyin. Bir kaç gün içinde size döneceğiz";
else
  print "hata";

?>