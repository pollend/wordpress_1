<?php get_header(); ?>

<div id="contentContainer">
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<div class="archive-title">
			<?php /* If this is a category archive */ if (is_category()) { ?>
				Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				Archive for <?php the_time('F jS, Y'); ?>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				Archive for <?php the_time('F, Y'); ?>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				Archive for <?php the_time('Y'); ?>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				Author Archive

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				Blog Archives
			<?php } ?>
</div>
		

			<?php while (have_posts()) : the_post(); ?>
			
				<div <?php post_class() ?>>
				

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

			
	<?php else : ?>

		<h2>Nothing found</h2>

	<?php endif; ?>


</div>

<div id="sidebarContainer">
	<?php get_sidebar(); ?>
</div>
</div>
</div>

