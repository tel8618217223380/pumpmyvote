<?php
/** Sets up the WordPress Environment. */
require('../../../wp-load.php');
nocache_headers();

$eposta = is_email(isset($_POST['email']) ? $_POST['email'] : "");
if (!$eposta)
{
  print "eposta geçersiz.";
  return;
}
$ipadres = $_SERVER['REMOTE_ADDR'];
$tarih = date("Y-n-j");
$durum = 'waiting';
$data = compact('eposta', 'ipadres', 'tarih', 'durum');
//print_r($data);
$cikti = $wpdb->insert($wpdb->beta, $data);

if ($cikti == 1)
  print "<font color='green'>Beta kaydınız tamamlanmıştır. Bizden haber bekleyin. Bir kaç gün içinde size döneceğiz.</font>";
else
{
  print "<font color='red'>Kaydınız tamamlanmadı.</font>";
}

?>
