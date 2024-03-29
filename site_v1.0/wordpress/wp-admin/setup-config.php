<?php
/**
 * Retrieves and creates the wp-config.php file.
 *
 * The permissions for the base directory must allow for writing files in order
 * for the wp-config.php to be created using this page.
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * We are installing.
 *
 * @package WordPress
 */
define('WP_INSTALLING', true);

/**
 * We are blissfully unaware of anything.
 */
define('WP_SETUP_CONFIG', true);

/** 
 * Hata bildirimini kapat
 * 
 * Debug için bu değeri error_reporting( E_ALL ) ya da hata bildirimi için error_reporting( E_ALL | E_STRICT ) olarak değiştirin
 */ 
error_reporting(0);

/**#@+
 * Bu üç tanımlamayı kullanmamız require_wp_db() fonksiyonunu kullanarak
 * wp-content/wp-db.php durumdan haberdarken veritabanı sınıfını yüklememiz için gerekli
 * @ignore
 */
define('ABSPATH', dirname(dirname(__FILE__)).'/');
define('WPINC', 'wp-includes');
define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
define('WP_DEBUG', false);
/**#@-*/

require_once(ABSPATH . WPINC . '/load.php');
require_once(ABSPATH . WPINC . '/compat.php');
require_once(ABSPATH . WPINC . '/functions.php');
require_once(ABSPATH . WPINC . '/classes.php');
require_once(ABSPATH . WPINC . '/version.php');

if (!file_exists(ABSPATH . 'wp-config-sample.php'))
	wp_die('Üzgünüm, çalışabilmem için wp-config-sample.php dosyasına ihtiyacım var. Lütfen dosyayı WordPress kurulum dosyalarından tekrar yükleyin.');

$configFile = file(ABSPATH . 'wp-config-sample.php');

// wp-config.php dosyasının var olup olmadığını kontrol et
if (file_exists(ABSPATH . 'wp-config.php'))
	wp_die("<p>'wp-config.php' dosyası zaten mevcut. Eğer bu dosyadaki ayarları sıfırlamak istiyorsanız, öncelikle dosyayı silin. Şimdi <a href='install.php'>kurulum yapmayı</a> deneyebilirsiniz.</p>");

// Bir üst klasörde wp-config.php dosyasının var olup olmadığını kontrol et
if (file_exists(ABSPATH . '../wp-config.php') && ! file_exists(ABSPATH . '../wp-settings.php'))
	wp_die("<p>'wp-config.php' dosyası bir üst klasörde zaten mevcut. Eğer bu dosyadaki ayarları sıfırlamak istiyorsanız, öncelikle dosyayı silin. Şimdi <a href='install.php'>kurulum yapmayı</a> deneyebilirsiniz.</p>");

if ( version_compare( $required_php_version, phpversion(), '>' ) )
  wp_die( sprintf( /*WP_I18N_OLD_PHP*/'Sunucunuz PHP sürümü olarak %1$s kullanıyor fakat WordPress en az %2$s sürümünü ile çalışabilir.'/*/WP_I18N_OLD_PHP*/, phpversion(), $required_php_version ) );
 
if ( !extension_loaded('mysql') && !file_exists(ABSPATH . 'wp-content/db.php') ) 
  wp_die( /*WP_I18N_OLD_MYSQL*/'PHP kurulumunuzda MySQL eklentisi kurulmamış gözüküyor ki bu eklenti WordPress\'in çalışması için gereklidir.'/*/WP_I18N_OLD_MYSQL*/ );

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;

/**
 * Display setup wp-config.php file header.
 *
 * @ignore
 * @since 2.3.0
 * @package WordPress
 * @subpackage Installer_WP_Config
 */
function display_header() {
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WordPress &rsaquo; Yapılandırma Dosyası Ayarları</title>
<link rel="stylesheet" href="css/install.css" type="text/css" />

</head>
<body>
<h1 id="logo"><img alt="WordPress" src="images/wordpress-logo.png" /></h1>
<?php
}//end function display_header();

