<?php

	add_action('admin_init', 'gray_home_init');
    function gray_home_init(){
	

    	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_template_directory_uri() .'/admin/HomeOptions.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
		wp_enqueue_style('thickbox');

		register_setting( 'gray_home_options', 'gray_home_options');

        add_settings_section('gray_slides', 'Slides', 'gray_slide_section', 'gray_home_slide_settings');
        add_settings_field('Slides', 'Slides', 'gray_slide_field', 'gray_home_slide_settings', 'gray_slides');

        add_settings_section('gray_blurb','blurb','','gray_home_slide_settings');
        add_settings_field("blurb_title","title","gray_blurb_title","gray_home_slide_settings","gray_blurb");
        add_settings_field("blurb_statement","statement","gray_blurb_statement","gray_home_slide_settings","gray_blurb");

        add_settings_section('gray_left_box', 'left header box', '', 'gray_home_slide_settings');
        add_settings_field('left_header_head', 'header', 'gray_left_box_header_field', 'gray_home_slide_settings', 'gray_left_box');
        add_settings_field('left_header_image', 'image', 'gray_left_box_image_field', 'gray_home_slide_settings', 'gray_left_box');
        add_settings_field('left_header_info', 'info', 'gray_left_box_info_field', 'gray_home_slide_settings', 'gray_left_box');

        add_settings_section('gray_middle_box', 'middle header box', '', 'gray_home_slide_settings');
        add_settings_field('middle_header_head', 'header', 'gray_middle_box_header_field', 'gray_home_slide_settings', 'gray_middle_box');
        add_settings_field('middle_header_image', 'image', 'gray_middle_box_image_field', 'gray_home_slide_settings', 'gray_middle_box');
        add_settings_field('middle_header_info', 'info', 'gray_middle_box_info_field', 'gray_home_slide_settings', 'gray_middle_box');

      	add_settings_section('gray_right_box', 'right header box', '', 'gray_home_slide_settings');
        add_settings_field('right_header_head', 'header', 'gray_right_box_header_field', 'gray_home_slide_settings', 'gray_right_box');
        add_settings_field('right_header_image', 'image', 'gray_right_box_image_field', 'gray_home_slide_settings', 'gray_right_box');
        add_settings_field('right_header_info', 'info', 'gray_right_box_info_field', 'gray_home_slide_settings', 'gray_right_box');

    }



    function gray_blurb_title()
    {
    	$options = get_option("gray_home_options");
    	?>
    	<input type="text" size="36" name="gray_home_options[blurbTitle]" value="<?php echo htmlentities($options["blurbTitle"])?>"/>
    	<?php
    }

    function gray_blurb_statement(){
    	$options = get_option("gray_home_options");
    	?>
    	<textarea rows="10" cols="100" name="gray_home_options[blurbStatement]" ><?php echo htmlentities($options["blurbStatement"])?></textarea>
    
    	<?php
    }

	//left info box section
    function gray_left_box_header_field(){
    	$options = get_option("gray_home_options");
    	?>
    	<input type="text" size="36" name="gray_home_options[leftHeader]" value="<?php echo htmlentities($options["leftHeader"])?>"/>
    	<?php
    }
    function gray_left_box_image_field(){
		$options = get_option("gray_home_options");
		?>
		<div class="Upload">
			<div>
				<input id="left_header_image" value="<?php echo $options["leftHeaderImage"] ?>" type="text" size="36" name='gray_home_options[leftHeaderImage]' />
				<input id="left_header_image_button" type="button" value="Upload Image" />
				</br>
				Note:image will have to have a 2:1 ratio to function
			</div>
		</div>
		<?php
    }
    function gray_left_box_info_field(){
		$options = get_option("gray_home_options");
		?>
		<textarea rows="10" cols="100"  name="gray_home_options[leftHeaderInfo]" > <?php echo htmlentities($options["leftHeaderInfo"])?></textarea>
		<?php
    }

    //middle info box header
    function gray_middle_box_header_field(){
		$options = get_option("gray_home_options");
		?>
		<input type="text" size="36" value="<?php echo htmlentities( $options["middleHeader"]) ?>" name="gray_home_options[middleHeader]" />
		<?php
    }
 	function gray_middle_box_image_field(){
		$options = get_option("gray_home_options");
		?>
		<div class="Upload">
			<div>
				<input id="middle_header_image" value="<?php echo $options["middleHeaderImage"] ?>" type="text" size="36" name='gray_home_options[middleHeaderImage]' />
				<input id="middle_header_image_button" type="button" value="Upload Image" />
				</br>
				Note:image will have to have a 2:1 ratio to function
			</div>
		</div>
		<?php
    }
    function gray_middle_box_info_field(){
		$options = get_option("gray_home_options");
		?>
		<textarea rows="10" cols="100" name="gray_home_options[middleHeaderInfo]" ><?php echo htmlentities($options["middleHeaderInfo"]) ?></textarea>
	
		<?php
    }

    //right info box header
 	function gray_right_box_header_field(){
		$options = get_option("gray_home_options");
			?>
		<input type="text" size="36"  name="gray_home_options[rightHeader]" value="<?php echo htmlentities($options["rightHeader"]) ?>"/>
		<?php
    }
    function gray_right_box_image_field(){
		$options = get_option("gray_home_options");
		?>
		<div class="Upload">
			<div>
				<input id="right_header_image" value="<?php echo $options["rightHeaderImage"] ?>" type="text" size="36" name='gray_home_options[rightHeaderImage]' />
				<input id="right_header_image_button" type="button" value="Upload Image" />
				</br>
				Note:image will have to have a 2:1 ratio to function
			</div>
		</div>
		<?php
    }
    function gray_right_box_info_field(){
		$options = get_option("gray_home_options");
			?>
			<textarea rows="10" cols="100"  name="gray_home_options[rightHeaderInfo]"> <?php echo htmlentities($options["rightHeaderInfo"])?></textarea>

		<?php
    }


    function gray_slide_section() {
   	?>

  	  <div>Note: images will have to maintain a 2:1 ratio to function properly in the slide show</div>
	  <div>Note: A single slide will be viewed without a carousel </div>
	  <div>Note: enable HTML input allows html to be directly placed into each slide</div>
	 
  	  <?php
    } 

    function gray_slide_field() {
    	$options = get_option("gray_home_options");
        ?> 
	        <div id="slide_options">
		        <?php 
		        for($x = 0; $x < count($options["Slide"]); $x++)
		        {
		        	?>
		        	<div id="slides_option_container<?php echo $x ?>">
						<input id="upload_image<?php echo $x ?>" type="text" size="36" name='gray_home_options[Slide][<?php echo $x; ?>]' value="<?php echo  htmlentities($options["Slide"][$x]) ?>" />
						<input id="upload_image_button<?php echo $x ?>" type="button" value="Upload Image" />
						<input id="remove_slide<?php echo $x ?>" type="button" value="remove" /></br>Input raw HTML into slide: 
						<input name='gray_home_options[isHTML][<?php echo $x; ?>]' <?php echo empty($options["isHTML"][$x]) ? "" : "checked"; ?> value="1" type="checkbox"/>
					</div>
		        	<?php
		        }
		        ?>
	        </div>
	         <div><a id="addSlide" href="#">add Slide</a></div>
        <?php

    }

    function gray_home_option_validate($input){
    	$index = 0;
		for($x = 0; $x < $input["numslides"]; $x++)
	    {
	    	if($input["Slide".$x] == "")
	    	{
	    		unset($input["Slide".$x]);
	    	}
	    	else
	    	{
	    		if(("Slide".$x) != ("Slide".$index))
	    		{
	    			$input["Slide".$index] = $input["Slide".$x];
	    			unset( $input["Slide".$x]);
	    		}
	    		$index++;
	    	}
	    }
	    $input["numslides"] = $index;
    	return  $input;
    }


function gray_home_options_page()
{
	if (!current_user_can('manage_options'))
    {
      wp_die( 'You do not have sufficient permissions to access this page.');
    }

	?>
	<script type="text/javascript">
	</script>

	<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Theme Options</h2>
	    
	<form action="options.php" method="post" >
		<?php settings_fields('gray_home_options'); ?>

		<?php do_settings_sections('gray_home_slide_settings'); ?>
		<?php submit_button(); ?>
	</form>

	<?php
}
?>