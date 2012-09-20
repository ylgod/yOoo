<?php
// 翻译文件可以放在/languages/文件夹中
load_theme_textdomain( 'yOoo', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

//Add background for theme
add_custom_background(); 

//强化后台编辑器style
add_editor_style('editor.css');

//去除自带js
wp_deregister_script( 'l10n' );	

//禁止在head泄露wordpress版本号
remove_action('wp_head','wp_generator');

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

//禁止引号半角\全角切换
remove_filter('the_content', 'wptexturize');

if ( ! isset( $content_width ) )
	$content_width = 700;
	
// Add menu
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation' ),
	) );
//del rel='category'
	    foreach(array(
        'rsd_link',//rel="EditURI"
        'index_rel_link',//rel="index"
        'start_post_rel_link',//rel="start"
        'wlwmanifest_link'//rel="wlwmanifest"
    ) as $xx)
    remove_action('wp_head',$xx);//X掉以上
    //rel="category"或rel="category tag", 这个最巨量
    function the_category_filter($thelist){
        return preg_replace('/rel=".*?"/','rel="tag"',$thelist);
    }  
    add_filter('the_category','the_category_filter');
	

//注册js库
function my_scripts_method() {
    wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.7.2.min.js');
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

function my_wp_head() {//这个函数里的内容当然也可以直接写到header.php里
  if(get_option('qt')!='' && is_singular() && !is_user_logged_in()) {
    echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/jquery-ui.js"></script>'."\n";
    echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/jquery.ui.touch.js"></script>'."\n";
    echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/QapTcha.jquery.js"></script>'."\n";
    echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/js/QapTcha.jquery.css" type="text/css" />'."\n";
    echo '<script type="text/javascript">
  $(document).ready(function(){
    $(".QapTcha").QapTcha({disabledSubmit:true});
  });
</script>'."\n";
  }
}
add_action('wp_head', 'my_wp_head', 100);
function my_preprocess_comment($comment) {
  if (get_option('qt')!='' && !is_user_logged_in()) {
    if(!session_id()) session_start();
    if(isset($_POST['iQapTcha']) && empty($_POST['iQapTcha']) && isset($_SESSION['iQaptcha']) && $_SESSION['iQaptcha']) {
      //unset($_SESSION['iQaptcha']);   //如果不用ajax评论的话，可以开启这项
      return($comment);
    } else err(__("Sorry, you can't be verified."));//提示语自行修改
  } else
    return($comment);
}
add_action('preprocess_comment', 'my_preprocess_comment');

//分页导航	
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	echo "<a>共".$max_page."页</a>";
	previous_posts_link(' 上一页 ');
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link('下一页');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'>最后一页</a>";}}
}

/*编辑器 开始*/
function add_more_buttons($buttons) {  
$buttons[] = 'fontsizeselect';  
$buttons[] = 'styleselect';  
$buttons[] = 'fontselect';  
$buttons[] = 'hr';  
$buttons[] = 'sub';  
$buttons[] = 'sup';  
$buttons[] = 'cleanup';  
$buttons[] = 'image';  
$buttons[] = 'code';  
$buttons[] = 'media';  
$buttons[] = 'backcolor';  
$buttons[] = 'visualaid';  
return $buttons;  
}  
add_filter("mce_buttons_3", "add_more_buttons");
/*编辑器 结束*/

