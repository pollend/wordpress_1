<div id="slidePresentation">
	<div id="slide">
		<?php

		 $themeOptions = get_option("gray_home_options");

		if($themeOptions["numslides"] == 1)
		{
			if(!empty($themeOptions["isHTML0"]))
			{

				echo $themeOptions["Slide0"];
			}
			else
			{
		?>
			<img class="fullSlideImage"src="<?php echo  $themeOptions["Slide0"] ?>">
			<?php
			}
		}
		else if( count($themeOptions["Slide"]) > 1)
		{
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
			<a  id="slideLeft" ><div></div></a>
			<a id="slideRight"><div></div></a>
			<?php
		}
		else
		{
			?>
			<div id="slideContainer">
				<ul id="slides">
					<li id="slide0"><a><img class="fullSlideImage"src="<?php echo  bloginfo('template_directory'); ?>/images/two-hundred.png"></img></a></li>
					<li id="slide1"><a><img class="fullSlideImage"src="<?php echo  bloginfo('template_directory'); ?>/images/six-three.png"></img></a></li>
				</ul>
			</div>
			<ul id="slideSelect"></ul>
			<a  id="slideLeft" ><div></div></a>
			<a id="slideRight"><div></div></a>
			<?php
		}
		?>
		<div id="slideBorder"></div>
	</div>
	<div id="blurb">
		<div id="blurbTitle"><?php 
		if(empty($themeOptions["blurbTitle"]))
		{
			?>
			Bacon ipsum dolor sit
			<?php
		}
		else
		echo  $themeOptions["blurbTitle"] ?></div>

		<div id="blurbInfo">
			<?php
			if(empty( $themeOptions["blurbStatement"])):
			
				?>
					<p>Bacon k chop doner.  Beef  sirloin pork pastrami drumstick flank shoulder meatball pancetta chuck.  Cow ground round flank beef.  Pig capicola boudin jerky, short ribs prosciutto bresaola ribeye ground round spare ribs drumstick shoulder leberkas corned beef jowl.</p><p>Pancetta flank biltong pork short ribs jowl drumstick strip steak meatloaf capicola doner bresaola spare ribs.  Jerky pne.  Tongue tenderloin biltong shoulder doner.  Tri-tip meatloaf corned beef pastrami flank chuck pork leberkas bacon t-bone.  Tongue venison hamburger brisket, shankle jowl pancetta pork chop pork loin ham turducken fatback salami.  Fatback frankfurter strip steak filet mignon.</p>
				<?php
			
			else :
			
			 echo  $themeOptions["blurbStatement"]; 
			endif;
			?>
			
		</div>
	</div>
</div>
<div class="threeSplit">
	<div class="threeSplitElements"><div class="threeSplitContainer"><h1><?php if(!empty($themeOptions["leftHeader"])) echo  $themeOptions["leftHeader"]; else echo "Bacon ipsum"; ?></h1><img src="<?php if(!empty($themeOptions["leftHeaderImage"])) echo  $themeOptions["leftHeaderImage"]; else echo bloginfo('template_directory')."/images/six-three.png" ; ?>" width="100" height="52px"></img><div class="threeInfoContent"><?php if(!empty($themeOptions["leftHeaderInfo"])) echo  $themeOptions["leftHeaderInfo"];else echo "<p>Bacon k chop doner.  Beef  scola boudin jerky, short ribs prosciutto bresaola ribeye ground round spare ribs drumstick shoulder leberkas corned beef jowl.</p><p>Pancetta flank biltong pork short ribs jowl drumstick strip steak meatloaf capicola doner bresaola spare ribs.  Jerky pne.  Tongue tenderloin biltong shoulder doner.  Tri-tip meatloaf corned beef pastrami flank chuck pork leberkas bacon t-bone.  Tongue venison hamburger brisket, shankle jowl pancetta pork chop pork loirter strip steak filet mignon.</p>" ; ?></div></div></div>
	<div class="threeSplitElements"><div class="threeSplitContainer"><h1><?php if(!empty($themeOptions["middleHeader"])) echo  $themeOptions["middleHeader"]; else echo "Bacon ipsum"; ?></h1><img src="<?php if(!empty( $themeOptions["middleHeaderImage"])) echo  $themeOptions["middleHeaderImage"]; else echo bloginfo('template_directory')."/images/six-three.png"; ?>" width="100" height="52px"></img><div class="threeInfoContent"><?php if(!empty($themeOptions["middleHeaderInfo"])) echo  $themeOptions["middleHeaderInfo"]; else echo "<p>Bacon k chop doner.  Beef  scola boudin jerky, short ribs prosciutto shoulder leberkas corned beef jowl.</p><p>Pancetta flank biltong pork short ribs jowl drumstick strip steak meatloaf capicola doner bresaola spare ribs.  Jerky pne.  Tongue tenderloin biltong shoulder doner.  Tri-tip meatloaf corned beef pastrami flank chuck pork leberkas bacon t-bone.  Tongue venison hamburger brisket.</p>" ; ?></div></div></div>
	<div class="threeSplitElements"><div class="threeSplitContainer"><h1><?php if(!empty($themeOptions["rightHeader"])) echo  $themeOptions["rightHeader"]; else echo "Bacon ipsum"; ?></h1><img src="<?php if(!empty($themeOptions["rightHeaderImage"])) echo  $themeOptions["rightHeaderImage"] ; else echo bloginfo('template_directory')."/images/six-three.png"; ?>" width="100" height="52px"></img><div class="threeInfoContent"><?php if(!empty($themeOptions["rightHeaderInfo"])) echo  $themeOptions["rightHeaderInfo"]; else echo "<p>Bacon k chop doner.  Beef  scola boudin jerky, short ribs prosciutto bresaola ribeye ground round spare ribs drumstick shoulder leberkas corned beef jowl.</p><p>Pancetta flank biltong pork short ribs jowl drumstick strip steak meatloaf capicola doner bresaola spare ribs.  Jerky pne.  Tongue tenderloin biltong shoulder doner.  Tri-tip meatloaf corned beef pastrami flank chuck pork leberkas bacon t-bone.  Tongue venison hamburger brisket, shankle jowl pancetta pork chop pork loirter strip steak filet mignon.</p>" ;  ?> </div></div></div>
</div>