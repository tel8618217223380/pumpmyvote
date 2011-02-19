<?php
require( dirname(__FILE__) . '/../wp-load.php' );
nocache_headers();

foreach (array_keys($_POST) as $degis)
{
    $komut=$_POST[$degis];
    $degis = explode("_", $degis);
    $betano = $degis[count($degis)-1];

    if($komut=="kaydet")
    {
	$query = "SELECT * FROM wp_beta WHERE betano = $betano;";
	$result = mysql_query($query);

	if($row = mysql_fetch_assoc($result))
	{	
	    $user_name = $row[kullaniciadi];
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
	    
    //wp_beta tablosunu güncelle
	    if(is_numeric ($user_id))
	    {
		$query = "UPDATE wp_beta set durum='kaydedildi' WHERE betano = $betano;";
		mysql_query($query);
	    }
    //wp_beta tablosunu güncelle

    /*E-POSTA GONDERME
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
    */
	}
    }
    else if($komut=="sil")
    {
	$query = "DELETE FROM wp_beta WHERE betano = $betano;";
	mysql_query($query);
    }
print "$komut işlemi sorunsuz tamamlandı.Yönlendiriliyorsunuz.";

}
?>
