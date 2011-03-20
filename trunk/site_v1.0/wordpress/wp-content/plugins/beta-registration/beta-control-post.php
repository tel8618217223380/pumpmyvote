<?php

  require( '../../../wp-load.php');
nocache_headers();
$user = wp_get_current_user();
$administrator = $user->data->wp_capabilities[administrator];
  if(!$administrator)
  {
    print "You can not access to this page";
    return;
  }

foreach (array_keys($_POST) as $degis)
{
    $komut=$_POST[$degis];
    $degis = explode("_", $degis);

    if ($degis[0].'_'.$degis[1] != 'durum_degis')
    {
	continue;
    }
    $betano = $degis[count($degis)-1];

    if($komut=="kaydet")
    {
	$query = "SELECT * FROM wp_beta WHERE betano = $betano;";
	$result = mysql_query($query);

	if($row = mysql_fetch_assoc($result))
	{
	    //wp_beta tablosunu güncelle    
            $query = "UPDATE wp_beta set durum='enabled' WHERE betano = $betano;";
	    $cikti = mysql_query($query);
 	    if($cikti)
		print "işlem sorunsuz tamamlandı";
	    else
		print "hata: beta-control-post.php update. Sistem yöneticinizle bağlantıya geçin.";
	    //wp_beta tablosunu güncelle

    	    /*E-POSTA GONDERME
	    $query = "SELECT * FROM wp_beta WHERE betano=$betano;";
	    mysql_query($query);
	    if($debug) print $query;
	    $result = mysql_query($query);
	    $to = $result[eposta];
	    $subject = 'ArtılarıEksileri.co Beta üyeliği isteği';
	    $message = 'Merhaba ArtılarıEksileri.co Beta üyeliğine kabul edildiniz.';
	    $headers = 'From: bilgi@artilarieksileri.co' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	    mail($to, $subject, $message, $headers);
            */
	    
	}
    }
    else if($komut=="sil")
    {
	$query = "DELETE FROM wp_beta WHERE betano = $betano;";
        $cikti = mysql_query($query);
	if($cikti)
	    print "işlem sorunsuz tamamlandı";
	else
	    print "hata: beta-control-post.php delete. Sistem yöneticinizle bağlantıya geçin.";
    }
}




/*DEPRECİATED
	    $user_mail = $row[eposta];
	    require_once(ABSPATH . WPINC . '/registration.php');

	    $user_id = username_exists( $user_name );
	    $random_password;
	    if ( !$user_id ) 
	    {
		$random_password = wp_generate_password( 12, false );
		$user_id = wp_create_user( $user_name, $random_password, $user_email );
	    } 
	    else 
	    {
		$random_password = __('User already exists.  Password inherited.');
	    }
*/
?>

