<?php 
/**
 * Template Name: Front Page Template With Post DED
 */
?>


<?php
 get_header(); ?>

<?php ?>
	<?php  get_template_part( 'Presentation', 'index' ); ?>

	<div id="main">
		<div>
			<div id="contentContainer" >

			<?php
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('posts_per_page=2');
				while ($wp_query->have_posts()) : $wp_query->the_post();
				?>

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<div class="postTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>

					<div class="meta">
						<em>Posted on:</em> <span class="postTime"><?php the_time('F jS, Y') ?></span> by <span class="postAuthor"><?php echo get_the_author()?></span>
					</div>


					<div class="entry">
						<?php the_content(); ?>
					</div>

					<div class="postmetadata">
						<?php the_tags('Tags: ', ', ', '<br />'); ?>
						Entries: <?php the_category(', ') ?> 
				
					</div>

				</div>
			<?php endwhile; ?>
		</div>
		<div id="sidebarContainer">
			<?php get_sidebar(); ?>
		</div>
	</div>



<?php get_footer(); ?>
