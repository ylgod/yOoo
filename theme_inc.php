<?php

function yOoo_options() {
add_theme_page("yOoo Options", "yOoo Options", 'administrator', basename(__FILE__), 'yOoo_form');
add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {

	//register our settings
	register_setting( 'yOoo-settings', 'description');
	register_setting( 'yOoo-settings', 'keywords');
	register_setting( 'yOoo-settings', 'adx');
	register_setting( 'yOoo-settings', 'adxx');
	register_setting( 'yOoo-settings', 'adxxx');
	register_setting( 'yOoo-settings', 'icp');
	register_setting( 'yOoo-settings', 'stat');
	register_setting( 'yOoo-settings', 'bottom_home_link');
	register_setting( 'yOoo-settings', 'bottom_all_link');
	register_setting( 'yOoo-settings', 'sb');
	register_setting( 'yOoo-settings', 'qt');
	register_setting( 'yOoo-settings', 'update');
	register_setting( 'yOoo-settings', 'gravatar');
	register_setting( 'yOoo-settings', 'fn_a');
	
}

function yOoo_form(){
global $themename;
if ( $_REQUEST['settings-updated'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已保存。</strong></p></div>';
 ?>
<style>
fieldset {border: 1px solid #DDDDDD;border-radius: 5px 5px 5px 5px;margin: 5px 0 10px;padding: 0 15px;}
fieldset legend {font-size: 14px;padding: 0 5px;}
</style>

 <div class="icon32" id="icon-themes"><br></div>
<h2><?php _e('yOoo Options', 'yOoo'); ?></h2>
<form method="post" action="options.php">
<?php settings_fields('yOoo-settings'); ?>
<fieldset>
<legend><?php _e('yOoo Options', 'yOoo'); ?></legend>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">SEO优化：
					<br/>
					<small style="font-weight:normal;">meta标签设置</small></th>
					<td>
						<div align="left">
						关键词keywords 「以英文逗号隔开，建议不超过100字包括字符」<br />
						<input type="text" style="width:50em;" name="keywords" value="<?php echo get_option('keywords'); ?>" />
						<br /><br />
						描述description 「建议不超过150字包括符号」<br />
						<input type="text" style="width:50em;" name="description" value="<?php echo get_option('description'); ?>" />
						</div></td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">滑动解锁评论验证功能：</th>
					<td>
						<input name="qt" type="checkbox" id="7" value="1" <?php if (get_option('qt')!='') echo 'checked="checked"'; ?>/>启用QapTcha滑动解锁插件</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">点击图片放大功能：</th>
					<td>
						<input name="sb" type="checkbox" id="7" value="1" <?php if (get_option('sb')!='') echo 'checked="checked"'; ?>/>启用slimbox2插件</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">主题升级提示：</th>
					<td>
						<input name="update" type="checkbox" id="7" value="1" <?php if (get_option('update')!='') echo 'checked="checked"'; ?>/>启用主题升级提示。<span style="color:red;">[如果有新版本，会在后台-外观上方出现「主题升级」菜单]</span></td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">头像缓存设置：</th>
					<td>
						<input name="gravatar" type="checkbox" id="7" value="1" <?php if (get_option('gravatar')!='') echo 'checked="checked"'; ?>/>启用图片缓存功能。若空间不支持，取消这项。<span style="color:red;">注意启用前，在WordPress根目录建立avatar文件夹，并上传default.jpg</span></td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">评论链接新窗口打开：</th>
					<td>
						<input name="fn_a" type="checkbox" id="7" value="1" <?php if (get_option('fn_a')!='') echo 'checked="checked"'; ?>/>开启评论链接新窗口打开。</td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">336×280广告位：
					<br/>
					<small style="font-weight:normal;">文章右侧广告</small></th>
					<td>
						<textarea style="width:50em; height:8em;" name="adx"><?php echo get_option('adx'); ?></textarea></td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">468×60广告位：
					<br/>
					<small style="font-weight:normal;">文章底部广告</small></th>
					<td>
						<textarea style="width:50em; height:8em;" name="adxx"><?php echo get_option('adxx'); ?></textarea></td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">468×60广告位：
					<br/>
					<small style="font-weight:normal;">归档顶部广告</small></th>
					<td>
						<textarea style="width:50em; height:8em;" name="adxxx"><?php echo get_option('adxxx'); ?></textarea></td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">底部首页显示链接：</th>
					<td>
						<textarea style="width:50em; height:8em;" name="bottom_home_link"><?php echo get_option('bottom_home_link'); ?></textarea></td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">底部全站显示链接：</th>
					<td>
						<textarea style="width:50em; height:8em;" name="bottom_all_link"><?php echo get_option('bottom_all_link'); ?></textarea></td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">备案信息：</th>
					<td>
						<input type="text" style="width:30em;" name="icp" value="<?php echo get_option('icp'); ?>" /></td>
				</tr>
			</tbody>
		</table>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">统计代码：</th>
					<td>
						<textarea style="width:50em; height:8em;" name="stat"><?php echo get_option('stat'); ?></textarea></td>
				</tr>
			</tbody>
		</table>
		
<p class="submit"><input type="submit" value="<?php _e('Save Changes') ?>" name="save" id="button-primary" /></p>
</form>
</fieldset>
<?php
}
add_action('admin_menu', 'yOoo_options');

 //主题更新提示
 if (get_option('update')!=''){
	require_once(TEMPLATEPATH . '/update.php');
 }
  /*小工具添加*/
 include (TEMPLATEPATH . '/widgets.php'); 
 //评论Gravatar头像缓存
if (get_option('gravatar')!='') {
function my_avatar($avatar) {
	$tmp = strpos($avatar, 'http');
	$g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
	$tmp = strpos($g, 'avatar/') + 7;
	$f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
	$w = home_url();
	$e = ABSPATH .'avatar/'. $f .'.jpg';
	$t = 1209600; //超时时间设定，默认14天，单位：秒
	if ( !is_file($e) || (time() - filemtime($e)) > $t ) { //当头像不存在或者缓存时间已经超过14天
	copy(htmlspecialchars_decode($g), $e);
	} else $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.jpg'));
	if ( filesize($e) < 500 ) copy($w.'/avatar/default.jpg', $e);
	return $avatar;
}
add_filter('get_avatar', 'my_avatar');
}
?>