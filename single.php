<?php get_header(); ?>
		<section>
			<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<hgroup>
							<h2><?php the_title(); ?></h2>
						</hgroup>
						
						<div id="imeta">
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
						</div>
					</header>
					
					<section>
						<figure id="adx"><?php echo get_option('adx'); ?></figure>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<nav class="page-link"><span>' . __( 'Pages:', 'yOoo' ) . '</span>', 'after' => '</nav>' ) ); ?>
					</section>
					
					<footer>
					<figure id="adxx"><?php echo get_option('adxx'); ?></figure>
						
						<p><?php the_tags(); ?></p>
						<span class="date">
							<?php time_diff( $time_type = 'post' ); ?>
						</span>
					</footer>
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php comments_template( '', true ); ?>
				<?php endwhile; ?>
					
					<nav id="nav-single">
						<div id="nav_pn">
							<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'yHtml5' ) ); ?></span>
							<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'yHtml5' ) ); ?></span>
						</div>
					</nav><!-- #nav-single -->

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