switch($step) {
	case 0:
		display_header();
?>

<p>WordPress'e hoşgeldiniz. Kuruluma başlamadan önce, veritabanı üzerinden bazı bilgilerin alınması gerekiyor. Öncelikle sunucunuzda bir veritabanı yaratmış ve aşağıdaki öğelerin değerlerini biliyor olmalısınız.</p>
<ol>
  <li>Veritabanı adı</li> 
  <li>Veritabanı kullanıcı adı</li> 
  <li>Veritabanı parolası</li>
  <li>Veritabanı sunucusu</li> 
  <li>Tablo ön eki (eğer tek veritabanında birden fazla WordPress çalıştıracaksanız) </li>
</ol>
<p><strong>Herhangi bir sebepten dolayı otomatik olarak bu dosya oluşturulamazsa, üzülmeyin. Burada otomatik olarak yapılan veritabanı bilgilerinin yapılandırma dosyasına girilmesidir. Bunu aynı zamanda ana dizinde bulunan <code>wp-config-sample.php</code> dosyasını bir metin editöründe açıp, veritabanı bilgilerini girip <code>wp-config.php</code> olarak kaydederek de yapabilirsiniz. </strong></p>
<p>Buradaki tüm veritabanı bilgileri size sunucunuz tarafından sağlanan değerlerdir. Eğer bu konuda bilginiz yoksa devam etmeden önce sunucunuzla iletişime geçin. Her şey tamamsa&hellip;</p>

<p class="step"><a href="setup-config.php?step=1<?php if ( isset( $_GET['noapi'] ) ) echo '&amp;noapi'; ?>" class="button">Devam edebiliriz!</a></p>
<?php
	break;

	case 1:
		display_header();
	?>
<form method="post" action="setup-config.php?step=2">
	<p>Aşağıya veritabanı bağlantı ayrıntılarını girmeniz gerekiyor. Eğer bu konuda emin değilseniz, sunucu şirketinizle iletişime geçin.</p>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="dbname">Veritabanı Adı</label></th>
			<td><input name="dbname" id="dbname" type="text" size="25" value="wordpress" /></td>
			<td>WP'yi çalıştıracağınız veritabanının adı.</td>
		</tr>
		<tr>
			<th scope="row"><label for="uname">Kullanıcı Adı</label></th>
			<td><input name="uname" id="uname" type="text" size="25" value="kullaniciadi" /></td>
			<td>MySQL kullanıcı adınız</td>
		</tr>
		<tr>
			<th scope="row"><label for="pwd">Parola</label></th>
			<td><input name="pwd" id="pwd" type="text" size="25" value="parola" /></td>
			<td>...ve MySQL parolası.</td>
		</tr>
		<tr>
			<th scope="row"><label for="dbhost">Veritabanı Sunucusu</label></th>
			<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
			<td>%99 ihtimalle bunu değiştirmeniz gerekmeyecek.</td>
		</tr>
		<tr>
			<th scope="row"><label for="prefix">Tablo Ön Eki</label></th>
			<td><input name="prefix" id="prefix" type="text" id="prefix" value="wp_" size="25" /></td>
			<td>Eğer tek veritabanında bir tane WordPress kurulumu yapacaksanız değiştirmenize gerek yok.</td>
		</tr>
	</table>
	<?php if ( isset( $_GET['noapi'] ) ) { ?><input name="noapi" type="hidden" value="true" /><?php } ?>
	<p class="step"><input name="submit" type="submit" value="Gönder" class="button" /></p>
</form>
<?php
	break;

	case 2:
	$dbname  = trim($_POST['dbname']);
	$uname   = trim($_POST['uname']);
	$passwrd = trim($_POST['pwd']);
	$dbhost  = trim($_POST['dbhost']);
	$prefix  = trim($_POST['prefix']);
	if ( empty($prefix) )
		$prefix = 'wp_';

	// Validate $prefix: it can only contain letters, numbers and underscores
	if ( preg_match( '|[^a-z0-9_]|i', $prefix ) )
		wp_die( /*WP_I18N_BAD_PREFIX*/'<strong>HATA</strong>: "Tablo ön eki" sadece rakam, harf ve altçizgi içerebilir.'/*/WP_I18N_BAD_PREFIX*/ );

	// Test the db connection.
	/**#@+
	 * @ignore
	 */
	define('DB_NAME', $dbname);
	define('DB_USER', $uname);
	define('DB_PASSWORD', $passwrd);
	define('DB_HOST', $dbhost);
	/**#@-*/

	// We'll fail here if the values are no good.
	require_wp_db();
	if ( !empty($wpdb->error) )
		wp_die($wpdb->error->get_error_message());

	// Fetch or generate keys and salts.
	$no_api = isset( $_POST['noapi'] );
	require_once( ABSPATH . WPINC . '/plugin.php' );
	require_once( ABSPATH . WPINC . '/l10n.php' );
	require_once( ABSPATH . WPINC . '/pomo/translations.php' );
	if ( ! $no_api ) {
		require_once( ABSPATH . WPINC . '/class-http.php' );
		require_once( ABSPATH . WPINC . '/http.php' );
		wp_fix_server_vars();
		/**#@+
		 * @ignore
		 */
		function get_bloginfo() {
			return ( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . str_replace( $_SERVER['PHP_SELF'], '/wp-admin/setup-config.php', '' ) );
		}
		/**#@-*/
		$secret_keys = wp_remote_get( 'https://api.wordpress.org/secret-key/1.1/salt/' );
	}

	if ( $no_api || is_wp_error( $secret_keys ) ) {
		$secret_keys = array();
		require_once( ABSPATH . WPINC . '/pluggable.php' );
		for ( $i = 0; $i < 8; $i++ ) {
			$secret_keys[] = wp_generate_password( 64, true, true );
		}
	} else {
		$secret_keys = explode( "\n", wp_remote_retrieve_body( $secret_keys ) );
		foreach ( $secret_keys as $k => $v ) {
			$secret_keys[$k] = substr( $v, 28, 64 );
		}
	}
	$key = 0;

	foreach ($configFile as $line_num => $line) {
		switch (substr($line,0,16)) {
			case "define('DB_NAME'":
        $configFile[$line_num] = str_replace("veritabaniisminiz", $dbname, $line); 
				break;
			case "define('DB_USER'":
        $configFile[$line_num] = str_replace("'kullaniciadiniz'", "'$uname'", $line);
				break;
			case "define('DB_PASSW":
        $configFile[$line_num] = str_replace("'parolaniz'", "'$passwrd'", $line);
				break;
			case "define('DB_HOST'":
        $configFile[$line_num] = str_replace("localhost", $dbhost, $line);
				break;
			case '$table_prefix  =':
				$configFile[$line_num] = str_replace('wp_', $prefix, $line);
				break;
			case "define('AUTH_KEY":
			case "define('SECURE_A":
			case "define('LOGGED_I":
			case "define('NONCE_KE":
			case "define('AUTH_SAL":
			case "define('SECURE_A":
			case "define('LOGGED_I":
			case "define('NONCE_SA":
				$configFile[$line_num] = str_replace('put your unique phrase here', $secret_keys[$key++], $line );
				break;
		}
	}
    if ( ! is_writable(ABSPATH) ) : 
      display_header(); 
?> 
<p>Üzgünüm, <code>wp-config.php</code> dosyasına yazamıyorum.</p> 
<p>Kendiniz bir <code>wp-config.php</code> dosyası yarabilir ve aşağıdaki metni içine ekleyebilirsiniz.</p> 
<textarea cols="98" rows="15"><?php 
        foreach( $configFile as $line ) { 
            echo htmlentities($line, ENT_COMPAT, 'UTF-8');
        } 
?></textarea> 
<p>Bu işlemi yaptıktan sonra "Kuruluma devam et" tuşuna basın.</p> 
<p class="step"><a href="install.php" class="button">Kuruluma devam et</a></p> 
<?php 
    else : 
        $handle = fopen(ABSPATH . 'wp-config.php', 'w'); 
        foreach( $configFile as $line ) { 
            fwrite($handle, $line); 
        } 
        fclose($handle); 
        chmod(ABSPATH . 'wp-config.php', 0666); 
        display_header(); 
?>
<p>İşlem tamam! Kurulumun bu kısmı bitti. WordPress artık veritabanınızla bağlantı kurabilir. Eğer hazırsanız &hellip;</p>

<p class="step"><a href="install.php" class="button">Şimdi kuruluma başlayabiliriz!</a></p>
<?php
    endif;
	break;
}
?>
</body>
</html>
