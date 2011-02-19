<?php
/** Sets up the WordPress Environment. */
require( dirname(__FILE__) . '/wp-load.php' );
nocache_headers();

$eposta = is_email(isset($_POST['email']) ? $_POST['email'] : "");
$kullaniciadi = isset($_POST['username']) ? $_POST['username'] : "";
if(!$kullaniciadi)
{
  print "kullanıcı adı boş olmamalı.";
  return;
}
else if (!$eposta)
{
  print "eposta geçersiz.";
  return;
}
$ipadres = $_SERVER['REMOTE_ADDR'];
$tarih = date("Y-n-j");
$durum = 'beklemede';
$data = compact('kullaniciadi', 'eposta', 'ipadres', 'tarih', 'durum');
//print_r($data);
$cikti = $wpdb->insert($wpdb->beta, $data);

if ($cikti == 1)
  print "<font color='green'>Beta kaydınız tamamlanmıştır. Bizden haber bekleyin. Bir kaç gün içinde size döneceğiz.</font>";
else
{
  print "<font color='red'>Kaydınız tamamlanmadı.</font>";
}

?>