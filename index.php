<?php get_header(); 
?>
<div id="blog-container">
	<div id="contentContainer">

		

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php $content = get_the_content();?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<div class="postTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>

				<div class="meta">
					<em>Posted on:</em> <span class="postTime"><?php the_time('F jS, Y') ?></span> by <span class="postAuthor"><?php echo get_the_author()?></span>
				</div>

				<?php 
					if( has_post_format("image")){
						$doc = new DOMDocument;
						$doc->loadHTML($content);

						$image = $doc->getElementsByTagName('img');
						?>
						<img class="post-format-image" src="<?php echo $image->item(0)->getAttribute('src');?>">
						<?php

						$image->item(0)->parentNode->removeChild($image->item(0));
						
						$content = $doc->saveHTML();

					}
				?>

				<div class="entry">
					<?php  
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
						echo $content; ?>
		
				</div>

				<div class="postmetadata">
					<?php the_tags('Tags: ', ', ', '<br />'); ?>
					Entries: <?php the_category(', ') ?> 
				</div>
		
			</div>
		<?php endwhile; ?>
	</div>



	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>

	<div id="sidebarContainer">
		<?php get_sidebar(); ?>
	</div>
</div>
<div id="pageination-container">
	<div class="nav-previous alignleft"><?php echo str_replace("empty=t","",get_next_posts_link( 'Older posts' )); ?></div>
	<div class="nav-next alignright"><?php echo str_replace("empty=t","",get_previous_posts_link( 'Newer posts' )); ?></div>
</div>