/*FLV player start*/
function flvplayer($atts, $content=null){
extract(shortcode_atts(array("width"=>'460',"height"=>'330'),$atts));
return '<embed width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" allowfullscreen="true" src="'.get_bloginfo("template_url").'/flvplayer.swf?IsAutoPlay=0&IsContinue=1&BarPosition=1&IsShowBar=1&vcastr_file='.$content.'">
';}
add_shortcode('flv','flvplayer');
/*FLV player end*/

/*youku player*/
function youku($atts, $content=null){
extract(shortcode_atts(array("width"=>'500', "height"=>'375'),$atts));
return'<embed type="application/x-shockwave-flash" src="'.$content.'" id="movie_player" name="movie_player" bgcolor="#FFFFFF" quality="high" allowfullscreen="true" flashvars="isShowRelatedVideo=false&showAd=0&show_pre=1&show_next=1&isAutoPlay=true&isDebug=false&UserID=&winType=interior&playMovie=true&MMControl=false&MMout=false&RecordCode=1001,1002,1003,1004,1005,1006,2001,3001,3002,3003,3004,3005,3007,3008,9999" pluginspage="http://www.macromedia.com/go/getflashplayer" width="'.$width.'" height="'.$height.'">';}
add_shortcode('youku', 'youku');
/*youku player end*/

/*微博式显示方式 XX分钟前*/
function time_diff( $time_type ){
    switch( $time_type ){
        case 'comment':    //如果是评论的时间
            $time_diff = current_time('timestamp') - get_comment_time('U');
			if( $time_diff <= 300 )
				echo ('刚刚');
            elseif(  $time_diff>=300 && $time_diff <= 86400 )    //24 小时之内
                echo human_time_diff(get_comment_time('U'), current_time('timestamp')).' 之前';    //显示格式 OOXX 之前
            else
                printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time());    //显示格式 X年X月X日 OOXX 时
            break;
        case 'post';    //如果是日志的时间
            $time_diff = current_time('timestamp') - get_the_time('U');
			if( $time_diff <= 300 )
				echo ('刚刚');
            elseif(  $time_diff>=300 && $time_diff <= 86400 )    //24 小时之内
                echo human_time_diff(get_the_time('U'), current_time('timestamp')).'之前';
            else
                the_date('Y-m-d');
            break;
    }
}
//END-----------------------------------

// Add sidebar
if ( function_exists('register_sidebar') ){
    register_sidebar(array(
		'name'=>''.__('Home', 'yOoo').'',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2><span class="star">',
        'after_title' => '</span></h2>',
    ));
    register_sidebar(array(
		'name'=>''.__('Single', 'yOoo').'',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2><span class="star">',
        'after_title' => '</span></h2>',
    ));
	register_sidebar(array(
		'name'=>''.__('Other', 'yOoo').'',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2><span class="star">',
        'after_title' => '</span></h2>',
    ));
	}

/* comment_mail_notify v1.0 by willin kan. (有勾選欄, 由訪客決定) */
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回覆通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option('blogname') . '] 的留言有了回應';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 給您的回應:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以點擊 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回應完整內容</a></p>
      <p>歡迎再度光臨 <a href="' . home_url() . '">' . get_option('blogname') . '</a></p>
      <p>(此郵件由系統自動發出, 請勿回覆.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
/* 自動加勾選欄 */
function add_checkbox() {
  echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" style="margin:10px 0;" /><label for="comment_mail_notify">有人回覆時郵件通知我</label>';
}
add_action('comment_form', 'add_checkbox');
// -- END ----------------------------------------

//评论部分
if ( ! function_exists( 'comment' ) ) :
function comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
//主评论计数器初始化 begin - by zwwooooo
	global $commentcount;
	if(!$commentcount) { //初始化楼层计数器
		$page = get_query_var('cpage')-1;
		$cpp=get_option('comments_per_page');//获取每页评论数
		$commentcount = $cpp * $page;
	}
//主评论计数器初始化 end - by zwwooooo
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<span class="floor"><!-- 主评论楼层号 by zwwooooo -->
			<?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);} ?><!-- 当前页每个主评论自动+1 -->
		</span>
		<div id="comment-<?php comment_ID(); ?>" class="comment">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 64, $default, $comment->comment_author ); ?>
			<div class="comment_meta">
				<h3><?php printf( __( '%s ' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h3>
				<a class="comment_time" href="#comment-<?php comment_ID() ?>"><?php time_diff( $time_type = 'comment' ); ?></a>
			<span class="reply">
				<?php if ($depth == get_option('thread_comments_depth')) : ?>    <!-- 评论深度等于设置的最大深度 -->
				 <!-- 将第二个参数改为父一级评论的id -->
					 <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php echo $comment->comment_parent; ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' )" href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">-@</a>
				 <?php else: ?>
				 <!-- 正常情况 -->
					 <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php comment_ID() ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' ) " href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">-@</a>
				 <?php endif; ?>
			</span><!-- .reply -->
			</div>
		</div><!-- .comment-author .vcard -->
			<div class="comment-body"><?php comment_text(); ?></div>


		</div><!-- #comment-##  -->

<?php break;endswitch;}endif;
//分离pingback和trackback
function custom_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    if('pingback' == get_comment_type()) $pingtype = 'Pingback';
    else $pingtype = 'Trackback';
?>
    <li id="comment-<?php echo $comment->comment_ID ?>">
        <?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php echo mysql2date('Y-m-d', $comment->comment_date); ?>
<?php }

