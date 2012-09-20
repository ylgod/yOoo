<?php

/*边栏*/

global $options;


/*QQ邮件列表*/
class qq_list extends WP_Widget //QQ邮件列表
{
    function qq_list(){
		$widget_ops = array('classname'=>'set_contact','description'=>'QQ邮件列表订阅');
		$this->WP_Widget(false,'QQ邮件列表',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('title'=>'订阅邮箱','list'=>'80a55f96f3f6171f84f5accb83c34bb76fe1ff5f989e0398'));
		$title = htmlspecialchars($instance['title']);
		$list = htmlspecialchars($instance['list']);

		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:220px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('list').'">邮件列表id:<input style="width:220px;" id="'.$this->get_field_id('list').'" name="'.$this->get_field_name('list').'" type="text" value="'.$list.'" /></label></p>';
		echo '<p style="text-align:left;"><a href="http://list.qq.com/" target="_blank">申请qq邮件列表</a>列如下面的蓝色代码</p>';
    	echo '<p style="text-align:left;"><div class="wp_syntax" style="overflow: auto;height: 37px; width: 220px;border: 1px solid #C0C0C0;"><pre  style="font-family:monospace;">   http://list.qq.com/cgi-bin/qf_invite?id=<span style="color: #0000ff;">80a55f96f3f6171f84f5accb83c34bb76fe1ff5f989e0398</span></pre></div></p>';
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['list'] = strip_tags(stripslashes($new_instance['list']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
	  $list = empty($instance['list']) ? '#' : $instance['list'];

	  echo '<li class="widget widget_mail">';
	  echo $before_title . $title . $after_title;
	  ?>
		 
		<form method="post" target="_blank" action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" style="padding:10px 20px;">
		<input type="hidden" value="qf_booked_feedback" name="t">
		<input type="hidden" value="<?php echo $list ?>" name="id">
		<input type="text" onblur="if (this.value == '') {this.value = '请输入您的邮箱';}" onfocus="if (this.value == '请输入您的邮箱') {this.value = '';}" value="请输入您的邮箱" class="rsstxt" name="to" id="to">
		<input style="width:100px; margin: 10px 0; cursor: pointer; color: #999; border: 1px solid #ddd" type="submit" value="确认订阅">
		</form> 

	  <?php 
	  echo $after_widget;
   }
}

add_action('widgets_init',create_function('', 'return register_widget("qq_list");'));


/*Google搜索*/
class Google_soso extends WP_Widget //Google自定义搜索
{
    function Google_soso(){
		$widget_ops = array('classname'=>'set_contact','description'=>'Google自定义搜索');
		$this->WP_Widget(false,'Google自定义搜索',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('Google'=>'000311857849901373481:nriw9a-5wfq'));
		$Google = htmlspecialchars($instance['Google']);

		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Google').'">搜索id:<input style="width:220px;" id="'.$this->get_field_id('Google').'" name="'.$this->get_field_name('Google').'" type="text" value="'.$Google.'" /></label></p>';
		echo '<p style="text-align:left;"><a href="http://www.google.com/cse/?hl=zh-CN" target="_blank">申请Google自定义搜索</a>如下面代码</p>';
    	echo '<p style="text-align:left;"><div class="wp_syntax" style="overflow: auto;height: 37px; width: 220px;border: 1px solid #C0C0C0;"><pre  style="font-family:monospace;">000311857849901373481:nriw9a-5wfq</span></pre></div></p>';
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['Google'] = strip_tags(stripslashes($new_instance['Google']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $Google = empty($instance['Google']) ? '#' : $instance['Google'];

	  ?>
		 
		 
<li class="widget widget_search">
	<form action="http://www.google.com/cse" id="cse-search-box" target="_blank">
	  <input type="hidden" name="cx" value="<?php echo $Google ?>">
   <input type="hidden" name="ie" value="UTF-8">
<input type="text" value="Google搜索..." name="q" id="s" onfocus="this.value = this.value == this.defaultValue ? '' : this.value" onblur="this.value = this.value == '' ? this.defaultValue : this.value">
</form>
</li>
	  <?php 
	
   }
}

add_action('widgets_init',create_function('', 'return register_widget("Google_soso");'));


/*热门文章*/
class Heat extends WP_Widget //热门文章
{
    function Heat(){
		$widget_ops = array('classname'=>'set_contact','description'=>'热门文章');
		$this->WP_Widget(false,'热门文章',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('title'=>'热门文章', 'Heat'=>'10'));
		$title = htmlspecialchars($instance['title']);
		$Heat = htmlspecialchars($instance['Heat']);

		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:220px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Heat').'">最多显示多少条:<input style="width:220px;" id="'.$this->get_field_id('Heat').'" name="'.$this->get_field_name('Heat').'" type="text" value="'.$Heat.'" /></label></p>';
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['Heat'] = strip_tags(stripslashes($new_instance['Heat']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
	  $Heat = empty($instance['Heat']) ? '#' : $instance['Heat'];


	  echo '<li class="widget widget_recent_entries">';
	  echo $before_title . $title . $after_title;
	  ?>
		 

	<ul>	
			
<?php
global $wpdb;
 $pop = $wpdb->get_results("SELECT id, post_title, comment_count FROM {$wpdb->prefix}posts WHERE post_type='post' AND post_status='publish' AND post_password='' ORDER BY comment_count DESC LIMIT ".$Heat.""); ?>
<?php foreach($pop as $post) : ?>
<li><a href="<?php echo get_permalink($post->id); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a></li>
<?php endforeach; ?>
			
		</ul>

	  <?php 
	  echo $after_widget;
   }
}
add_action('widgets_init',create_function('', 'return register_widget("Heat");'));

/*相关文章*/
class Related extends WP_Widget //相关文章
{
    function Related(){
		$widget_ops = array('classname'=>'set_contact','description'=>'相关文章');
		$this->WP_Widget(false,'相关文章',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('title'=>'相关文章', 'Related'=>'10'));
		$title = htmlspecialchars($instance['title']);
		$Related = htmlspecialchars($instance['Related']);

		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:220px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Related').'">最多显示多少条:<input style="width:220px;" id="'.$this->get_field_id('Related').'" name="'.$this->get_field_name('Related').'" type="text" value="'.$Related.'" /></label></p>';
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['Related'] = strip_tags(stripslashes($new_instance['Related']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
	  $Related = empty($instance['Related']) ? '#' : $instance['Related'];


	  echo '<li class="widget widget_recent_entries">';
	  echo $before_title . $title . $after_title;
	  ?>
		 

	<ul>	
		<?php
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
		$first_tag = $tags[0]->term_id;
		$args=array(
		'tag__in' => array($first_tag),
		'post__not_in' => array($post->ID),
		'showposts'=>$Related,
		'caller_get_posts'=>1
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
		while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
		<?php
		endwhile;
		}
		}
		wp_reset_query();
		?>
	</ul>

	  <?php 
	  echo $after_widget;
   }
}
add_action('widgets_init',create_function('', 'return register_widget("Related");'));

/*随机文章*/
class Rand extends WP_Widget //随机文章
{
    function Rand(){
		$widget_ops = array('classname'=>'set_contact','description'=>'随机文章');
		$this->WP_Widget(false,'随机文章',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('title'=>'随机文章', 'Rand'=>'10'));
		$title = htmlspecialchars($instance['title']);
		$Rand = htmlspecialchars($instance['Rand']);

		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:220px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Rand').'">最多显示多少条:<input style="width:220px;" id="'.$this->get_field_id('Rand').'" name="'.$this->get_field_name('Rand').'" type="text" value="'.$Rand.'" /></label></p>';
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['Rand'] = strip_tags(stripslashes($new_instance['Rand']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
	  $Rand = empty($instance['Rand']) ? '#' : $instance['Rand'];


	  echo '<li class="widget widget_recent_entries">';
	  echo $before_title . $title . $after_title;
	  ?>
		 

	<ul>	
			
			<?php

 query_posts('posts_per_page='.$Rand.'&caller_get_posts=1&orderby=rand'); 

while ( have_posts() ) : the_post();
	echo '<li>';
	echo '<a href="';
	the_permalink(); 
	echo '"title="';
	the_title();
	echo '">';
	the_title();
	echo '</a>';
	echo '</li>';
endwhile;

wp_reset_query();

?>
			
		</ul>

	  <?php 
	  echo $after_widget;
   }
}
add_action('widgets_init',create_function('', 'return register_widget("Rand");'));

/*网站统计*/
class analytics extends WP_Widget //网站统计
{
    function analytics(){
		$widget_ops = array('classname'=>'set_contact','description'=>'网站数据统计');
		$this->WP_Widget(false,'网站统计',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('title'=>'网站统计','Date'=>'2011-3-10'));
		$title = htmlspecialchars($instance['title']);
		$Date = htmlspecialchars($instance['Date']);
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:220px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Date').'">开始日期:<input style="width:220px;" id="'.$this->get_field_id('Date').'" name="'.$this->get_field_name('Date').'" type="text" value="'.$Date.'" /></label></p>';
	
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['Date'] = strip_tags(stripslashes($new_instance['Date']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $title = apply_filters('widget_pages',empty($instance['title']) ? '&nbsp;' : $instance['title']);
	 $Date = apply_filters('widget_pages',empty($instance['Date']) ? '&nbsp;' : $instance['Date']);

	  echo '<li class="widget widget_count">';
	  echo $before_title . $title . $after_title;
	  ?>
<ul>
<li>∴日志总数: <?php global $wpdb; $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</li>
<li>∴评论总数: <?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> 条</li>
<li>∴网站运行: <?php echo floor((time()-strtotime($Date))/86400); ?> 天</li>
<li>∴标签总数: <?php echo $count_tags = wp_count_terms('post_tag'); ?> 个</li>
<li>∴页面总数: <?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?> 个</li>
<li>∴链接总数: <?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?> 条</li>
</ul>




	  <?php 
	  echo $after_widget;
   }
}
add_action('widgets_init',create_function('', 'return register_widget("analytics");'));


/*最近回复[头像 ]*/
class hjyl_Comment extends WP_Widget //最近评论 
{
    function hjyl_Comment(){
		$widget_ops = array('classname'=>'set_contact','description'=>'最近评论头像版');
		$this->WP_Widget(false,'最近评论[头像]',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('title'=>'最近回复','Comment'=>'8'));
		$title = htmlspecialchars($instance['title']);
		$Comment = htmlspecialchars($instance['Comment']);

		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:220px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Comment').'">显示条数:<input style="width:220px;" id="'.$this->get_field_id('Comment').'" name="'.$this->get_field_name('Comment').'" type="text" value="'.$Comment.'" /></label></p>';
}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['Comment'] = strip_tags(stripslashes($new_instance['Comment']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
	  $Comment = empty($instance['Comment']) ? '#' : $instance['Comment'];

	  echo '<li class="widget widget_comment">';
	  echo $before_title . $title . $after_title;
	  ?>
	
<ul class="recentcomments">
<?php
global $wpdb;
$my_email = get_bloginfo ('admin_email');
$rc_comms = $wpdb->get_results("
  SELECT ID, post_title, comment_ID, comment_author, comment_author_email, comment_content, comment_author_url
  FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts
  ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
  WHERE comment_approved = '1'
  AND comment_type = ''
  AND user_id='0'
  AND post_password = ''
  AND comment_author_email != '$my_email'
  ORDER BY comment_date_gmt
  DESC LIMIT ".$Comment."
");
$rc_comments = '';

/**/

global $options;

/**/
foreach ($rc_comms as $rc_comm) {
/*无缓存头像*/
$rc_comments .= "<li><a  rel='external nofollow' target='_blank' href='". $rc_comm->comment_author_url . "' title='" . $rc_comm->comment_author . "'>" . get_avatar($rc_comm,$size='32',$default,$alt=''. $rc_comm->comment_author .'') ."</a><span class='zsnos_comment_author'><a href='". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID. "' title=' " . $rc_comm->comment_author . " 在《" . $rc_comm->post_title . "》上的评论'>". $rc_comm->post_title ."</a><br/>"
//. htmlspecialchars(get_comment_link( $rc_comm->comment_ID, array('type' => 'comment'))) // 可取代上一行, 会显示评论分页ID, 但较耗资源
. strip_tags($rc_comm->comment_content)
. "</li>\n";
}
/*/无缓存头像*/
$rc_comments = convert_smilies($rc_comments);
echo $rc_comments;

?></ul>
		

	  <?php 
	  echo $after_widget;
   }
}

add_action('widgets_init',create_function('', 'return register_widget("hjyl_Comment");'));

/*回复排行榜*/
class Wall extends WP_Widget //回复排行榜 
{
    function Wall(){
		$widget_ops = array('classname'=>'set_contact','description'=>'');
		$this->WP_Widget(false,'评论排行榜[头像]',$widget_ops);
    }
    function form($instance){
		$instance = wp_parse_args((array)$instance,array('title'=>'评论排行榜','Comment'=>'1','Wall'=>'18'));
		$title = htmlspecialchars($instance['title']);
		$Comment = htmlspecialchars($instance['Comment']);
		$Wall = htmlspecialchars($instance['Wall']);
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:220px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Comment').'">最近几月:<input style="width:220px;" id="'.$this->get_field_id('Comment').'" name="'.$this->get_field_name('Comment').'" type="text" value="'.$Comment.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('Wall').'">最多显示多少条:<input style="width:220px;" id="'.$this->get_field_id('Wall').'" name="'.$this->get_field_name('Wall').'" type="text" value="'.$Wall.'" /></label></p>';
}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['Comment'] = strip_tags(stripslashes($new_instance['Comment']));
		$instance['Wall'] = strip_tags(stripslashes($new_instance['Wall']));
		return $instance;
    }
   function widget($args,$instance){
	  extract($args);
	  $title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
	  $Comment = empty($instance['Comment']) ? '#' : $instance['Comment'];
	  $Wall = empty($instance['Wall']) ? '#' : $instance['Wall'];
	  echo '<li class="widget widget_wall">';
	  echo $before_title . $title . $after_title;
	  ?>
	



<ul class="ffox_most_active">

<?php
    global $wpdb;
    $counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email
        FROM {$wpdb->prefix}comments
        WHERE comment_date > date_sub( NOW(), INTERVAL ".$Comment." MONTH )
            AND comment_approved = '1'
            AND comment_author_email != 'example@example.com'
            AND comment_author_url != ''
            AND comment_type = ''
            AND user_id = '0'
        GROUP BY comment_author_email
        ORDER BY cnt DESC
        LIMIT ".$Wall."");

    $mostactive = '';
    if ( $counts ) {     
        foreach ($counts as $count) {
            $c_url = $count->comment_author_url;
            $mostactive .= '<li class="mostactive">' . '<a rel="nofollow" href="'. $c_url . '" title="' . $count->comment_author .' 发表 '. $count->cnt . ' 条评论" target="_blank">' . get_avatar($count->comment_author_email, 32, '', $count->comment_author . ' 发表 ' . $count->cnt . ' 条评论') . '</a></li>';
        }
        echo $mostactive;
    }
?>
</ul>


	  <?php 
	  echo $after_widget;
   }
}

add_action('widgets_init',create_function('', 'return register_widget("Wall");'));