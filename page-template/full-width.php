<?php 
/**
 * Template Name:Full Width Template
 */
?>

<?php get_header(); ?>
	<div id="main">
		<div>
		<div id="contentContainer" class="full-width">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="postTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
					<div class="meta">

					</div>

					<div class="entry">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>


		<?php else : ?>

			<h2>Not Found</h2>

		<?php endif; ?>

		</div>
	</div>


<?php get_footer(); ?>
