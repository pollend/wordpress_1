		<?php $content = get_the_content();?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<?php  get_template_part( 'post', 'header' );?>

			<?php 

			$images = get_post_meta( get_the_ID(),"game_image",true);
			//var_dump($images);
			//foreach($images as $key => $value)
			if(isset($images[0]))
			{
				?>
				<div class="orbit-slide game-static-slide">
					<img class="orbit-image" src="<?php echo $images[0]["image"] ?>" /> 
				</div>
				<?php
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
