<?php
/**
 * 백도친경
 */
 get_header(); ?>
		<section>
		<figure id="adxx"><?php echo get_option('adxxx'); ?></figure>
			<?php if(have_posts()) : ?>

				<?php yOoo_crumbs(); ?>
				
			<?php while(have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<hgroup>
						<?php if ( is_sticky() ) : ?>
								<h2>[<?php printf(__('Featured', 'yOoo')) ; ?>]<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							
						<?php else : ?>
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php endif; ?>
						</hgroup>
					</header>
					
					<section>
						<?php the_excerpt(); ?>
					</section>
					
					<footer>
						<span class="date">
							<?php time_diff( $time_type = 'post' ); ?>
						</span>
						<span class="author">
							<?php the_author(); ?>
						</span>
						<span class="cat-links">
							<?php the_category(', ') ?>
						</span>
						<span class="comments-views" title="<?php _e('Comments:', 'yOoo'); ?><?php comments_number('0', '1', '%' );?>/<?php _e('Views:', 'yOoo'); ?><?php if(!function_exists('the_views')) post_views('', ''); ?>">
						<em><?php _e('Comments:', 'yOoo'); ?><?php if ( comments_open() ) : ?><?php comments_number('<b>0</b>', '<b>1</b>', '<b>%</b>' );?><?php endif; // End if comments_open() ?>/<?php _e('Views:', 'yOoo'); ?><b><?php if(!function_exists('the_views')) post_views('', ''); ?></b></em>
						</span>

						<?php edit_post_link( __( 'Edit', 'yOoo' ), '<span class="edit-link">', '</span>' ); ?>
					</footer>
				</article><!-- #post-<?php the_ID(); ?> -->
				
				<?php endwhile; ?>
					
					<nav id="navigation">
						<?php
							if(function_exists('wp_page_numbers')) {
								wp_page_numbers();
							}
							elseif(function_exists('wp_pagenavi')) {
								wp_pagenavi();
							} else {
							global $wp_query;
							$total_pages = $wp_query->max_num_pages;
							if ( $total_pages > 1 ) {
								echo '<div class="page_navi">';
									par_pagenavi(4);
								echo '</div>';
								}
							}
						?>
					</nav>

			<?php else : ?>

				<article id="post-404" class="post no-results not-found">
					<header>
						<h1><?php _e( 'Nothing Found', 'yOoo' ); ?></h1>
					</header><!-- .entry-header -->

					<section>
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'yOoo' ); ?></p>
					</section><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
		</section>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>