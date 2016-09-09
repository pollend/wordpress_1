<?php $content = get_the_content(); ?>
		
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<?php  get_template_part( 'post', 'header' );?>

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

			<?php  get_template_part( 'post', 'footer' );?>
	
		</div>
