<?php
  require( dirname(__FILE__) . '/../wp-load.php' );
  nocache_headers();  

  $debug=true;

  foreach (array_keys($_POST) as $degis)
  {
    $komut=$_POST[$degis];
    $degis = explode("_", $degis);
    $betano = $degis[count($degis)-1];
if($debug)print $komut;
    if($komut=="kaydet")
    {
//elle veritabanına minimum değerler vererek kayıt yap
/*
    $wp_hasher = new PasswordHash(8, TRUE);
    $password = $wp_hasher->HashPassword($password);
    if(is_numeric($user_id)) {
        $sql = "UPDATE wp_users SET user_pass = '$password' WHERE ID = $user_id LIMIT 1;";
        # then connect to the DB and execute mysql_query($sql)
*/
      $query = "UPDATE wp_beta set durum='kaydedildi' WHERE betano = $betano;";
      mysql_query($query);
if($debug) print $query;

      $query = "SELECT * FROM wp_beta WHERE betano=$betano;";
      mysql_query($query);
if($debug) print $query;
      $result = mysql_query($query);
      $to      = $result[eposta];
      $subject = 'ArtılarıEksileri.co Beta üyeliği isteği';
      $message = 'Merhaba ArtılarıEksileri.co Beta üyeliğine kabul edildiniz.';
      $headers = 'From: bilgi@artilarieksileri.co' . "\r\n" .
	  'X-Mailer: PHP/' . phpversion();
      mail($to, $subject, $message, $headers);
    }
    else if($komut=="sil")
    {
      
    }

  }
  return;
  $query = "SELECT * FROM wp_beta WHERE durum = 'beklemede';";
  $result = mysql_query($query);
?>