//评论者链接重写
function yOoo_add_redirect_comment_link($text = ''){
    $text=str_replace('href="', 'href="'.get_option('home').'/?r=', $text);
    $text=str_replace("href='", "href='".get_option('home')."/?r=", $text);
    return $text;
}
function yOoo_redirect_comment_link(){
    $redirect = $_GET['r'];
    if($redirect){
        if(strpos($_SERVER['HTTP_REFERER'],get_option('home')) !== false){
            header("Location: $redirect");
            exit;
        }
        else {
            header("Location: ".bloginfo('url')."/");
            exit;
        }
    }
}
	//评论链接重定向	
	add_action('init', 'yOoo_redirect_comment_link');
	add_filter('get_comment_author_link', 'yOoo_add_redirect_comment_link', 5);
	add_filter('comment_text', 'yOoo_add_redirect_comment_link', 99);

//登陆页面Logo改造	
add_action('login_head', 'yOoo_login_logo');
//后台登陆LOGO替换
function yOoo_login_logo() { 
	echo '<style type="text/css">h1 a{background-image:url('.get_template_directory_uri().'/images/logo.gif) !important; }</style>';
}

//自定义登陆logo的url
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) { return ''.home_url().''; }

//后台页脚增加主题作者联系及主题链接等信息
add_filter('admin_footer_text', 'yOoo_admin_footer');
//修改WordPress页脚文本
function yOoo_admin_footer() {
	echo '<a target="_blank" href="http://hjyl.org/">皇家元林</a> - 皇家元林 （QQ：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=4953363&site=qq&menu=yes">4953363</a> Email：<a href="mailto:i@hjyl.org">i@hjyl.org</a>） - <a target="_blank" href="http://hjyl.org/">皇家元林</a>';
}

//面包屑导航
function yOoo_crumbs(){
	echo '<nav class="crumbs"><div class="crumbs-sub"><a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a><span></span>';	
	$tag_a = '<a>';	
	if( is_single() ){
		$categorys = get_the_category();
		$category = $categorys[0];
		echo( get_category_parents($category->term_id,true,'<span></span>') );
		echo '<a>'; the_title();
	} elseif ( is_page() )		{ echo $tag_a; the_title();
	} elseif ( is_category() )	{ echo $tag_a; single_cat_title();
	} elseif ( is_tag() )		{ echo $tag_a; single_tag_title();
	} elseif ( is_day() )		{ echo $tag_a; the_time('Y年Fj日');
	} elseif ( is_month() )		{ echo $tag_a; the_time('Y年F');
	} elseif ( is_year() )		{ echo $tag_a; the_time('Y年');
	} elseif ( is_search() )	{ echo $tag_a.$s.' 的搜索结果';
	}
	echo '</a></div>';

	echo '</nav>';
}

