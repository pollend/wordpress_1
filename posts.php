	<?php 
	if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php $content = get_the_content();?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<?php //include the default post header for the archive
			@include('post-header.php');?>

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
					echo $content; 

					?>
	
			</div>

			<div class="postmetadata">
				<?php the_tags('Tags: ', ', ', '<br />'); ?>
				Entries: <?php the_category(', ') ?> 
			</div>
			
			<div class="comment-container">
				
			</div>
	
		</div>
	<?php endwhile; ?>
<?php else : ?>

	<h2>Not Found</h2>

<?php endif; ?>