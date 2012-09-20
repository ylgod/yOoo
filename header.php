<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<title><?php if ( is_paged() ){ ?><?php printf( __('Page %1$s of %2$s', ''), intval( get_query_var('paged')), $wp_query->max_num_pages); ?> - <?php } ?><?php if ( is_home() ) { ?><? bloginfo('name'); ?><?php } ?><?php if ( is_search() ) { ?><?php _e('search : ', ''); ?>"<?php echo $s; ?>"<?php } ?><?php if ( is_404() ) { ?><?php _e('404 Error', ''); ?><?php } ?><?php if ( is_author() ) { ?><?php _e('post list : ', ''); ?><?php } ?><?php if ( is_single() ) { ?><?php wp_title(''); ?><?php } ?><?php if ( is_page() ) { ?><?php wp_title(''); ?><?php } ?><?php if ( is_category() ) { ?><?php single_cat_title(); ?><?php } ?><?php if ( is_year() ) { ?><?php the_time('Y'); ?><?php } ?><?php if ( is_month() ) { ?><?php the_time('F, Y'); ?><?php } ?><?php if ( is_day() ) { ?><?php the_time('F j, Y'); ?><?php } ?><?php if ( is_tag() ) { ?><?php single_tag_title(); ?><?php } ?></title>

<?php
if (is_home()){
	$description = get_option('description');
	$keywords = get_option('keywords');
} elseif (is_single()){
    if ($post->post_excerpt) {
        $description     = $post->post_excerpt;
    } else {
        $description = substr(strip_tags($post->post_content),0,220);
    }
    $keywords = "";      
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ", ";
    }
} elseif ( is_category() ) {
	$description = category_description();
    $keywords = get_option('keywords');
}else{
	$description = get_option('description');
	$keywords = get_option('keywords');
}
?>
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="description" content="<?php echo $description; ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if (is_archive() && ($paged > 1)&& ($paged < $wp_query->max_num_pages)) { ?>
<link rel="prefetch" href="<?php echo get_next_posts_page_link(); ?>">
<link rel="prerender" href="<?php echo get_next_posts_page_link(); ?>">
<?php } ?>

<?php wp_head();?>
<!--[if lte IE 9]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<header>
			<hgroup>
				<h1><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
			</hgroup>
			<?php get_search_form(); ?>
			<div class="clear"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'container_id' => 'menu' ) ); ?>
			<div class="clear"></div>
			
		</header>
		