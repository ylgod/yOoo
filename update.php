<?php
define( 'XML_FILE', 'http://hjyl.org/yOoo.xml' ); 
function update_notifier_menu() {  
	if (function_exists('simplexml_load_string')) {
	    $xml = simplexml_load_file( XML_FILE );
		$new_version = $xml->latest;
		$new_version = str_replace('.','',$new_version);
		$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
		$theme_version = $theme_data['Version'];
		$theme_version = str_replace('.','',$theme_version);
		if( $new_version > $theme_version ) {
			if(function_exists('add_object_page')) {
				add_object_page(''.__('Theme Update', 'yOoo').'',''.__('Theme Update', 'yOoo').'', 'administrator', 'theme-update-notifier', 'update_notifier');
			}
		}
	}	
}
add_action('admin_menu', 'update_notifier_menu');  
function update_notifier() {
	$xml = simplexml_load_file( XML_FILE );
	$new_version = $xml->latest;
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); 
	$changelog = $xml->changelog;
	?>
	<div class="wrap">
		<div id="icon-tools" class="icon32"></div>
		<h2><?php _e('yOoo Update', 'yOoo'); ?></h2>
	    <div id="message" class="updated below-h2"><p><strong><?php _e('yOoo Can be Updated!', 'yOoo'); ?></strong><?php _e('This Version', 'yOoo'); ?><?php echo $theme_data['Version']; ?><?php _e('Please Update to', 'yOoo'); ?> <?php echo $new_version; ?>.</p></div>
		<img class="image-notifier-img" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
		<div id="instructions">
		    <h3><?php _e('Download And Update', 'yOoo'); ?></h3>
		    <p style="color:#DD4B39"><?php _e('Notice:Please backup before update!', 'yOoo'); ?></p>
		    <p><a href="<?php echo 'http://hjyl.org/yOoo' ;?>" class="button" target="blank"><?php _e('Download yOoo', 'yOoo'); ?> <strong><?php echo $new_version;?></strong></a></p>
			<h3 class="title"><?php _e('Updates:', 'yOoo'); ?></h3>
			<?php echo $changelog; ?>
		</div>
	</div>
<?php } 
?>