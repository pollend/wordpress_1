<div id="slidePresentation">
	<div id="slide">
		<?php
		 $themeOptions = get_option("gray_home_options");
			?>
			<div id="slideContainer">
				<ul id="slides">
					<?php 
					for($x = 0; $x < count($themeOptions["Slide"]); $x++)
					{
						if(!empty($themeOptions["isHTML"][$x]))
						{
							?>
							<li id="slide<?php echo $x; ?>"> <?php echo  $themeOptions["Slide"][$x] ?> </li>
							<?php
						}
						else
						{
							?>
								<li id="slide<?php echo $x; ?>" ><a><img class="fullSlideImage"src="<?php echo  $themeOptions["Slide"][$x] ?>"></img></a></li>
							<?php
						}
					}
					?>

				</ul>
			</div>
			<ul id="slideSelect"></ul>
			<a  id="slideLeft" href="#" ><div></div></a>
			<a id="slideRight" href="#"><div></div></a>
			<div id="slide-load-bar"></div>
	</div>

</div>
