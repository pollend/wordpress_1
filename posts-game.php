		<?php $content = get_the_content();?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<?php 
			$images = get_post_meta( get_the_ID(),"game_image",true);
	
			if(isset($images))
			{
				if(!is_single() || count($images) == 1)
				{
					?>
					<div class="orbit-slide game-static-slide">
						<img class="orbit-image" src="<?php echo $images[0]["image"] ?>" /> 
					</div>
					<?php
				}
				else
				{
					?>

					<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
					  <ul class="orbit-container">
						    <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
						    <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>

						<?php 
						for($x = 0; $x < count($images); $x++)
						{
							?>
							<li class="is-active orbit-slide">
							  	<img class="orbit-image" height="100px" src="<?php echo $images[$x]["image"] ?>" alt="Space">
						    </li>

							<?php
						}
						?>

					  </ul>
					  <nav class="orbit-bullets">

					  	 <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
					  	<?php 
						for($x = 1; $x < count($images); $x++)
						{
							?>
								<button data-slide="<?php echo $x;?>"><span class="show-for-sr"></span></button>
							<?php

						}
						?>
					  </nav>
					</div>


					<?php
				}
			}


			?>


			<div class="main-container">
				<?php  get_template_part( 'post', 'header' );?>
				<div class="entry">
					<?php  
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
						echo $content; 

						?>

				</div>
				<?php  get_template_part( 'post', 'footer' );?>
			</div>
		</div>
