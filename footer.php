		<div class="clear"></div>
		<footer>
			<h1><?php bloginfo('name'); ?></h1>
			<div class="copyright">
				<p><?php 
					if (is_home() && get_option('bottom_home_link')) {
					echo get_option('bottom_home_link'); ?>
					<?php } ?> <?php 
					if (get_option('bottom_all_link')) {
					echo get_option('bottom_all_link'); ?>
					<?php } ?><a href="<?php echo home_url(); ?>/sitemap.xml" title="<?php bloginfo('name'); ?><?php _e('SiteMap', 'yOoo'); ?>"><?php _e('SiteMap', 'yOoo'); ?></a></p>
				<p>Copyright&nbsp;&copy;&nbsp;<?php echo date("Y"); ?>&nbsp;<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>.<?php echo get_option('stat'); ?></p>
				<p>Powered by <a href="http://wordpress.org/">WordPress.</a>
				| Theme <a href="http://hjyl.org" title="designed by 皇家元林">yOoo.</a><?php echo get_option('icp'); ?></p>
			</div>
			
			<div id="shangxia">
				<div id="shang"></div>
			</div>	
		</footer>
		
	</div><!--#wrapper-->
	
<script src="<?php echo get_template_directory_uri(); ?>/yOoo.js" type="text/javascript"></script>
<?php if (get_option('sb')!='') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slimbox2.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/slimbox2.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var select = $('a[href$=".bmp"],a[href$=".gif"],a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".BMP"],a[href$=".GIF"],a[href$=".JPG"],a[href$=".JPEG"],a[href$=".PNG"]');
		select.slimbox();
	});
</script>
<?php } ?>

<?php if(is_singular()) { ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/comments-ajax.js"></script>
	 <?php if (get_option('fn_a')!=''){ ?>
		<script type="text/javascript">$('.fn a').attr({ target: "_blank"});</script>
	<?php } ?>
<IMG class="img_sina_share" id="imgSinaShare" title=将选中内容分享到新浪微博 src="http://simg.sinajs.cn/blog7style/images/common/share.gif" />
<IMG class="img_qq_share" id="imgQqShare" title=将选中内容分享到腾讯微博 src="http://mat1.gtimg.com/news/2011/logo.png" width="59" height="22"/>
<script type="text/javascript">
    var eleImgShare = document.getElementById("imgSinaShare"); //新浪微博图标
    var eleImgShare2 = document.getElementById("imgQqShare"); //腾讯微博图标

    var $miniBlogShare = function(eleShare,eleShare2,eleContainer) { //实现方法
    var eleTitle = document.getElementsByTagName("title")[0];
    eleContainer = eleContainer || document;
    var funGetSelectTxt = function() { //获取选中文字
    var txt = "";
    if(document.selection) {
    txt = document.selection.createRange().text; // IE
    } else {
    txt = document.getSelection();
    }
    return txt.toString();
    };
    eleContainer.onmouseup = function(e) { //限定容器若有文字被选中
    e = e || window.event;
    var txt = funGetSelectTxt(), sh = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    var left = (e.clientX - 40 < 0) ? e.clientX + 20 : e.clientX - 40, top = (e.clientY - 40 < 0) ? e.clientY + sh + 20 : e.clientY + sh - 40;
    if (txt) {
    eleShare.style.display = "inline";
    eleShare.style.left = left + "px";
    eleShare.style.top = top + "px";
    eleShare2.style.display = "inline";
    eleShare2.style.left = left + 30 + "px";
    eleShare2.style.top = top + "px";
    } else {
    eleShare.style.display = "none";
    eleShare2.style.display = "none";
    }
    };
    eleShare.onclick = function() { //点击新浪微博图标
    var txt = funGetSelectTxt(), title = (eleTitle && eleTitle.innerHTML)? eleTitle.innerHTML : "未命名页面";
    if (txt) {
    window.open('http://v.t.sina.com.cn/share/share.php?title=' + txt + '→来自页面"' + title + '"的文字片段&url=' + window.location.href);
    }
    };
    eleShare2.onclick = function() { //点击腾讯微博图标
    var txt = funGetSelectTxt(), title = (eleTitle && eleTitle.innerHTML)? eleTitle.innerHTML : "未命名页面";
    if (txt) {
    window.open( 'http://v.t.qq.com/share/share.php?title=' + encodeURIComponent(txt + '→来自页面"' + title + '"的文字片段&url=' + window.location.href));
    }
    };
    }(eleImgShare,eleImgShare2);
</script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>