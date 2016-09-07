<?php get_header(); ?>

	<div class="row">
	    <div class="small-9 columns">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<?php $content = get_the_content();?>
					
					<?php //include the default post header for the archive
					@include('post-header.php');?>

					<?php
					if( has_post_format("image"))
					{
						$doc = new DOMDocument;
						$doc->loadHTML($content);
						$image = $doc->getElementsByTagName('img');
						?>
						
						<img class="post-format-image" src="<?php echo $image->item(0)->getAttribute('src');?>"/>
						
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
					
					<?php //echo sharing_display(); ?>
					<div id="page-numbering">
						<?php wp_link_pages("Page before=<p>&after=</p>&next_or_number=number&pagelink= %"); ?>
					</div>
					<div class="comment-container">
						<?php comments_template(); ?>
					</div>
				</div>
				
			<?php endwhile; endif; ?>	
		</div>

        <div class="small-3 columns">
            <?php get_sidebar(); ?>
        </div>
	</div>

<?php get_footer(); ?>