//文章（包括feed）末尾加版权说明
function yOoo_copyright($content) {
	if( is_single() ){
		$content.= '<p>--转载请注明：<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> &raquo; <a href="'.get_permalink().'">'.get_the_title().'</a></p>';
	}
	return $content;
}
add_filter('the_content', 'yOoo_copyright');

//去掉分类p标签和换行
function deletehtml($description) { 
$description = trim($description); 
$description = strip_tags($description,""); 
return ($description);
}
add_filter('category_description', 'deletehtml');

    /* 访问计数 */
    function record_visitors()
    {
    if (is_singular())
    {
    global $post;
    $post_ID = $post->ID;
    if($post_ID)
    {
    $post_views = (int)get_post_meta($post_ID, 'views', true);
    if(!update_post_meta($post_ID, 'views', ($post_views+1)))
    {
    add_post_meta($post_ID, 'views', 1, true);
    }
    }
    }
    }
    add_action('wp_head', 'record_visitors');

    /// 函数名称：post_views
    /// 函数作用：取得文章的阅读次数
    function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
    {
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo $before, number_format($views), $after;
    else return $views;
    }
	
/// get_most_viewed_format 
/// 函数作用：取得阅读最多的文章
function get_most_viewed_format($mode = '', $limit = 10, $show_date = 0, $term_id = 0, $beforetitle= '(', $aftertitle = ')', $beforedate= '', $afterdate = '', $beforecount= '<span class="list_comm">', $aftercount = '</span>') {
  global $wpdb, $post;
  $output = '';
  $mode = ($mode == '') ? 'post' : $mode;
  $type_sql = ($mode != 'both') ? "AND post_type='$mode'" : '';
  $term_sql = (is_array($term_id)) ? "AND $wpdb->term_taxonomy.term_id IN (" . join(',', $term_id) . ')' : ($term_id != 0 ? "AND $wpdb->term_taxonomy.term_id = $term_id" : '');
  $term_sql.= $term_id ? " AND $wpdb->term_taxonomy.taxonomy != 'link_category'" : '';
  $inr_join = $term_id ? "INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)" : '';
 
  // database query
  $most_viewed = $wpdb->get_results("SELECT ID, post_date, post_title, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) $inr_join WHERE post_status = 'publish' AND post_password = '' $term_sql $type_sql AND meta_key = 'views' GROUP BY ID ORDER BY views DESC LIMIT $limit");
  if ($most_viewed) {
   foreach ($most_viewed as $viewed) {
    $post_ID    = $viewed->ID;
    $post_views = number_format($viewed->views);
    $post_tt = esc_attr($viewed->post_title);
    $post_title = cut_str(esc_attr($viewed->post_title),36);
    $get_permalink = esc_attr(get_permalink($post_ID));
    $output .= '<li><a href="'.$get_permalink.'" title="'.$post_tt.'">'.$post_title.'</a>';
    if ($show_date) {
      $posted = date(get_option('date_format'), strtotime($viewed->post_date));
      $output .= '$beforedate $posted $afterdate';
    }
    $output .= "$beforecount +$post_views $aftercount</li>";
   }   
  } else {
   $output = "<li>N/A</li>\n";
  }
  echo $output;
}
 /*主题设置*/
 include (TEMPLATEPATH . '/theme_inc.php');
 /*
 //评论Gravatar头像缓存
function my_avatar($avatar) {
	$tmp = strpos($avatar, 'http');
	$g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
	$tmp = strpos($g, 'avatar/') + 7;
	$f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
	$w = home_url();
	$e = ABSPATH .'avatar/'. $f .'.png';
	$t = 1209600; //超时时间设定，默认14天，单位：秒
	if ( !is_file($e) || (time() - filemtime($e)) > $t ) { //当头像不存在或者缓存时间已经超过14天
	copy(htmlspecialchars_decode($g), $e);
	} else $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
	if ( filesize($e) < 500 ) copy($w.'/avatar/default.png', $e);
	return $avatar;
}
add_filter('get_avatar', 'my_avatar');*/
?>
