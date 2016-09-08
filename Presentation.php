
<?php $themeOptions = get_option("gray_home_options");

if($themeOptions["slides"] != ""):
?>

<div class="row">
	<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
	  <ul class="orbit-container">

	  	<?php if(count($themeOptions["slides"]) > 1): ?>
		    <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
		    <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
	   	<?php endif; ?>

		<?php 
		for($x = 0; $x < count($themeOptions["slides"]); $x++)
		{
			?>
			<li class="is-active orbit-slide">
				<a href="<?php echo $themeOptions["slides"][$x]["link"] ?>">
			  	<img class="orbit-image" height="100px" src="<?php echo $themeOptions["slides"][$x]["payload"] ?>" alt="Space">
		     	</a>
		      <figcaption class="orbit-caption"><?php echo $themeOptions["slides"][$x]["blurb"] ?></figcaption>
		    </li>

			<?php

		}
		?>

	  </ul>
	  <?php if(count($themeOptions["slides"]) > 1): ?>
	  <nav class="orbit-bullets">

	  	 <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
	  	<?php 
		for($x = 1; $x < count($themeOptions["slides"]); $x++)
		{
			?>
				<button data-slide="<?php echo $x;?>"><span class="show-for-sr"></span></button>
			<?php

		}
		?>
	  </nav>
	  <?php endif; ?>
	</div>
</div>

<?php endif;?>