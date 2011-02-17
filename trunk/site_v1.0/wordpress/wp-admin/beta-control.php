<?php
  require( dirname(__FILE__) . '/../wp-load.php' );
  nocache_headers();  

  $query = "SELECT * FROM wp_beta WHERE durum = 'beklemede';";
  $result = mysql_query($query);
  

  print '
    <form method="post" action="beta-control-post.php">
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
     </form>
';
?> 
