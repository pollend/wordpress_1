
<?php $themeOptions = get_option("gray_home_options");?>

<div class="row">
	<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
	  <ul class="orbit-container">
	    <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
	    <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
	    
		<?php 
		for($x = 0; $x < count($themeOptions["Slide"]); $x++)
		{
			if(!empty($themeOptions["isHTML"][$x]))
			{
				?>
				<li class="is-active orbit-slide">
			      <img class="orbit-image" height="100px" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/03.jpg" alt="Space">
			      <figcaption class="orbit-caption">Space, the final frontier.</figcaption>
			    </li>

				<li id="slide<?php echo $x; ?>"> <?php echo  $themeOptions["Slide"][$x] ?> </li>
				<?php
			}
			else
			{
				?>
				<li class="is-active orbit-slide">
			      <img class="orbit-image" height="100px" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/03.jpg" alt="Space">
			      <figcaption class="orbit-caption">Space, the final frontier.</figcaption>
			    </li>

					<li id="slide<?php echo $x; ?>" ><a><img class="fullSlideImage"src="<?php echo  $themeOptions["Slide"][$x] ?>"></img></a></li>
				<?php
			}
		}
		?>

	    
	    
	    <li class="orbit-slide">
	      <img class="orbit-image" height="100px" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/02.jpg" alt="Space">
	      <figcaption class="orbit-caption">Lets Rocket!</figcaption>
	    </li>
	    
	    <li class="orbit-slide">
	      <img class="orbit-image" height="100px" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/01.jpg" alt="Space">
	      <figcaption class="orbit-caption">Encapsulating</figcaption>
	    </li>
	    
	    <li class="orbit-slide">
	      <img class="orbit-image" height="100px" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/04.jpg" alt="Space">
	      <figcaption class="orbit-caption">Outta This World</figcaption>
	    </li>
	  
	  </ul>
	  <nav class="orbit-bullets">
	    <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
	    <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
	    <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
	    <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
	  </nav>
	</div>
</div>