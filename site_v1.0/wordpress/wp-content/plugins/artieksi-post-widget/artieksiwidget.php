<?php
/*
Plugin Name: ArtiEksi Post Widget
Plugin URI: http://artilarieksileri.co/
Description: Kayıtlı kullanıcıların content girmelerini sağlayan widget
Version: 0.1
Author: Mehmet Burak Aktürk
Author URI: http://mbakturk.blogspot.com
License: Belli değil
*/
/* Şuan belli bir lisanslama yok*/


class ArtiEksi_Post_Widget extends WP_Widget {
	function ArtiEksi_Post_Widget() {
		parent::WP_Widget(false, $name = 'ArtiEksi Post Widget');
	}
	function widget($args, $instance) {
		?>
		      <?php echo $before_widget; ?>
		      <?php if(current_user_can( 'edit_posts' )){  ?>
			 <a id="artieksipostbutton" href="<?php echo admin_url('admin-ajax.php?action=ae-ajax'); ?>"  >
			 <img src="<?php echo plugins_url('image/add-icon.png', __FILE__); ?>" width="32" height="32" /></a>
			 <script type="text/javascript">
			      var ae_post_fancybox = 0;//fancybox kapanma fonksiyonuna yön vermek için
			      jQuery(document).ready(function(){
				
				jQuery("#artieksipostbutton").fancybox(
				{
				  'onClosed':function(){if(ae_post_fancybox==1)location.replace('<?php echo get_option('siteurl'); ?>')}});
			      });
			 </script>
			 <?php }else{
			       echo "<h1>Post için üye ol</h1>";}
			  ?>
		      <?php echo $after_widget; ?>
		<?php
	  }
}

function ae_ajax()
{
 if ( current_user_can( 'edit_posts' ) ) {
   global  $wpdb;
   global  $current_user;
?>
<style>
div#ae_postbox_container{color:black}
div#ae_postbox_container .ae_input_text{border:solid 1px #FF6600; width:490px; height:20px; background-color:white }
div#ae_postbox_container label {color:#FF6600; font-weight:bold}

</style>
<div id="ae_postbox_container" style="width:500px;height:200px">

  <form action="<?php echo admin_url('admin-ajax.php'); ?>" id="ae-post">
    <input type="hidden" name="action" value="ae-insert-post" />
    <input type="hidden" name="ae-post-userid" value="<?php echo $current_user->ID; ?>" />
    <input type="hidden" name="ae-post-nonce" value="<?php echo wp_create_nonce( 'ae-post-nonce'  ); ?>" />
	<label>Başlığınızı girin:</label>
	<input class="ae_input_text" name="ae-title" type="text" value="" /><br>
	<label>Başlığın kategorisini seçin:</label>
	  <select class="ae_input_text" name="ae-categori">
<?php
	    $categories = $wpdb->get_results("SELECT term_id, name FROM $wpdb->terms");
	    foreach ($categories as $categori)
		  echo '<option value="'.$categori->term_id.'">'.$categori->name.'</option>';
?>
	  </select><br>
	  <label>Resim yükleyin:</label>
	  <input class="ae_input_text" type="file" name="ae-image" value="" /><br><br>
	  <input  type="submit" value="Gönder"/>
  </form>

</div>
<script type="text/javascript">
  jQuery(document).ready(function(){

    jQuery("#ae-post").ajaxForm(function(a) {
		  
		  switch(a)
		  {
		    case '0':jQuery("#ae_postbox_container").html("Post başrılı");
			     ae_post_fancybox = 1;
			     break;
		    case '1':jQuery("#ae_postbox_container").html("Parametre eksik");
			     break;
		    case '2':jQuery("#ae_postbox_container").html("kullanıcının yazma hakkı yok");
			     break;
		    case '3':jQuery("#ae_postbox_container").html("post yetkili bir kullanıcı tarafından kesin belli bir yerden yapılmadı.");
			     break;
		  }
		});
  });
</script>

<?php
}
 else
 {
  echo "<h2>hakkın yok baboli</h2>";
 }
  exit;
}

function ae_insert_post()
{
    if(isset($_POST['ae-post-userid'])&&isset($_POST['ae-title'])&&isset($_POST['ae-categori'])&&isset($_FILES['ae-image'])&&isset($_POST['ae-post-nonce']))
    {
      if ( ! wp_verify_nonce( $_POST['ae-post-nonce'], 'ae-post-nonce'  ))
	  die("3");//post yetkili bir kullanıcı tarafından kesin belli bir yerden yapılmadı.
      if ( current_user_can( 'edit_posts' ) )
      {
	$upload=wp_upload_bits($_FILES["ae-image"]["name"], null, file_get_contents($_FILES["ae-image"]["tmp_name"]));

	$ae_post = array(
			'post_title' => $_POST['ae-title'],
			'post_author' => $_POST['ae-post-userid'],
			'post_content' => '',
			'post_status' => 'publish',
			'post_category' => array($_POST['ae-categori'])
			);
	$post_id=wp_insert_post( $ae_post );

	$filename = $upload['file'];

	$wp_filetype = wp_check_filetype(basename($filename), null );
	$attachment = array(
	  'post_mime_type' => $wp_filetype['type'],
	  'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
	  'post_content' => '',
	  'post_status' => 'inherit'
	);
	$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
	// you must first include the image.php file
	// for the function wp_generate_attachment_metadata() to work
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id,  $attach_data );
	add_post_meta( $post_id, '_thumbnail_id', $attach_id );
	echo '0';//başarılı
      }
      else
	echo '2';//kullanıcının yazma hakkı yok
    }
    else
      echo '1';//parametre eksik
  exit;
}

add_action('widgets_init', create_function('', 'return register_widget("ArtiEksi_Post_Widget");'));

add_action( 'wp_ajax_nopriv_ae-ajax', 'ae_ajax'  );
add_action( 'wp_ajax_ae-ajax', 'ae_ajax' );

add_action( 'wp_ajax_nopriv_ae-insert-post', 'ae_insert_post'  );
add_action( 'wp_ajax_ae-insert-post', 'ae_insert_post' );

wp_enqueue_script("jquery-form");
wp_enqueue_script('fancybox-pack',plugins_url('js/fancybox/jquery.fancybox-1.3.4.pack.js', __FILE__),array(),"1.3.4",false);
wp_enqueue_style('fancybox-style',plugins_url('js/fancybox/jquery.fancybox-1.3.4.css', __FILE__));

?>