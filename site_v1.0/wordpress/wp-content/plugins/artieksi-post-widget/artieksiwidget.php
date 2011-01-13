<?php
/*
Plugin Name: ArtiEksi Post Widget
Plugin URI: http://artilarieksileri.co/
Description: Kayıtlı kullanıcıların content girmelerini sağlayan widget
Version: 0.1
Author: Mehmet Burak Aktürk
Author URI: http://mbakturk.blogspot.com
License: GPL
*/
/* This calls hello_world() function when wordpress initializes.*/
/* Note that the hello_world doesnt have brackets.*/

class ArtiEksi_Post_Widget extends WP_Widget {
	function ArtiEksi_Post_Widget() {
		// widget actual processes
		parent::WP_Widget(false, $name = 'ArtiEksi Post Widget');
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		?>
		      <?php echo $before_widget; ?>
			  <?php /* if ( $title )
				echo $before_title . $title . $after_title;*/ ?>
			 <a id="artieksipostbutton" href="http://localhost/wordpress/wp-admin/admin-ajax.php?action=artieksi-ajax" ><img src="http://www.iconarchive.com/icons/visualpharm/must-have/256/Add-icon.png" width="32" height="32" /></a>
		      <?php echo $after_widget; ?>
		<?php
	  }

	    /** @see WP_Widget::update */
	    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	    }

	    /** @see WP_Widget::form */
	    function form($instance) {
		$title = esc_attr($instance['title']);
		?>
		    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<?php
	    }

} // class FooWidget

function artieksi_ajax()
{
 if ( current_user_can( 'edit_posts' ) ) {
   global  $wpdb;
   global $current_user;
?>

<div style="width:500px;height:200px">

  <form action="http://localhost/wordpress/wp-admin/admin-ajax.php" id="artieksi-post">
    <input type="hidden" name="action" value="artieksi-insert-post" />
    <input type="hidden" name="artieksi-post-userid" value="<?php echo $current_user->ID; ?>" />
    <table>
      <tr>
	<td><input name="artieksi-title" type="text" value="Başlığınızı girin" /></td>
      </tr>
      <tr>
	<td>
	  <select name="artieksi-categori">
<?php
	    $categories = $wpdb->get_results("SELECT term_id, name FROM $wpdb->terms");
	    foreach ($categories as $categori)
		  echo '<option value="'.$categori->term_id.'">'.$categori->name.'</option>';
?>
	  </select>
	</td>
	</tr>
	<tr>
	<td >
	  <input type="file" name="ae-image" value="" />
	</td>
	</tr>
	<tr>
	<td >
	  <input type="submit" value="Gönder"/>
	</td>
      </tr>
    </table>
    
    
  </form>
  
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){

    jQuery("#artieksi-post").ajaxForm(function(a) {
                alert("Thank you for your comment!"+a);
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

function artieksi_insert_post()
{
  if ( current_user_can( 'edit_posts' ) )
    if(isset($_POST['artieksi-post-userid'])&&isset($_POST['artieksi-title'])&&isset($_POST['artieksi-categori'])&&isset($_FILES['ae-image']))
    {
      $upload=wp_upload_bits($_FILES["ae-image"]["name"], null, file_get_contents($_FILES["ae-image"]["tmp_name"]));

      $ae_post = array(
		      'post_title' => $_POST['artieksi-title'],
		      'post_author' => $_POST['artieksi-post-userid'],
		      'post_content' => '',
		      'post_status' => 'publish',
		      'post_category' => array($_POST['artieksi-categori'])
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

      /*
      $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($upload['file'])),
     'post_content' => '',
     'post_status' => 'inherit',
     'guid' => $upload['url'],
     'post_type' => 'attachment',
     'post_name' => preg_replace('/\.[^.]+$/', '', basename($upload['file'])),
     'post_parent' => $post_id
      );
  
      $attach_id=wp_insert_post( $attachment );
      add_post_meta( $post_id, '_thumbnail_id', $attach_id );
      */

      echo 'tamamdır koç';
    }
    else
      echo "shit";
  else
    echo "fuck";
  exit;
}

add_action( 'wp_ajax_nopriv_artieksi-ajax', 'artieksi_ajax'  );
add_action( 'wp_ajax_artieksi-ajax', 'artieksi_ajax' );

add_action( 'wp_ajax_nopriv_artieksi-insert-post', 'artieksi_insert_post'  );
add_action( 'wp_ajax_artieksi-insert-post', 'artieksi_insert_post' );
add_action('widgets_init', create_function('', 'return register_widget("ArtiEksi_Post_Widget");'));
wp_enqueue_script("jquery-form");

wp_enqueue_script('fancybox-pack',plugins_url('js/fancybox/jquery.fancybox-1.3.4.pack.js', __FILE__),array(),"1.3.4",false);
wp_enqueue_style('fancybox-style',plugins_url('js/fancybox/jquery.fancybox-1.3.4.css', __FILE__));
wp_enqueue_script('artieksiscripts',plugins_url('js/artieksiscripts.js', __FILE__),array(),"0.1",true);


?>